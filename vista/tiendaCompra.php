<?php
    $titulo="Finalizar Compra";
    $estructuraAMostrar = "desdeVista";
    $seguro=true;
    include_once("estructura/cabecera.php");
// ---------------------- Si el usuario actual no es cliente  -------------------------------

if($idrol!= 3){?>
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
    $datos=data_submitted();
    if ($datos['metodo']=="directa" && isset($datos['idproducto']) && isset($datos['cantidad']) && isset($datos['maxStock'])){
        $abmProducto=new abmProducto();
        $buscProd=$abmProducto->buscar(['idproducto'=>$datos['idproducto']]);
        if (count($buscProd)==1){
            $proNombre=$buscProd[0]->getPronombre();
            echo '<h1>Finalizar Compra</h1>';
            echo '<form method="post" action="accion/compra/compraDirecta.php"><small>Producto</small><input type="text" id="pronombre" name="pronombre" value="'.$proNombre.'" disabled size="50">';
            echo '<small style="margin-left: 10px;">Cantidad</small><input type="number" id="cicantidad" name="cicantidad" min="1" max="'.$datos['maxStock'].'" value='.$datos['cantidad'].'>';
            echo '<input type="hidden" id="idproducto" name="idproducto" value="'.$datos['idproducto'].'">';
            echo '<input type="submit" value="Comprar" class="btn btn-primary" style="margin-left: 15px;"></form>';
            echo '<small>Stock disponible</small><input type="text" id="stockProd" name="stockProd" value="'.$datos['maxStock'].'" disabled size="10">';
        }
    }elseif($datos['metodo']=="carrito" && isset($datos['idcompra'])){
        $abmItems=new abmCompraitem();
        $items=$abmItems->buscar(['idcompra'=>$datos['idcompra']]);
        if (!empty($items)){
            echo '<h1>Finalizar Compra</h1>';
            $total=0;
            foreach($items as $item){
                echo '<div>Producto: '.$item->getObjProducto()->getPronombre();
                echo 'Cantidad:'.$item->getCicantidad().'</div>';
                $total+=($item->getObjProducto()->getProprecio())*$item->getCicantidad();
            }
            echo '<div>Total a pagar: $'.$total.'</div>';
            echo '<form method="post" action="accion/compra/compraCarrito.php">';
            echo '<input type="hidden" name="idcompra" id="idcompra" value="'.$datos['idcompra'].'">';
            echo '<input type="submit" value="Comprar" class="btn btn-primary"></form>';
        }
    }
}

include_once("estructura/pie.php");
?>