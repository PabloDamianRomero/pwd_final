<?php
    include_once("../../configuracion.php");
    $datos=data_submitted();
    if (isset($datos['usnombre']) && isset($datos['uspass'])){
        $datos['uspass'] = md5($datos['uspass']);
        $abmUs=new abmUsuario();
        $resp=$abmUs->alta($datos);
    }else{
        $resp=false;
        $retorno['errorMsg']="No se pudo dar de ALTA al usuario";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>