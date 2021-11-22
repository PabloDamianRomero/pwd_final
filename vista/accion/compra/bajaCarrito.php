<?php
$estructuraAMostrar = "desdeSubAccion";
$seguro=true;
$titulo="Carrito Cancelado";
include_once ("../../estructura/cabecera.php");

$objUsuario=$sesion->getUsuario();
$idusuario=$objUsuario->getIdusuario();
$abmCompra=new abmCompra();
$comprasUs=$abmCompra->buscar(['idusuario'=>$idusuario,'metodo'=>'carrito']);
if (count($comprasUs)==1){
    $abmItems=new abmCompraitem();
    $items=$abmItems->buscar(['idcompra'=>$comprasUs[0]->getIdcompra()]);
    if (!empty($items)){
        foreach($items as $item){
            $abmItems->baja(['idcompraitem'=>$item->getIdcompraitem()]);
        }
        $abmCompra->baja(['idcompra'=>$comprasUs[0]->getIdcompra()]);
    }
}
header("Location:../../carrito.php");

include_once("../../estructura/pie.php");

?>