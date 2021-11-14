<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idmenu']) && isset($datos['menombre']) && isset($datos['medescripcion']) && isset($datos['idpadre']) && isset($datos['medeshabilitado'])){
    $abmUs=new abmMenu();
    $resp=$abmUs->modificacion($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo MODIFICAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>