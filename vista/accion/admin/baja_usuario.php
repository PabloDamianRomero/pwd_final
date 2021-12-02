<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail']) && isset($datos['usdeshabilitado'])){    
    $abmUs=new abmUsuario();
    $resp=$abmUs->deshabilitarUsuario($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>