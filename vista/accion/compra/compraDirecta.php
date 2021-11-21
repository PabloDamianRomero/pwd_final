<?php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if (isset($datos['idproducto']) && isset($datos['cicantidad'])){
        $objUsuario=$sesion->getUsuario();
        $idusuario=$objUsuario->getIdusuario();
        $abmCompra=new abmCompra();
        $resp=$abmCompra->alta(['idusuario'=>$idusuario]);
        if ($resp['respuesta']){
            $abmCompItem=new abmCompraitem();
            $respItem=$abmCompItem->alta(["idproducto"=>$datos['idproducto'],"idcompra"=>$resp['idcompra'],"cicantidad"=>$datos['cicantidad']]);
            if ($respItem){
                header('Location:retornoCompra.php?resp=exito');
            }else{
                header('Location:retornoCompra.php?resp=fallo');
            }
            
        }else{
            header('Location:retornoCompra.php?resp=fallo');
        }

    }else{
        header('Location:retornoCompra.php?resp=fallo');
    }

?>