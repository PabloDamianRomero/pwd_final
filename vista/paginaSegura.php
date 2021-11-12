<?php
$titulo = "Index - Usuario";
$estructuraAMostrar = "desdeVista";
$seguro = true;
include_once "estructura/cabecera.php";
?>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
        <div class="container">
            <h1 class="display-4">Compupartes</h1>
            <p class="lead">La tienda online de componentes de PC que estabas buscando.</p>
        </div>
    </div>
    <pre>
        <?php
        print_r($arrMenuPadre[0]); ?>
    </pre>
    <p><?php echo $arrMenuPadre[0]->getMenombre();?></p>
    <p>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!</p>
    <pre>
        <?php
        foreach ($arrSubMenu as $subMenu) {
            echo "<p>".$subMenu->getMenombre()."</p>";
        }
         ?>
    </pre>
<div>

<?php
include_once "estructura/pie.php";
?>