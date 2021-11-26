<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();
    $resp=false;
    if (isset($datos['pronombre']) && isset($datos['proprecio'])){
        $abmProd=new abmProducto();
        $resp=$abmProd->alta($datos);        
    }else{
        $retorno['errorMsg']="No se pudo dar de ALTA al producto";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>