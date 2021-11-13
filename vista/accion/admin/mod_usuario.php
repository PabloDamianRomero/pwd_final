<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail'])){
    $abmUs=new abmUsuario();
    $resp=$abmUs->modificacion($datos);
}else{
    $resp=false;
    $retorno['errorMsg']="No se pudo MODIFICAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>