<?php
include_once("../../../configuracion.php");
$datos=data_submitted();

if (isset($datos['idrol']) && isset($datos['rodescripcion'])){
    $abmRol=new abmRol();
    $resp=$abmRol->modificacion($datos);
}else{
    $resp=false;
    $retorno['errorMsg']="No se pudo MODIFICAR el rol.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);
?>