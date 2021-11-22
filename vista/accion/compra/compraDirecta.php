<?php
    $estructuraAMostrar = "desdeSubAccion";
    $seguro=true;
    include_once("../../estructura/cabecera.php");
    $datos=data_submitted();
    if (isset($datos['idproducto']) && isset($datos['cicantidad'])){
        $objUsuario=$sesion->getUsuario();
        $idusuario=$objUsuario->getIdusuario();
        //Doy de alta la compra
        $abmCompra=new abmCompra();
        $resp=$abmCompra->alta(['idusuario'=>$idusuario, 'metodo'=>'normal']);
        if ($resp['respuesta']){
            //Doy de alta a la compra de items
            $abmCompItem=new abmCompraitem();
            $respItem=$abmCompItem->alta(["idproducto"=>$datos['idproducto'],"idcompra"=>$resp['idcompra'],"cicantidad"=>$datos['cicantidad']]);            
            if ($respItem){
                //Pongo la compra en estado 'iniciada'
                $abmEstado=new abmCompraestado();
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $respEst=$abmEstado->alta(['idcompra'=>$resp['idcompra'],'idcompraestadotipo'=>1,'cefechaini'=>date('Y-m-d H:i:s')]);
                if ($respEst){
                    //Resto los items comprados del stock
                    $abmProd=new abmProducto();
                    $producto=$abmProd->buscar(['idproducto'=>$datos['idproducto']]);
                    if (count($producto)==1){
                        $cantidad=($producto[0]->getProcantstock())-($datos['cicantidad']);
                        $respProd=$abmProd->modificacion(['idproducto'=>$producto[0]->getIdproducto(),'pronombre'=>$producto[0]->getPronombre(),'prodetalle'=>$producto[0]->getProdetalle(),'proprecio'=>$producto[0]->getProprecio(),'prodeshabilitado'=>$producto[0]->getProdeshabilitado(),'procantstock'=>$cantidad]);
                        if ($respProd){
                            header('Location:retornoCompra.php?resp=exito');
                        }else{
                            header('Location:retornoCompra.php?resp=fallo');
                        }
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

    }else{
        header('Location:retornoCompra.php?resp=fallo');
    }

?>