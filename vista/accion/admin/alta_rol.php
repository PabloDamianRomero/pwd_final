<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();
    $resp=false;
    if (isset($datos['idrol']) && isset($datos['rodescripcion'])){
        $abmRol=new abmRol();
        $resp=$abmRol->alta($datos);
    }
    if (!$resp){
        $retorno['errorMsg']="No se pudo dar de ALTA al rol";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>