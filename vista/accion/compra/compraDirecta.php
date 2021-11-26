<?php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if (isset($datos['idproducto']) && isset($datos['cicantidad'])){
        $abmCompra=new abmCompra();
        $header=$abmCompra->compraDirecta($datos);
        header($header);
    }else{
        header('Location:retornoCompra.php?resp=fallo');
    }

?>