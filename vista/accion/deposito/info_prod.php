<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$abmProd=new abmProducto();
$retorno=$abmProd->cargarInfo($datos);
echo json_encode($retorno);
?>