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
$comprasUs=$abmCompra->buscar(['idusuario'=>$idusuario]);
//Busco agregar al carrito compras a las que el usuario todavia no dio inicio (no se encuentra en la tabla de compraestado).
if (!empty($comprasUs)){
    $abmEstado=new abmCompraestado();
    $noIniciada=[];
    foreach($comprasUs as $compra){
        $yaIniciada=$abmEstado->buscar(['idcompra'=>$compra->getIdcompra()]);
        if (empty($yaIniciada)){
            array_push($noIniciada,$compra);
        }
    }
    echo '<form method="post" action="iniciaCompra.php"><table class="table table-striped mt-5">
                <tr class="table-success">
                    <th>Producto</th>
                    <th>Precio individual</th>
                    <th>Cantidad</th>
                    <th>Precio total</th>
                    <th></th>
                </tr>';
    if (!empty($noIniciada)){
        $items=[];
        foreach($noIniciada as $compra){
            $abmItems=new abmCompraitem();
            $item=$abmItems->buscar(['idcompra'=>$compra->getidCompra()]);
            if (count($item)==1){
                array_push($items,$item[0]);
            }
        }      
        if (!empty($items)){
            foreach($items as $item){
                echo '<tr class="table-light"><th>'.$item->getObjProducto()->getPronombre().'</th>';
                echo '<th>'.$item->getObjProducto()->getProprecio().'</th>';
                echo '<th>'.$item->getCicantidad().'</th>';
                echo '<th>'.($item->getObjProducto()->getProprecio()*$item->getCicantidad()).'</th>';
                echo '<th>Eliminar</th></tr>';
            }
        }

    }
    echo '</table>';
    echo '<div class="mt-5"><input type="submit" class="btn btn-primary" id="compra" name="compra" value="Comprar"></form>';
    echo '<a href="#"><input type="submit" class="btn btn-danger" value="Cancelar Compra"></a></div>';
}

}
include_once ("estructura/pie.php");
?>

