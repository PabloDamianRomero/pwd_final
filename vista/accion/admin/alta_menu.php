<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();
    if (isset($datos['menombre'])){
        if ($datos['idpadre']==0){
            $datos['idpadre']=null;
        }
        $abmMe=new abmMenu();
        $resp=$abmMe->alta($datos);
    }else{
        $resp=false;
        $retorno['errorMsg']="No se pudo dar de ALTA al usuario";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>