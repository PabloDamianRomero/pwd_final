<?php
$titulo = "Index - Usuario";
$estructuraAMostrar = "desdeVista";
$seguro = true;
include_once "estructura/cabecera.php";
?>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div style="margin-top: 30px;">
        <h1>Componentes de Pc</h1>
    </div>
    <pre>
        <?php
        print_r($_SESSION);
        ?>
    </pre>
<div>

<?php
include_once "estructura/pie.php";
?>