<?php
class abmUsuario
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idusuario', $param) and array_key_exists('usnombre', $param)
            and array_key_exists('uspass', $param) and array_key_exists('usdeshabilitado', $param)) {
            if (!isset($param['usmail'])){
                $param['usmail']="";
            }
            $obj = new Usuario();
            $obj->setear(
                $param['idusuario'],
                $param['usnombre'],
                $param['uspass'],
                $param['usmail'],
                $param['usdeshabilitado']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], "", "", "", null);
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
        if (isset($param['idusuario'])) {
            $resp = true;
        }

        return $resp;
    }

    /**
     *
     * @param array $param
     */
    public function alta($param)
    {
        $resp['respuesta'] = false;
        $validacion=$this->validacion($param);
        if ($validacion['valid']) {
            $param['uspass'] = md5($param['uspass']);
            $param['idusuario'] = null;
            $param['usdeshabilitado']=null;
            $elObjtUsuario = $this->cargarObjeto($param);
            if ($elObjtUsuario != null and $elObjtUsuario->insertar()) {
                $resp['respuesta'] = true;
            }
        } else {
            $resp['respuesta'] = false;
            if (!isset($validacion['errorMsg'])){
                $resp['errorMsg'] = "Debe contener 1 letra y 1 número.";
            }else{
                $resp['errorMsg'] =$validacion['errorMsg'];
            }
            
        }
        
        return $resp;

    }
    /**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtUsuario = $this->cargarObjetoConClave($param);
            if ($elObjtUsuario!=null){
                if ($elObjtUsuario->eliminar()){
                    $resp = true;
                }
            }
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp['respuesta'] = false;
        $validacion=$this->validacion($param);
        if ($validacion['valid']) {
            $param['uspass'] = md5($param['uspass']);
            if ($param['usdeshabilitado']=="0000-00-00 00:00:00"){
                $date = date('Y-m-d H:i:s');
                $param['usdeshabilitado']=$date;  //Si estaba activo ahora ingresa la fecha actual
            }else{
                $param['usdeshabilitado']="0000-00-00 00:00:00"; //Si estaba inactivo ahora lo setea en nulo (lo activa)
            }
            if ($this->seteadosCamposClaves($param)) {
                $elObjtUsuario = $this->cargarObjeto($param);
                if ($elObjtUsuario != null and $elObjtUsuario->modificar()) {
                    $resp['respuesta'] = true;
                }
            }
        }else {
            $resp['respuesta'] = false;
            if (!isset($validacion['errorMsg'])){
                $resp['errorMsg'] = "Debe contener 1 letra y 1 número.";
            }else{
                $resp['errorMsg'] =$validacion['errorMsg'];
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
            if (isset($param['idusuario'])) {
                $where .= " and idusuario =" . $param['idusuario'];
            }

            if (isset($param['usnombre'])) {
                $where .= " and usnombre ='" . $param['usnombre'] . "'";
            }

            if (isset($param['uspass'])) {
                $where .= " and uspass ='" . $param['uspass'] . "'";
            }

            if (isset($param['usmail'])) {
                $where .= " and usmail ='" . $param['usmail'] . "'";
            }

            if (isset($param['usdeshabilitado'])) {
                $where .= " and usdeshabilitado ='" . $param['usdeshabilitado'] . "'";
            }

        }
        $arreglo = Usuario::listar($where);
        return $arreglo;

    }


    public function validacion($param){
        // Compruebo que la contraseña cumpla con el formato establecido
        // Contraseña de 8 a 10 caracteres. Debe contener 1 letra y 1 número.
        $validacion = false;
        $longitudPsw = strlen($param['uspass']);
        if (($longitudPsw >= 8) && ($longitudPsw <= 10)) {
            $letra = false;
            $numero = false;
            for ($i = 0; $i < $longitudPsw; $i++) {
                if ($param['uspass'][$i] == "0" ||
                    $param['uspass'][$i] == "1" ||
                    $param['uspass'][$i] == "2" ||
                    $param['uspass'][$i] == "3" ||
                    $param['uspass'][$i] == "4" ||
                    $param['uspass'][$i] == "5" ||
                    $param['uspass'][$i] == "6" ||
                    $param['uspass'][$i] == "7" ||
                    $param['uspass'][$i] == "8" ||
                    $param['uspass'][$i] == "9") {
                    $numero = true;
                } else if ($param['uspass'][$i] != " ") {
                    $letra = true;
                }
            }
            if ($letra && $numero) {
                $validacion = true;
            }
            $retorno['valid'] = $validacion;
        } else {
            $retorno['valid'] = $validacion;
            $retorno['errorMsg'] = "Logitud de contraseña incorrecta. Debe contener de 8 a 10 caracteres.";
        }
        
        return $retorno;
    }

    public function listado($param){
        $list=$this->buscar($param);
        $arreglo_salida=array();
        foreach($list as $elem){
            $nuevoElem['idusuario']=$elem->getIdusuario();
            $nuevoElem['usnombre']=$elem->getUsnombre();
            $nuevoElem['uspass']=$elem->getUspass();
            $nuevoElem['usmail']=$elem->getUsmail();
            $nuevoElem['usdeshabilitado']=$elem->getUsdeshabilitado();
            array_push($arreglo_salida,$nuevoElem);
        }
        return $arreglo_salida;
    }


    public function registroUs($datos){
        $resp=false;
        $usuarioExisteConMail = $this->buscar($datos);
        $usuarioExisteSinMail = $this->buscar(["usnombre" => $datos['usnombre'],"uspass" => md5($datos['uspass'])]);
        if (!$usuarioExisteConMail && !$usuarioExisteSinMail) { // si no existe el usuario con o sin mail
            $resp = $this->alta($datos);
            if ($resp['respuesta']) { // si el usuario se pudo insertar en bd
                $datos['uspass'] = md5($datos['uspass']);
                $arrUser = $this->buscar($datos);
                if (count($arrUser) > 0) {
                    $objUsuario = $arrUser[0];
                    $idUsuario = $objUsuario->getIdusuario();
                    $datos['idusuario'] = $idUsuario;
                    $datos['idrol'] = 3;
                    $abmUsRol = new abmUsuariorol();
                    $resp = $abmUsRol->alta($datos);
                    if ($resp) {
                        $reg = "ALTA USUARIO-ROL EXITOSA.";
                        $retorno['enlace']="Location:../../login.php?reg=" . $reg;
                    } else {
                        $respBaja = $this->baja($datos['idusuario']); // si no pudo insertar en usuariorol pero si en usuario, borro el usuario
                        $reg = "No se pudo registrar el usuario cliente.";
                        $retorno['enlace']="Location:../../registro.php?reg=" . $reg;
                    }
                }
            } else {
                $reg = "No se pudo guardar el usuario. ".$resp['errorMsg'];
                $retorno['enlace']="Location:../../registro.php?reg=" . $reg;
            }
        }else{
            $reg = "El usuario ya existe";
            $retorno['enlace']="Location:../../registro.php?reg=" . $reg;
        }
        return $retorno;
    }

}
