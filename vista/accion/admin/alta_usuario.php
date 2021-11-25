<?php
include_once "../../../configuracion.php";
$datos = data_submitted();
if (isset($datos['usnombre']) && isset($datos['uspass'])) {
    $abmUs = new abmUsuario();
    $retorno = $abmUs->alta($datos);
} else {
    $retorno['respuesta'] = false;
    $retorno['errorMsg'] = "No se pudo dar de ALTA al usuario";
}
echo json_encode($retorno);
