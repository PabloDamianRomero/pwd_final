<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();
    $retorno['respuesta']=false;
    if (isset($datos['idcompraestado']) && isset($datos['cetdescripcion']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin'])){
        $abmEstado=new abmCompraestado();
        $retorno=$abmEstado->cambiarEstado($datos);
    }else{
        $retorno['errorMsg']="Faltan parametros.";
    }
    echo json_encode($retorno);
?>