<?php
$titulo = "Index";
$estructuraAMostrar = "desdeVista";
$seguro = true;
include_once "estructura/cabecera.php";
?>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div style="margin-top: 30px;">
        <h1>Bienvenid@ <?php echo $sesion->getUsuarioActual(); ?></h1>
    </div>
<div>

<?php
include_once "estructura/pie.php";
?>