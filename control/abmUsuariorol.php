<?php
class abmUsuariorol{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuariorol
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idusuario',$param) and array_key_exists('idrol',$param)){
            $objUsuario=new Usuario();
            $objUsuario->setIdusuario($param['idusuario']);
            $objUsuario->cargar();
            $objRol=new Rol();
            $objRol->setIdrol($param['idrol']);
            $objRol->cargar();
            $obj = new UsuarioRol();
            $obj->setear($objUsuario,$objRol);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuariorol
     */
    // private function cargarObjetoConClave($param){
    //     $obj = null;
        
    //     if( isset($param['idusuario']) && isset($param['idrol']) ){
    //         //         $obj = new UsuarioRol();
    //         //         $obj->setIdRol($param['idrol']);
    //         //         $obj->setIdUsuario($param['idusuario']);
    //         //     }
    //     return $obj;
    // }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $elObjtUsuariorol = $this->cargarObjeto($param);
        if ($elObjtUsuariorol!=null and $elObjtUsuariorol->insertar()){
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
            $elObjtUsuariorol = $this->cargarObjeto($param);
            if ($elObjtUsuariorol!=null and $elObjtUsuariorol->eliminar()){
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
            $elObjtUsuariorol = $this->cargarObjeto($param);
            if($elObjtUsuariorol!=null and $elObjtUsuariorol->modificar()){
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
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['idrol']))
                 $where.=" and idrol ='".$param['idrol']."'";
        }
        $arreglo = UsuarioRol::listar($where);  
        return $arreglo;
    }


    public function listado($param){
        $list=$this->buscar($param);
        $arreglo_salida=array();
        foreach($list as $elem){
            $nuevoElem['idusuario']=$elem->getObjUsuario()->getIdusuario();
            $abmUs=new abmUsuario();
            $arrUs=$abmUs->buscar(['idusuario'=>$elem->getObjUsuario()->getIdusuario()]);
            if (!empty($arrUs)){
                $nuevoElem['usnombre']=$arrUs[0]->getUsnombre();
            }else{
                $nuevoElem['usnombre']="";
            }
            $nuevoElem['idrol']=$elem->getObjRol()->getIdrol();
            $abmRol=new abmRol();
            $arrRol=$abmRol->buscar(['idrol'=>$elem->getObjRol()->getIdrol()]);
            if (!empty($arrRol)){
                $nuevoElem['rodescripcion']=$arrRol[0]->getRodescripcion();
            }else{
                $nuevoElem['rodescripcion']="";
            }
            
            array_push($arreglo_salida,$nuevoElem);
        }
    }

}
?>