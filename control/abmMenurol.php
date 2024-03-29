<?php
class abmMenurol{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menurol
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idmenu',$param) and array_key_exists('idrol',$param)){
            $objMenu=new Menu();
            $objMenu->setIdmenu($param['idmenu']);
            $objMenu->cargar();
            $objRol=new Rol();
            $objRol->setIdrol($param['idrol']);
            $objRol->cargar();
            $obj = new MenuRol();
            $obj->setear($objMenu,$objRol);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menurol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idmenu']) && isset($param['idrol']) ){
            $abmMenu=new abmMenu();
            $objMenu=$abmMenu->buscar(['idmenu'=>$param['idmenu']]);
            $abmRol=new abmRol();
            $objRol=$abmRol->buscar(['idrol'=>$param['idrol']]);
            $obj = new MenuRol();
            $obj->setear($objMenu[0],$objRol[0]);
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
        if (isset($param['idmenu']) && isset($param['idrol']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        //$param['idmenu'] =null;
        $elObjtMenurol = $this->cargarObjeto($param);
        if ($elObjtMenurol!=null and $elObjtMenurol->insertar()){
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
            $elObjtMenurol = $this->cargarObjetoConClave($param);
            if ($elObjtMenurol!=null and $elObjtMenurol->eliminar()){
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
            $elObjtMenurol = $this->cargarObjeto($param);
            if($elObjtMenurol!=null and $elObjtMenurol->modificar()){
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
            if  (isset($param['idmenu']))
                $where.=" and idmenu =".$param['idmenu'];
            if  (isset($param['idrol']))
                 $where.=" and idrol ='".$param['idrol']."'";
        }
        $arreglo = MenuRol::listar($where);  
        return $arreglo;
    }

    public function listado($param){
        $list=$this->buscar($param);
        $arreglo_salida=array();
        foreach($list as $elem){
            $nuevoElem['idmenu']=$elem->getObjMenu()->getIdmenu();
            $abmMe=new abmMenu();
            $arrMe=$abmMe->buscar(['idmenu'=>$elem->getObjMenu()->getIdmenu()]);
            if (!empty($arrMe)){
                $nuevoElem['menombre']=$arrMe[0]->getMenombre();
            }else{
                $nuevoElem['menombre']="";
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
        return $arreglo_salida;
    }

}
?>