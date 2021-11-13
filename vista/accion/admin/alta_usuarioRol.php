<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idusuario']) && isset($datos['idrol'])){
    $abmUs=new abmUsuariorol();
    $resp=$abmUs->alta($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo dar de ALTA el usuarioRol.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>