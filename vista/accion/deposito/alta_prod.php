<?php
    include_once("../../../configuracion.php");
    $datos=data_submitted();

    // include_once("../../../modelo/conector/BaseDatos.php");
    // include_once("../../../modelo/Rol.php");
    // include_once("../../../modelo/UsuarioRol.php");
    // include_once("../../../modelo/Usuario.php");
    // include_once("../../../modelo/Menurol.php");
    // include_once("../../../modelo/Producto.php");
    // include_once("../../../control/abmRol.php");
    // include_once("../../../control/abmUsuariorol.php");
    // include_once("../../../control/abmUsuario.php");
    // include_once("../../../control/abmMenurol.php");
    // include_once("../../../control/abmProducto.php");
    // $datos=['pronombre'=>'Placa de video Nvidia MSI GeForce 10 Series GT 1030 GEFORCE GT 1030 2GD4 LP OC OC Edition 2GB','proprecio'=>'23.479'];

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