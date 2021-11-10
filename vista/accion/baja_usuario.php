<?php
include_once("../../configuracion.php");
$datos=data_submitted();
$resp=false;

if (isset($datos['idusuario'])){
    $abmUs=new abmUsuario();
    $resp=$abmUs->baja($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>