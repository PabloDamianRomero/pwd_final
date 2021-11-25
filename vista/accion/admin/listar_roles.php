<?php
include_once("../../../configuracion.php");
$data=data_submitted();
$objControl=new abmRol();
$arreglo_salida=$objControl->listado($data);
echo json_encode($arreglo_salida);
?>