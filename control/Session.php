<?php
class Session{
    private $usuarioActual;
    private $mensajeError;

    //Constructor que inicia la sesion
    public function __construct()
    {
        session_start();
    }

    public function getUsuarioActual()
    {
        return $_SESSION['usuario'];
    }

    public function setUsuarioActual($usuario)
    {
        $_SESSION['usuario']=$usuario;
    }
   
    public function getMensajeError()
    {
        return $_SESSION['error'];
    }

    public function setMensajeError($mensajeError)
    {
        $_SESSION['error'] = $mensajeError;
    }

    // Actualiza las variables de sesion con los valores ingresados
    public function iniciar($nombreUsuario){
        $this->setUsuarioActual($nombreUsuario);
    }
    // Valida si la sesion actual tiene usuario y psw validos. Devuelve TRUE or FALSE
    public function validar(){
       
    }

    // Devuelve TRUE o FALSE si la sesion esta activa o no
    public function activa(){

    }
   
    // Cierra la sesion actual
    public function cerrar(){
        session_unset();
        session_destroy();
    }


    
}
?>