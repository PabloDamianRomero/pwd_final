<?php
include_once "../../../configuracion.php";
$datos = data_submitted();

if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail'])) {
    $abmUs = new abmUsuario();
    $retorno = $abmUs->modificacion($datos);
} else {
    $retorno['respuesta'] = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el usuario.";
}
echo json_encode($retorno);
