<?php

include_once ("../configuracion.php");
$objUser = new abmUsuario();
$arrUser = $objUser->buscar(null);
echo "<p>LISTAR USUARIOS DE LA BD</p>";
echo "<pre>";
print_r($arrUser);
echo "</pre>";
?>