<?php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if (isset($datos['idproducto']) && isset($datos['cantidad'])){
        
        if (isset($datos['orden'])){
            $objUsuario=$sesion->getUsuario();
            $idusuario=$objUsuario->getIdusuario();
            $abmCompra=new abmCompra();
            $resp=$abmCompra->alta(['idusuario'=>$idusuario]);
            if ($resp['respuesta']){
                $abmCompItem=new abmCompraitem();
                $respItem=$abmCompItem->alta(['idproducto'=>$datos['idproducto'],'idcompra'=>$resp['idcompra'],'cicantidad'=>$datos['cantidad']]);
                header("Location:../../productos.php?idproducto=".$datos['idproducto']);
            }else{
                header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1");
            }
        }elseif (isset($datos['compra'])){
            header('Location:../../tiendaCompra.php?metodo=directa&idproducto='.$datos['idproducto'].'&cantidad='.$datos['cantidad']);

        }
    }else{
        header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1"); 
    }
    include_once("../../estructura/pie.php");
?>