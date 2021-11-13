<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail'])){
    $abmUs=new abmUsuario();
    $datos["uspass"] = md5($datos["uspass"]);
    $resp=$abmUs->modificacion($datos);
    if($resp){
        $sesion = new Session();
        if($sesion->activa()){
            $sesion->setUsuarioActual($datos['usnombre']);
            $sesion->setPass($datos['uspass']);
        }
    }
}else{
    $resp=false;
    $retorno['errorMsg']="No se pudo MODIFICAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>