<?php
class abmMenu
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idmenu', $param) and array_key_exists('menombre', $param) and array_key_exists('medeshabilitado', $param)) {
            $obj = new Menu();
            $objPadre=null;
            if (isset($param['idpadre'])){
                $objPadre=new Menu();
                $objPadre->setIdmenu($param['idpadre']);
                $objPadre->cargar();
            }
            if (!isset($param['medescripcion'])){
                $param['medescripcion']="";
            }
            $obj->setear($param['idmenu'], $param['menombre'], $param['medescripcion'], $objPadre, $param['medeshabilitado']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idmenu'])) {
            $obj = new Menu();
            $obj->setIdmenu($param['idmenu']);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenu'])) {
            $resp = true;
        }

        return $resp;
    }

    /**
     * Carga un objeto con los datos pasados por parámetro y lo
     * Inserta en la base de datos
     * @param array $param
     * @return boolean
     */
    public function alta($param)
    {
        $resp = false;
        $param['idmenu']=null;
        $param['medeshabilitado']=null;
        $elObjtMenu = $this->cargarObjeto($param);
        if ($elObjtMenu != null and $elObjtMenu->insertar()) {
            $resp = true;
        }else{
            if ($elObjtMenu!=null){
                $resp=$elObjtMenu->getMensajeoperacion();
            }
        }
        return $resp;
    }

    /**
     *
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtMenu = $this->cargarObjetoConClave($param);
            if ($elObjtMenu!=null){
                if ($elObjtMenu->eliminar()){
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    /**
     * Carga un obj con los datos pasados por parámetro y lo modifica en base de datos (update)
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenu = $this->cargarObjeto($param);
            if ($elObjtMenu != null and $elObjtMenu->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Cambia el estado del menú
     * @param array $param
     * @return boolean
     */
    public function deshabilitarMenu($param)
    {
        $resp = false;
        if ($param['medeshabilitado']=="0000-00-00 00:00:00"){
            $date = date('Y-m-d H:i:s');
            $param['medeshabilitado']=$date;  //Si estaba activo ahora ingresa la fecha actual
        }else{
            $param['medeshabilitado']="0000-00-00 00:00:00"; //Si estaba inactivo ahora lo setea en nulo (lo activa)
        }
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenu = $this->cargarObjeto($param);
            if ($elObjtMenu != null and $elObjtMenu->modificar()) {
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
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idmenu'])) {
                $where .= " and idmenu =" . $param['idmenu'];
            }

            if (isset($param['menombre'])) {
                $where .= " and menombre ='" . $param['menombre'] . "'";
            }

            if (isset($param['medescripcion'])) {
                $where .= " and medescripcion ='" . $param['medescripcion'] . "'";
            }

            if (isset($param['idpadre'])) {
                $where .= " and idpadre =" . $param['idpadre'];
            }

            if (isset($param['medeshabilitado'])) {
                $where .= " and medeshabilitado ='" . $param['medeshabilitado'] . "'";
            }

        }
        $arreglo = Menu::listar($where);
        return $arreglo;
    }

    public function listado($param){
        $list=$this->buscar($param);
        $arreglo_salida=array();
        foreach($list as $elem){
            $nuevoElem['idmenu']=$elem->getIdmenu();
            $nuevoElem['menombre']=$elem->getMenombre();
            $nuevoElem['medescripcion']=$elem->getMedescripcion();
            if ($elem->getObjMenu()!=null){
                $nuevoElem['idpadre']=$elem->getObjMenu()->getidMenu();
            }else{
                $nuevoElem['idpadre']=null;
            }
            $nuevoElem['medeshabilitado']=$elem->getMedeshabilitado();
            array_push($arreglo_salida,$nuevoElem);
        }
        return $arreglo_salida;
    }
}
