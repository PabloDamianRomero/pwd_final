<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

$resp=false;
if (isset($datos['idrol'])){
    $abmRol=new abmRol();
    $resp=$abmRol->baja($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el rol.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>