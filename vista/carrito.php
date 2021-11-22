<?php
$estructuraAMostrar = "desdeVista";
$seguro=true;
$titulo="Carrito de compras";
include_once ("estructura/cabecera.php");
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
}else{
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

