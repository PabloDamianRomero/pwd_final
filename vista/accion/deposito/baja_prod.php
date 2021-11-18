<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idproducto']) && isset($datos['pronombre']) && isset($datos['prodetalle']) && isset($datos['prodeshabilitado']) && isset($datos['proprecio']) && isset($datos['procantstock'])){
    if ($datos['prodeshabilitado']=="0000-00-00 00:00:00"){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $date = date('Y-m-d H:i:s');
        $datos['prodeshabilitado']=$date;  //Si estaba activo ahora ingresa la fecha actual
    }else{
        $datos['prodeshabilitado']="0000-00-00 00:00:00"; //Si estaba inactivo ahora lo setea en nulo (lo activa)
    }
    $abmProd=new abmProducto();
    $resp=$abmProd->modificacion($datos);
}

if (!$resp){
    $retorno['errorMsg']="No se pudo cambiar el estado.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>