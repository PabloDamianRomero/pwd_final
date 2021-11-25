<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();

    if (isset($datos['pronombre']) && isset($datos['proprecio'])){
        $abmProd=new abmProducto();
        $colProd=$abmProd->buscar(null);
        $cant=count($colProd);
        $datos['prodetalle'] = md5("detProd".$cant);    //Genero un string que no se repita y lo codifico
        $resp=$abmProd->alta($datos);
    }else{
        $resp=false;
        $retorno['errorMsg']="No se pudo dar de ALTA al producto";
    }
    $retorno['respuesta']=$resp;
    echo json_encode($retorno);
?>