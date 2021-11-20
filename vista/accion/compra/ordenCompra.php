<?php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if (isset($datos['idproducto']) && isset($datos['cantidad'])){
        $objUsuario=$sesion->getUsuario();
        $idusuario=$objUsuario->getIdusuario();
        $abmCompra=new abmCompra();
        $resp=$abmCompra->alta(['idusuario'=>$idusuario]);
        if (isset($datos['orden'])){
            if ($resp['respuesta']){
                $abmCompItem=new abmCompraitem();
                $respItem=$abmCompItem->alta(['idproducto'=>$datos['idproducto'],'idcompra'=>$resp['idcompra'],'cicantidad'=>$datos['cantidad']]);
                header("Location:../../productos.php?idproducto=".$datos['idproducto']);
            }else{
                header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1");
            }
        }elseif (isset($datos['compra'])){
            if ($resp['respuesta']){
                $abmCompItem=new abmCompraitem();
                $respItem=$abmCompItem->alta(['idproducto'=>$datos['idproducto'],'idcompra'=>$resp['idcompra'],'cicantidad'=>$datos['cantidad']]);
                header("Location:../../carrito.php");
            }else{
                header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1");
            }
        }
    }else{
        header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1"); 
    }
    include_once("../../estructura/pie.php");
?>