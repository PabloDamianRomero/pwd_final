<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idmenu']) && isset($datos['menombre']) && isset($datos['medescripcion']) && isset($datos['medeshabilitado']) && isset($datos['idpadre'])){
    if ($datos['medeshabilitado']=="0000-00-00 00:00:00"){
        $date = date('Y-m-d H:i:s');
        $datos['medeshabilitado']=$date;  //Si estaba activo ahora ingresa la fecha actual
    }else{
        $datos['medeshabilitado']="0000-00-00 00:00:00"; //Si estaba inactivo ahora lo setea en nulo (lo activa)
    }
    $abmMe=new abmMenu();
    $resp=$abmMe->modificacion($datos);
}

if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el menu.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>