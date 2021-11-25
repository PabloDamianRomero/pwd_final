<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();
    $resp=false;
    if (isset($datos['idcompraestado']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin']) && isset($datos['cetdescripcion'])){
        $abmEstado=new abmCompraestado();
        $colEstados=$abmEstado->buscar(['idcompra'=>$datos['idcompra']]);
        if (count($colEstados)==$datos['idcompraestadotipo']){
            if ($datos['cetdescripcion']=="iniciada"){
                //Le doy fin al estado actual
                $resp=$abmEstado->modificacion(['idcompra'=>$datos['idcompra'],'idcompraestado'=>$datos['idcompraestado'],'idcompraestadotipo'=>$datos['idcompraestadotipo'],'cefechaini'=>$datos['cefechaini'],'cefechafin'=>date('Y-m-d H:i:s')]);
                if ($resp){
                    //Inicio cancelacion
                    $resp=$abmEstado->alta(['idcompra'=>$datos['idcompra'],'idcompraestadotipo'=>4,'cefechaini'=>date('Y-m-d H:i:s')]);
                    if (!$resp){
                        $retorno['errorMsg']="Hubo un problema en la creacion del nuevo estado.";
                    }else{
                        //Retorno los items de la compra al stock del producto
                        $abmItem=new abmCompraitem();
                        $items=$abmItem->buscar(['idcompra'=>$datos['idcompra']]);
                        foreach ($items as $item){
                            $cantidad=$item->getCicantidad();
                            $producto=$item->getObjProducto();
                            $cantidad+=$producto->getProcantstock();
                            $abmProducto=new abmProducto();
                            $resp=$abmProducto->modificacion(['idproducto'=>$producto->getIdproducto(),'pronombre'=>$producto->getPronombre(),'prodetalle'=>$producto->getProdetalle(),'proprecio'=>$producto->getProprecio(),'prodeshabilitado'=>$producto->getProdeshabilitado(),'procantstock'=>$cantidad]);
                        }
                    }
                    
                }else{
                    $retorno['errorMsg']="Hubo un problema en la modificacion del estado.";
                }
            }else{
                $retorno['errorMsg']="Solo puede cancelar una compra 'iniciada'.";
            }
        }else{
            $retorno['errorMsg']="La compra ya se encuentra en un estado mas avanzado.";
        }
    }else{
        $retorno['errorMsg']="Faltan parámetros.";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>