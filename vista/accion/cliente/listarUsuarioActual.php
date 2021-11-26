<?php
include_once "../../../configuracion.php";
$sesion = new Session();
$abmUsuario = new abmUsuario();
$arreglo_salida=$abmUsuario->listado(['usnombre'=>$sesion->getUsuarioActual(),'uspass'=>$sesion->getPass()]);
echo json_encode($arreglo_salida);
?>
