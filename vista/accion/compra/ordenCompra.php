<?php
    //accion del formulario en la pagina productos.php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if (isset($datos['idproducto']) && isset($datos['cantidad'])){
        $abmCompra=new abmCompra();
        $header=$abmCompra->ordenCompra($datos);
        header($header);
        
    }else{
        header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1"); 
    }
?>