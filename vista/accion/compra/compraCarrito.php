<?php
    $estructuraAMostrar = "desdeSubAccion";
    include_once("../../estructura/cabecera.php");

$datos=data_submitted();
if (isset($datos['idcompra'])){
    $abmCompra=new AbmCompra();
    $resp=$abmCompra->compraCarrito($datos);
    header($resp);
}else{
    header("Location:retornoCompra.php?resp=fallo");
}
?>