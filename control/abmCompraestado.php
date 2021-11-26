<?php
class abmCompraestado{
/**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compraestado
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idcompraestado',$param) and array_key_exists('idcompra',$param) and array_key_exists('idcompraestadotipo',$param) and array_key_exists('cefechaini',$param)){
            if (!isset($param['cefechafin'])){
                $param['cefechafin']="0000-00-00 00:00:00";
            }
            $obj = new CompraEstado();
            $abmCompra=new abmCompra();            
            $objCompra=$abmCompra->buscar(['idcompra'=>$param['idcompra']]);
            $abmCompraestadotipo=new abmCompraestadotipo();            
            $objCompraestadotipo=$abmCompraestadotipo->buscar(['idcompraestadotipo'=>$param['idcompraestadotipo']]);
            $obj->setear($param['idcompraestado'],$objCompra[0],$objCompraestadotipo[0],$param['cefechaini'],$param['cefechafin']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compraestado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idcompraestado'])){
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'],null,null,"","");
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestado']))
            $resp = true;
        if (isset($param['idcompra']))
            $resp = true;
        if (isset($param['idcompraestadotipo']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idcompraestado'] =null;
        $elObjtCompraEstado = $this->cargarObjeto($param);
        if ($elObjtCompraEstado!=null and $elObjtCompraEstado->insertar()){
            $resp = true;
        }
        return $resp;
        
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtCompraEstado = $this->cargarObjetoConClave($param);
            if ($elObjtCompraEstado!=null and $elObjtCompraEstado->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }


    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtCompraEstado = $this->cargarObjeto($param);
            if($elObjtCompraEstado!=null and $elObjtCompraEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idcompraestado']))
                $where.=" and idcompraestado =".$param['idcompraestado'];
            if  (isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];
            if  (isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo =".$param['idcompraestadotipo'];
            if  (isset($param['cefechaini']))
                 $where.=" and cefechaini ='".$param['cefechaini']."'";
            if  (isset($param['cefechafin']))
                 $where.=" and cefechafin ='".$param['cefechafin']."'";
        }
        $arreglo = CompraEstado::listar($where);  
        return $arreglo;
    }


    /**
     * 
     */
    public function cancelaCompra($param){
        $resp=false;
        $colEstados=$this->buscar(['idcompra'=>$param['idcompra']]);
        if (count($colEstados)==$param['idcompraestadotipo']){
            if ($param['cetdescripcion']=="iniciada" || $param['cetdescripcion']=="aceptada" || $param['cetdescripcion']=="enviada"){
                //Le doy fin al estado actual
                $resp=$this->modificacion(['idcompra'=>$param['idcompra'],'idcompraestado'=>$param['idcompraestado'],'idcompraestadotipo'=>$param['idcompraestadotipo'],'cefechaini'=>$param['cefechaini'],'cefechafin'=>date('Y-m-d H:i:s')]);
                if ($resp){
                    //Inicio cancelacion
                    $resp=$this->alta(['idcompra'=>$param['idcompra'],'idcompraestadotipo'=>4,'cefechaini'=>date('Y-m-d H:i:s'),'cefechafin'=>date('Y-m-d H:i:s')]);
                    if (!$resp){
                        $retorno['errorMsg']="Hubo un problema en la creacion del nuevo estado.";
                    }else{
                        //Retorno los items de la compra al stock del producto
                        $abmItem=new abmCompraitem();
                        $items=$abmItem->buscar(['idcompra'=>$param['idcompra']]);
                        foreach ($items as $item){
                            $cantidad=$item->getCicantidad();
                            $producto=$item->getObjProducto();
                            $cantidad+=$producto->getProcantstock();
                            $abmProducto=new abmProducto();
                            $resp=$abmProducto->modificacion(['idproducto'=>$producto->getIdproducto(),'pronombre'=>$producto->getPronombre(),'prodetalle'=>$producto->getProdetalle(),'proprecio'=>$producto->getProprecio(),'prodeshabilitado'=>$producto->getProdeshabilitado(),'procantstock'=>$cantidad]);
                        }
                    }
                    
                }else{
                    $respuesta['errorMsg']="Hubo un problema en la modificacion del estado.";
                }
            }else{
                $respuesta['errorMsg']="Solo puede cancelarse la compra si actualmente esta 'iniciada', 'aceptada' o 'enviada'.";
            }
        }else{
            $respuesta['errorMsg']="La compra ya se encuentra en un estado mas avanzado.";
        }
        
        $respuesta['respuesta']=$resp;
        return $respuesta;
    }

