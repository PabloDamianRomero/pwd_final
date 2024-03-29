<?php
class abmRol
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;

        if (array_key_exists('idrol', $param) and array_key_exists('rodescripcion', $param)) {
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['rodescripcion']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setear($param['idrol'], null);
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
        if (isset($param['idrol'])) {
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
        $param['idrol']=null;
        $elObjtRol = $this->cargarObjeto($param);
        if ($elObjtRol != null and $elObjtRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Por lo general no se usa ya que se utiliza borrado lógico ( es decir pasar de activo a inactivo)
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {   
        $abmMenuRol=new abmMenurol();
        $arrayMenuRol=$abmMenuRol->buscar(['idrol'=>$param['idrol']]);
        if (!empty($arrayMenuRol)){
            foreach ($arrayMenuRol as $obj){
                $obj->eliminar();   //Borra los objetos con claves foraneas de tabla MenuRol
            }
        }
        $abmUsuarioRol=new abmUsuariorol();
        $arrayUsuarioRol=$abmUsuarioRol->buscar(['idrol'=>$param['idrol']]);
        if (!empty($arrayUsuarioRol)){
            foreach ($arrayUsuarioRol as $obj){
                $obj->eliminar();   //Borra los objetos con claves foraneas de tabla UsuarioRol
            }
        }
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtRol = $this->cargarObjetoConClave($param);
            if ($elObjtRol!=null){
                if ($elObjtRol->eliminar()){
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
            $elObjtRol = $this->cargarObjeto($param);
            if ($elObjtRol != null and $elObjtRol->modificar()) {
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
            if (isset($param['idrol'])) {
                $where .= " and idrol =" . $param['idrol'];
            }

            if (isset($param['rodescripcion'])) {
                $where .= " and rodescripcion ='" . $param['rodescripcion'] . "'";
            }

        }
        $arreglo = Rol::listar($where);
        return $arreglo;
    }

    public function listado($param){
        $list=$this->buscar($param);
        $arreglo_salida=array();
        foreach($list as $elem){
            $nuevoElem['idrol']=$elem->getIdrol();
            $nuevoElem['rodescripcion']=$elem->getRodescripcion();
            array_push($arreglo_salida,$nuevoElem);
        }
        return $arreglo_salida;
    }
}
