<?php
include_once "../../../configuracion.php";
$datos = data_submitted();
$retorno['respuesta'] =false;
if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail']) && isset($datos['usdeshabilitado'])) {
    $abmUs = new abmUsuario();
    $retorno=$abmUs->modificacion($datos);
} else {
    $retorno['errorMsg'] = "No se pudo MODIFICAR el usuario.";
}
echo json_encode($retorno);
