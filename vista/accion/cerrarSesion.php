<?php
    include_once("../../configuracion.php");
    $sesion = new Session();
    $sesion->cerrar();
    header('Location:../index.php');
?>