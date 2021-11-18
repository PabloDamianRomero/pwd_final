<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail']) && isset($datos['usdeshabilitado'])){
    $abmUs=new abmUsuario();
    
    
    
        $sesion = new Session();
        if($sesion->activa()){
            if($datos["uspass"] != $sesion->getPass()){
                $datos["uspass"] = md5($datos["uspass"]);
                $resp=$abmUs->modificacion($datos);
                if($resp){
                    $sesion->setUsuarioActual($datos['usnombre']);
                    $sesion->setPass($datos['uspass']);
                }
            }else{
                $resp=false;
                $retorno['errorMsg']="Debe actualizar la contraseña";
            }
            
        }
    
        
}else{
    $resp=false;
    $retorno['errorMsg']="No se pudo MODIFICAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>