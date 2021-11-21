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
            //Busco compras agregadas al carrito por el usuario activo
            $comprasUs=$abmCompra->buscar(['idusuario'=>$idusuario,'metodo'=>'carrito']);
            if (!empty($comprasUs)){
                if (count($comprasUs)==1){  //Solo puede haber 1 carrito activo
                    $abmCompItem=new abmCompraitem();
                    $respItem=$abmCompItem->alta(['idproducto'=>$datos['idproducto'],'idcompra'=>$comprasUs[0]->getIdcompra(),'cicantidad'=>$datos['cantidad']]);
                    if ($respItem){
                        header('Location:../../carrito.php');
                    }else{
                        header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1");
                    }
                }else{
                    header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1");
                }
            }else{  //Si no hay carritos activos inicio uno.
                $resp=$abmCompra->alta(['idusuario'=>$idusuario,'metodo'=>'carrito']);
                if ($resp['respuesta']){
                    $abmCompItem=new abmCompraitem();
                    $respItem=$abmCompItem->alta(['idproducto'=>$datos['idproducto'],'idcompra'=>$resp['idcompra'],'cicantidad'=>$datos['cantidad']]);
                    if ($respItem){
                        header('Location:../../carrito.php');
                    }else{
                        header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1");
                    }
                }else{
                    header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1");
                }
            }

        }elseif (isset($datos['compra'])){
            header('Location:../../tiendaCompra.php?metodo=directa&idproducto='.$datos['idproducto'].'&cantidad='.$datos['cantidad']);

        }
    }else{
        header("Location:../../productos.php?idproducto=".$datos['idproducto']."&error=1"); 
    }
    include_once("../../estructura/pie.php");
?>