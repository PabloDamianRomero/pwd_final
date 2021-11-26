<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();
    $retorno['respuesta']=false;
    if (isset($datos['idcompraestado']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin']) && isset($datos['cetdescripcion'])){
        $abmEstado=new abmCompraestado();
        $retorno=$abmEstado->cancelaCompra($datos);
    }else{
        $retorno['errorMsg']="Faltan parámetros.";
    }
    echo json_encode($retorno);
?>