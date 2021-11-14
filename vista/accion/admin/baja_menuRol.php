<?php
include_once("../../../configuracion.php");

$datos=data_submitted();
$resp=false;
if (isset($datos['idmenu']) && isset($datos['idrol'])){
    $abmMe=new abmMenurol();
    $resp=$abmMe->baja($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el menuRol.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>