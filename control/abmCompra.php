<?php
class abmCompra
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idcompra', $param) and array_key_exists('cofecha', $param)
            and array_key_exists('idusuario', $param)) {

            //creo objeto estadotipos
            $objUsuario = new Usuario();
            $objUsuario->getIdUsuario($param['idusuario']); // ????? VERIFICAR ESTO
            $objUsuario->cargar();

            //agregarle los otros objetos
            $obj = new Compra();
            $obj->setear($param['idcompra'], $param['cofecha'], $objUsuario);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->setear($param['idcompra'], null, null);
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
        if (isset($param['idcompra'])) {
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
        $param['idcompra'] = null;
        $elObjtArchivoE = $this->cargarObjeto($param);
        if ($elObjtArchivoE != null and $elObjtArchivoE->insertar()) {
            $resp = true;
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
        if ($this->seteadosCamposClaves($param)) {
            $elObjtArchivoE = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoE != null and $elObjtArchivoE->eliminar()) {
                $resp = true;
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
            $elObjtArchivoE = $this->cargarObjeto($param);
            if ($elObjtArchivoE != null and $elObjtArchivoE->modificar()) {
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
            if (isset($param['idcompra'])) {
                $where .= " and idcompra =" . $param['idcompra'];
            }

            if (isset($param['cofecha'])) {
                $where .= " and cofecha ='" . $param['cofecha'] . "'";
            }

            if (isset($param['idusuario'])) {
                $where .= " and idusuario ='" . $param['idusuario'] . "'";
            }

        }
        $arreglo = Compra::listar($where);
        return $arreglo;
    }
}