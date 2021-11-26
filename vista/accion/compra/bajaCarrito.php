<?php
$estructuraAMostrar = "desdeSubAccion";
$seguro=true;
$titulo="Carrito Cancelado";
include_once ("../../estructura/cabecera.php");


$abmCompra=new abmCompra();
$abmCompra->bajaCarrito();
header("Location:../../carrito.php");

include_once("../../estructura/pie.php");

?>