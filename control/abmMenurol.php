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
        //echo "Estoy en modificacion";
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

}
?>