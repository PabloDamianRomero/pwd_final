<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idmenu']) && isset($datos['menombre']) && isset($datos['medescripcion']) && isset($datos['medeshabilitado']) && isset($datos['idpadre'])){
    $abmMe=new abmMenu();
    $resp=$abmMe->modificacion($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el menu.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>