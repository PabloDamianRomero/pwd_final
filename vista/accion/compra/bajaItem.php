<?php
$estructuraAMostrar = "desdeSubAccion";
$seguro=true;
include_once ("../../estructura/cabecera.php");

$datos=data_submitted();
if (isset($datos['idcompraitem'])){
    $abmItems=new abmCompraitem();
    $abmItems->baja(['idcompraitem'=>$datos['idcompraitem']]);
}

header("Location:../../carrito.php");

include_once("../../estructura/pie.php");
?>