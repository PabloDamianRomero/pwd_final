<?php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if ($datos['resp']=="exito"){
        echo "Operacion exitosa. Se esta revisando su compra.";
    }elseif($datos['resp']=="fallo"){
        echo "Hubo un error con la compra.";
    }
    include_once("../../estructura/pie.php");
?>