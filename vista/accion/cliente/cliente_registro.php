<?php
include_once "../../../configuracion.php";
$datos = data_submitted();
if (isset($datos['usnombre']) && isset($datos['uspass'])
    && isset($datos['usmail'])) {
    $abmUs = new abmUsuario();
    $retorno=$abmUs->registroUs($datos);
    if (isset($retorno['enlace'])){
        header($retorno['enlace']);
    }
} else {
    $reg = "Faltan datos o son incorrectos.";
    header("Location:../../registro.php?reg=" . $reg);
}
