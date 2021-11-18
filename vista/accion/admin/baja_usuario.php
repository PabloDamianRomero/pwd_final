<?php
include_once("../../../configuracion.php");
$datos=data_submitted();
$resp=false;
if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail']) && isset($datos['usdeshabilitado'])){
    if ($datos['usdeshabilitado']=="0000-00-00 00:00:00"){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $date = date('Y-m-d H:i:s');
        $datos['usdeshabilitado']=$date;  //Si estaba activo ahora ingresa la fecha actual
    }else{
        $datos['usdeshabilitado']="0000-00-00 00:00:00"; //Si estaba inactivo ahora lo setea en nulo (lo activa)
    }
    $abmUs=new abmUsuario();
    $resp=$abmUs->modificacion($datos);
}
if (!$resp){
    $retorno['errorMsg']="No se pudo ELIMINAR el usuario.";
}
$retorno['respuesta']=$resp;
echo json_encode($retorno);

?>