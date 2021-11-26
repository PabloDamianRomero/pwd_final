<?php
include_once("../../../configuracion.php");
$objControl=new abmCompraestado();
$arreglo_salida=$objControl->listadoUnico();
echo json_encode($arreglo_salida);
?>