<?php
class abmProducto
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Producto
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idproducto', $param) and array_key_exists('pronombre', $param) and array_key_exists('prodetalle', $param) and array_key_exists('prodeshabilitado',$param)) {
            if (!isset($param['proprecio'])){
                $param['proprecio']=0;
            }
            if (!isset($param['procantstock'])){
                $param['procantstock']=0;
            }
            $obj = new Producto();
            $obj->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'],$param['proprecio'], $param['prodeshabilitado'], $param['procantstock']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Producto
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idproducto'])) {
            $obj = new Producto();
            $obj->setIdproducto($param['idproducto']);
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
        if (isset($param['idproducto']))
            $resp = true;
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
        $param['idproducto']=null;
        $param['prodeshabilitado']=null;
        $elObjtProducto = $this->cargarObjeto($param);
        if ($elObjtProducto != null and $elObjtProducto->insertar()) {
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
        if ($this->seteadosCamposClaves($param)){
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto!=null){
                if ($elObjtProducto->eliminar()){
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
            $elObjtProducto = $this->cargarObjeto($param);
            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
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
            if (isset($param['idproducto'])) {
                $where .= " and idproducto =" . $param['idproducto'];
            }

            if (isset($param['pronombre'])) {
                $where .= " and pronombre ='" . $param['pronombre'] . "'";
            }

            if (isset($param['prodetalle'])) {
                $where .= " and prodetalle ='" . $param['prodetalle'] . "'";
            }
            if (isset($param['proprecio'])) {
                $where .= " and proprecio ='" . $param['proprecio'] . "'";
            }
            if (isset($param['prodeshabilitado'])){
                $where .= " and prodeshabilitado ='" . $param['prodeshabilitado'] . "'";
            }
            if (isset($param['procantstock'])) {
                $where .= " and procantstock ='" . $param['procantstock'] . "'";
            }

        }
        $arreglo = Producto::listar($where);
        return $arreglo;
    }

    public function cargarImagen($datos)
    {
        $nombreArchivoImagen=$datos['prodetalle'].".jpg";
        $dir = "../../archivos/productos/img/";

        $arrayRespuesta = array();
        $arrayRespuesta["respCarga"] = "";
        $arrayRespuesta["enlace"] = "";
        
        $texto = "";
        $error = "";
        $todoOK = true;

        if ($nombreArchivoImagen != "") {
            if ($todoOK && $_FILES["imagen"]["error"] <= 0) {
                $todoOK = true;
                $error = "";
            } else {
                $todoOK = false;
                $error = "ERROR: no se pudo cargar la imagen. No se pudo acceder al archivo Temporal";
            }

            $tipoJpeg = strpos(strtoupper($_FILES['imagen']["type"]), "JPEG");

            //Control del tipo .
            if ($todoOK && !$tipoJpeg) {
                $error = "ERROR: El archivo seleccionado no es una imagen jpeg.";
                $todoOK = false;
            }

        }
        // Copiar el archivo al servidor.
        if ($nombreArchivoImagen != "") {
            if ($todoOK && !copy($_FILES['imagen']['tmp_name'], $dir . $nombreArchivoImagen)) {
                $error = "ERROR: no se pudo cargar el archivo de imagen.";
                $todoOK = false;
            }
        }

        if (!$todoOK) {
            $texto = $error;
            $arrayRespuesta["errorMsg"] = $texto;
        }else{
            $arrayRespuesta["exitoMsg"]="La imagen fue cargada correctamente";
            $arrayRespuesta["enlace"] = $dir . $nombreArchivoImagen;
        }
        $arrayRespuesta["respuesta"]=$todoOK;
        return $arrayRespuesta;
    }

    public function cargarInfo($datos)
    {
        $nombreArchivo=$datos['prodetalle'].".txt";
        $dir = "../../archivos/productos/detalle/";

        $arrayRespuesta = array();
        $arrayRespuesta["respCarga"] = "";
        $arrayRespuesta["enlace"] = "";
        
        $texto = "";
        $error = "";
        $todoOK = true;

        if ($nombreArchivo != "") {
            if ($todoOK && $_FILES["texto"]["error"] <= 0) {
                $todoOK = true;
                $error = "";
            } else {
                $todoOK = false;
                $error = "ERROR: no se pudo cargar el archivo. No se pudo acceder al archivo Temporal";
            }

            $tipoTxt = strpos(strtoupper($_FILES['texto']["type"]), "PLAIN");

            //Control del tipo .
            if ($todoOK && !$tipoTxt) {
                $error = "ERROR: El archivo seleccionado no es txt.";
                $todoOK = false;
            }

        }
        // Copiar el archivo al servidor.
        if ($nombreArchivo != "") {
            if ($todoOK && !copy($_FILES['texto']['tmp_name'], $dir . $nombreArchivo)) {
                $error = "ERROR: no se pudo cargar el archivo.";
                $todoOK = false;
            }
        }

        if (!$todoOK) {
            $texto = $error;
            $arrayRespuesta["errorMsg"] = $texto;
        }else{
            $arrayRespuesta["exitoMsg"]="El archivo fue cargado correctamente";
            $arrayRespuesta["enlace"] = $dir . $nombreArchivo;
        }
        $arrayRespuesta["respuesta"]=$todoOK;
        return $arrayRespuesta;
    }
}
