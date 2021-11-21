<?php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if (isset($datos['idproducto']) && isset($datos['cicantidad'])){
        $objUsuario=$sesion->getUsuario();
        $idusuario=$objUsuario->getIdusuario();
        $abmCompra=new abmCompra();
        $resp=$abmCompra->alta(['idusuario'=>$idusuario, 'metodo'=>'normal']);
        if ($resp['respuesta']){
            $abmCompItem=new abmCompraitem();
            $respItem=$abmCompItem->alta(["idproducto"=>$datos['idproducto'],"idcompra"=>$resp['idcompra'],"cicantidad"=>$datos['cicantidad']]);
            if ($respItem){
                $abmEstado=new abmCompraestado();
                $respEst=$abmEstado->alta(['idcompra'=>$resp['idcompra'],'idcompraestadotipo'=>1,'cefechaini'=>date('Y-m-d H:i:s')]);
                if ($respEst){
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

    }else{
        header('Location:retornoCompra.php?resp=fallo');
    }

?>