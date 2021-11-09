<?php
    include_once("../../configuracion.php");
    $datos = data_submitted();
    $objSesion = new Session();
    // $objSesion->iniciar($datos['usnombre'],md5($datos['uspass']));
    $objSesion->iniciar($datos['usnombre'], $datos['uspass']);
    $valido = $objSesion->validar();
    if ($valido){
        header("Location:../index.php");
        exit();
    }else{
        $msj = $objSesion->getMensajeError();
        // $objSesion->cerrar(); // no haría falta, ya que cierra sesión en metodo validar
        header("Location:../login.php?error=$msj");
        exit();
    }
?>