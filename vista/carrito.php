<?php
$estructuraAMostrar = "desdeVista";
$seguro=true;
$titulo="Carrito de compras";
include_once ("estructura/cabecera.php");
// ---------------------- Verificar si el sub-enlace del menú está habilitado -------------------------------
$i = 0;
$existeSubEnlace = false;
if(isset($arrSubMenu)){
    while(($i < count($arrSubMenu)) && (!$existeSubEnlace)){
        $subMenuActual = $arrSubMenu[$i];
        if(($subMenuActual->getMedeshabilitado() != "0000-00-00 00:00:00") && ($subMenuActual->getMedescripcion() == "carrito")){
            $existeSubEnlace = true;
        }
        $i++;
    }
}
// ----------------------------------------------------------------------------------------------------------

// ---------------------- Si el usuario actual no es cliente  -------------------------------
if($rolActivo->getIdrol() != 3){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede visualizar esta pagina (No está con el rol <span style='font-weight: bold; font-style: italic;'>Cliente</span>).
            </div>
        </div>
    </div>
<?php
// ---------------------- Si es Cliente pero el enlace-menu(padre) no está disponible  -------------------------------
}else if(($rolActivo->getIdrol() == 3) && (!isset($arrMenuPadre))){ // si es cliente pero el enlace-menu(padre) no está disponible
    ?>
        <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <span style="font-weight: bold;">Este apartado no se encuentra disponible.</span>
            </div>
        </div>
    </div>
    <?php
// ----------------------------------------------------------------------------------------------------------

// ---------------------- Si es Cliente pero el enlace-menu(sub menú o padre) no está disponible  -------------------------------
// ---------------------- Esto es para no acceder por url a la página si el enlace-menú esta deshabilitado  -------------------------------
 }else if(($rolActivo->getIdrol() == 3) && (isset($arrMenuPadre)) && ($existeSubEnlace) || $arrMenuPadre[0]->getMedeshabilitado() != "0000-00-00 00:00:00"){
    ?>
        <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <span style="font-weight: bold;">Este apartado no se encuentra disponible.</span>
            </div>
        </div>
        </div>
    <?php
}else{
// ----------------------------------------------------------------------------------------------------------    

// ---------------------- Si es Cliente y existe el enlace-menu (padre e hijo)  ------------------------------- 
$objUsuario=$sesion->getUsuario();
$idusuario=$objUsuario->getIdusuario();
$abmCompra=new abmCompra();
$comprasUs=$abmCompra->buscar(['idusuario'=>$idusuario,'metodo'=>'carrito']);
$items=[];
echo '<table class="table table-striped mt-5">
                <tr class="table-success">
                    <th>Producto</th>
                    <th>Precio individual</th>
                    <th>Cantidad</th>
                    <th>Precio total</th>
                    <th></th>
                </tr>';
if (count($comprasUs)==1){ //Solo puede haber un carrito activo
    $abmItems=new abmCompraitem();
    $items=$abmItems->buscar(['idcompra'=>$comprasUs[0]->getidCompra()]);
    if (!empty($items)){
        foreach($items as $item){
            echo '<tr class="table-light"><th>'.$item->getObjProducto()->getPronombre().'</th>';
            echo '<th>'.$item->getObjProducto()->getProprecio().'</th>';
            echo '<th>'.$item->getCicantidad().'</th>';
            echo '<th>'.($item->getObjProducto()->getProprecio()*$item->getCicantidad()).'</th>';
            echo '<th><a href="accion/compra/bajaItem.php?idcompraitem='.$item->getIdcompraitem().'">Eliminar</a></th></tr>';
        }
    }  
}
echo '</table>';
if (!empty($comprasUs) && !empty($items)){
    echo '<form method="post" action="tiendaCompra.php">';
    echo '<input type="hidden" name="idcompra" id="idcompra" value="'.$comprasUs[0]->getidCompra().'">';
    echo '<input type="hidden" name="metodo" id="metodo" value="carrito">';
    echo '<div class="mt-5 text-center"><input type="submit" class="btn btn-success" id="compra" name="compra" value="Comprar"></form>';
    echo '<a href="accion/compra/bajaCarrito.php" class="btn btn-danger" style="margin-left:20px;">Cancelar Compra</a></div>';
}
}


include_once ("estructura/pie.php");
?>