    public function cambiarEstado($param){
        $respuesta['resp']=false;
        $colEstados=$this->buscar(['idcompra'=>$param['idcompra']]);
        if (count($colEstados)==$param['idcompraestadotipo']){
            if ($param['cetdescripcion']=="iniciada" || $param['cetdescripcion']=="aceptada"){
                //Le doy fin al estado actual
                $respuesta['respuesta']=$this->modificacion(['idcompra'=>$param['idcompra'],'idcompraestado'=>$param['idcompraestado'],'idcompraestadotipo'=>$param['idcompraestadotipo'],'cefechaini'=>$param['cefechaini'],'cefechafin'=>date('Y-m-d H:i:s')]);
                if ($respuesta['respuesta']){
                    //Inicio un nuevo estado
                    if ($param['cetdescripcion']=="iniciada"){
                        $respuesta['respuesta']=$this->alta(['idcompra'=>$param['idcompra'],'idcompraestadotipo'=>2,'cefechaini'=>date('Y-m-d H:i:s')]);
                    }elseif($param['cetdescripcion']=="aceptada"){
                        $respuesta['respuesta']=$this->alta(['idcompra'=>$param['idcompra'],'idcompraestadotipo'=>3,'cefechaini'=>date('Y-m-d H:i:s')]);
                    }
                    if (!$respuesta['respuesta']){
                        $respuesta['errorMsg']="Hubo un problema en la creacion del nuevo estado.";
                    }
                    
                }else{
                    $respuesta['errorMsg']="Hubo un problema en la modificacion del estado.";
                }
            }else{
                $respuesta['errorMsg']="Solo puede actualizarse el estado si es 'iniciada' o 'aceptada'.";
            }
        }else{
            $respuesta['errorMsg']="La compra ya se encuentra en un estado mas avanzado.";
        }
        return $respuesta;
    }


    public function listado($param){
        $list=$this->buscar($param);
        $arreglo_salida=array();
        foreach($list as $elem){
            $nuevoElem['idcompraestado']=$elem->getIdcompraestado();
            $nuevoElem['idcompra']=$elem->getObjCompra()->getIdcompra();
            $nuevoElem['idcompraestadotipo']=$elem->getObjCompraestadotipo()->getIdcompraestadotipo();
            $nuevoElem['cetdescripcion']=$elem->getObjCompraestadotipo()->getCetdescripcion();
            $nuevoElem['cefechaini']=$elem->getCefechaini();
            $nuevoElem['cefechafin']=$elem->getCefechafin();
            array_push($arreglo_salida,$nuevoElem);
        }
        return $arreglo_salida;
    }

    public function listadoUnico(){
        $sesion = new Session();
        $abmUsuario = new abmUsuario();
        $usuario = $abmUsuario->buscar(["usnombre" => $sesion->getUsuarioActual()], ["uspass" => $sesion->getPass()]);
        $arreglo_salida=array();
        if (count($usuario)==1){
            $idusuario=$usuario[0]->getIdusuario();
            $objControl=new abmCompraestado();
            $list=$objControl->buscar(null);
            foreach($list as $elem){
                $idElem=$elem->getObjCompra()->getObjUsuario()->getIdusuario();
                //Debe coincidir el id guardado en el objeto con el del usuario actual
                if ($idElem==$idusuario){
                    $nuevoElem['idcompraestado']=$elem->getIdcompraestado();
                    $nuevoElem['idcompra']=$elem->getObjCompra()->getIdcompra();
                    $nuevoElem['idcompraestadotipo']=$elem->getObjCompraestadotipo()->getIdcompraestadotipo();
                    $nuevoElem['cetdescripcion']=$elem->getObjCompraestadotipo()->getCetdescripcion();
                    $nuevoElem['cefechaini']=$elem->getCefechaini();
                    $nuevoElem['cefechafin']=$elem->getCefechafin();
                    array_push($arreglo_salida,$nuevoElem);
                }
            }
        }
        return $arreglo_salida;
    }
}
?>