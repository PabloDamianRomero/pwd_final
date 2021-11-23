<?php
include_once "../../../configuracion.php";
$datos = data_submitted();

if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail']) && isset($datos['usdeshabilitado'])) {
    $abmUs = new abmUsuario();
    // Compruebo que la contraseña cumpla con el formato establecido
    // Contraseña de 8 a 10 caracteres. Debe contener 1 letra y 1 número.
    $validacion = false;
    $longitudPsw = strlen($datos['uspass']);
    if (($longitudPsw >= 8) && ($longitudPsw <= 10)) {
        $letra = false;
        $numero = false;
        for ($i = 0; $i < $longitudPsw; $i++) {
            if ($datos['uspass'][$i] == "0" ||
                $datos['uspass'][$i] == "1" ||
                $datos['uspass'][$i] == "2" ||
                $datos['uspass'][$i] == "3" ||
                $datos['uspass'][$i] == "4" ||
                $datos['uspass'][$i] == "5" ||
                $datos['uspass'][$i] == "6" ||
                $datos['uspass'][$i] == "7" ||
                $datos['uspass'][$i] == "8" ||
                $datos['uspass'][$i] == "9") {
                $numero = true;
            } else if ($datos['uspass'][$i] != " ") {
                $letra = true;
            }
        }
        if ($letra && $numero) {
            $validacion = true;
        }
        if ($validacion) {
            $datos["uspass"] = md5($datos["uspass"]);
            $resp = $abmUs->modificacion($datos);
            if ($resp) {
                $sesion->setUsuarioActual($datos['usnombre']);
                $sesion->setPass($datos['uspass']);
            }
        } else {
            $resp = false;
            $retorno['errorMsg'] = "Debe contener 1 letra y 1 número.";
        }
    } else {
        $resp = false;
        $retorno['errorMsg'] = "Logitud de contraseña incorrecta. Debe contener de 8 a 10 caracteres";
    }
} else {
    $resp = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el usuario.";
}
$retorno['respuesta'] = $resp;
echo json_encode($retorno);
