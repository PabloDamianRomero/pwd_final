<?php
class Session{
    private $usuarioActual;
    private $mensajeError;

    //Constructor que inicia la sesion
    public function __construct()
    {
        session_start();
    }

    // Actualiza las variables de sesion con los valores ingresados
    public function iniciar($nombreUsuario, $psw){
        $this->setUsuarioActual($nombreUsuario);
        $this->setPass($psw);
    }

    // Valida si la sesion actual tiene usuario y psw validos. Devuelve TRUE or FALSE
    public function validar(){
        $valido = false;
        $nombre = $this->getUsuarioActual();
        $pass = $this->getPass();
        $objAbm = new abmUsuario();
        $arreglo = $objAbm->buscar(['usnombre'=>$nombre,'uspass'=>$pass]);
        if (count($arreglo) == 1){ // Si el usuario existe en bd (tabla usuario)
            $this->setUsuarioActual($arreglo[0]->getUsnombre()); // Mantener formato (mayus/minus) en usuario segun bd
            //Chequeo que no haya sido dado de baja
            if ($arreglo[0]->getUsdeshabilitado() == "0000-00-00 00:00:00"){
                $valido = true;
            }else{
                $this->cerrar(); // borra los valores de $_SESSION y destruye sesión
                $this->setMensajeError("El usuario no está habilitado en la bd.");
            }
            //Chequeo que tenga un rol asignado
            $abmUsuarioRol = new abmUsuariorol();
            $arrayRel = $abmUsuarioRol->buscar(['idusuario'=>$arreglo[0]->getIdusuario()]);
            if (count($arrayRel) < 1){ // si no se encuentra el usuario en usuarioRol
                $valido = false;
                $this->cerrar(); // borra los valores de $_SESSION y destruye sesión
                $this->setMensajeError("El usuario no posee ningún rol en la bd.");
            }
        }else{
            $this->cerrar(); // borra los valores de $_SESSION y destruye sesión
            $this->setMensajeError("Usuario y/o contraseña incorrecto.");
        }
        return $valido;
    }

    // Devuelve TRUE o FALSE si la sesion esta activa o no
    public function activa(){
        $activa = false;
        if (isset($_SESSION['usuario'])){
            $activa = true;
        }
        return $activa;
    }

    // Devuelve el usuario logeado
    public function getUsuario(){
        $objUsuario = null;
        $abmUsuario = new abmUsuario();
        $arrayUs = $abmUsuario->buscar(['usnombre'=>$this->getUsuarioActual(),'uspass'=>$this->getPass()]);
        if (count($arrayUs) == 1){ // si se encontró
            $objUsuario = $arrayUs[0];
        }
        return $objUsuario;
    }

    // Devuelve array de roles del usuario logeado
    public function getRol(){
        $roles = [];
        $nombre = ['usnombre'=>$this->getUsuarioActual()];
        $abmUsuario = new abmUsuario();
        $arrBuscaUsuario = $abmUsuario->buscar($nombre);
        if (count($arrBuscaUsuario) == 1){ // si se encontró
            $id = $arrBuscaUsuario[0]->getIdusuario();
            $abmRelacion = new abmUsuariorol();
            $roles = $abmRelacion->buscar(['idusuario'=>$id]);
        }
        return $roles;
    }

     /**
     * Devuelve el rol activo del usuario logueado como arreglo
     */
    public function getRolActivo(){
        $abmRol = new AbmRol();
        $rol = null;
        if(isset($_SESSION['rolactivo'])){
            $rol = $abmRol->buscar(["idrol"=>$_SESSION['rolactivo']]);
            $rol = $rol[0];
        }
        return $rol;
    }

    public function setRolActivo($idrol){
        $ret = false;
        $roles = $this->getRol();
        $i = 0;
        while($i<count($roles) && !$ret){
            if($roles[$i]->getObjRol()->getIdrol() == $idrol){
                $_SESSION['rolactivo'] = $idrol;
                $ret = true;
            }
            $i++;
        }
    }
   
    // Cierra la sesion actual
    public function cerrar(){
        session_unset();
        session_destroy();
    }

    public function getUsuarioActual()
    {
        return $_SESSION['usuario'];
    }

    public function setUsuarioActual($usuario)
    {
        $_SESSION['usuario']=$usuario;
    }

    public function getPass()
    {
        return $_SESSION['pass'];
    }

    public function setPass($pass)
    {
        $_SESSION['pass']=$pass;
    }
   
    public function getMensajeError()
    {
        return $_SESSION['error'];
    }

    public function setMensajeError($mensajeError)
    {
        $_SESSION['error'] = $mensajeError;
    }
}
?>