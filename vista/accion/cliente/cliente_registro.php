<?php
include_once "../../../configuracion.php";
$datos = data_submitted();
$resp = false;
if (isset($datos['usnombre']) && isset($datos['uspass'])
    && isset($datos['usmail'])) {
    $datos['uspass'] = md5($datos['uspass']);
    $abmUs = new abmUsuario();
    $usuarioExiste = $abmUs->buscar($datos);
    if (!$usuarioExiste) { // si no existe el usuario
        $resp = $abmUs->alta($datos);
        if ($resp) { // si el usuario se pudo insertar en bd
            $arrUser = $abmUs->buscar($datos);
            if (count($arrUser) > 0) {
                $objUsuario = $arrUser[0];
                $idUsuario = $objUsuario->getIdusuario();
                $datos['idusuario'] = $idUsuario;
                $datos['idrol'] = 3;
                $abmUsRol = new abmUsuariorol();
                $resp = $abmUsRol->alta($datos);
                if ($resp) {
                    $reg = "ALTA USUARIO-ROL EXITOSA.";
                    header("Location:../../login.php?reg=" . $reg);
                    exit();
                } else {
                    $respBaja = $abmUs->baja($datos['idusuario']); // si no pudo insertar en usuariorol pero si en usuario, borro el usuario
                    $reg = "No se pudo registrar el usuario cliente.";
                    header("Location:../../registro.php?reg=" . $reg);
                    exit();
                }
            }
        } else {
            $reg = "No se pudo guardar el usuario";
            header("Location:../../registro.php?reg=" . $reg);
            exit();
        }
    }else{
        $reg = "El usuario ya existe";
        header("Location:../../registro.php?reg=" . $reg);
        exit();
    }
} else {
    $reg = "Faltan datos o son incorrectos.";
    header("Location:../../registro.php?reg=" . $reg);
    exit();
}
