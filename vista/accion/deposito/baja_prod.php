<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idproducto']) && isset($datos['pronombre']) && isset($datos['prodetalle']) && isset($datos['prodeshabilitado']) && isset($datos['proprecio']) && isset($datos['procantstock'])){
    $datos['baja']=true;
    $abmProd=new abmProducto();
    $resp=$abmProd->modificacion($datos);
}

if (!$resp){
    $retorno['errorMsg']="No se pudo cambiar el estado.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>