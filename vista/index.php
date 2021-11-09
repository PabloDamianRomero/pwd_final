<?php
    $titulo = "Pagina Segura";
    $estructuraAMostrar = "desdeVista";
    $seguro = true;
    include_once "estructura/cabecera.php";

    

    echo '<div style="margin-bottom: 20%" class="container-fluid text-center">
        <h1>Bienvenid@ '.$sesion->getUsuarioActual().'</h1>
        </div>';

include_once "estructura/pie.php";
?>