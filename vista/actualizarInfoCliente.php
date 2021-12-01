<?php
$titulo = "Actualizar información del cliente";
$estructuraAMostrar = "desdeVista";
$seguro = true;
include_once "estructura/cabecera.php";

// ---------------------- Verificar si el sub-enlace del menú está habilitado -------------------------------
$i = 0;
$existeSubEnlace = false;
if(isset($arrSubMenu)){
    while(($i < count($arrSubMenu)) && (!$existeSubEnlace)){
        $subMenuActual = $arrSubMenu[$i];
        if(($subMenuActual->getMedeshabilitado() != "0000-00-00 00:00:00") && ($subMenuActual->getMedescripcion() == "actualizarInfoCliente")){
            $existeSubEnlace = true;
        }
        $i++;
    }
}
// ----------------------------------------------------------------------------------------------------------

// ---------------------- Si el usuario actual no tiene permisos  -------------------------------
$permiso=false;
    foreach ($arrMenu as $menu){
        if (($menu->getObjMenu()->getMedescripcion()=="actualizarInfoCliente") && ($menu->getObjMenu()->getMedeshabilitado()=="0000-00-00 00:00:00")){
            $permiso=true;
        }
    }
    if(!$permiso){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede gestionar Compras (No tiene permisos de Rol o la página está deshabilitada).
            </div>
        </div>
    </div>
<?php
// ----------------------------------------------------------------------------------------------------------

// ---------------------- Si es Cliente pero el enlace-menu(padre) no está disponible  -------------------------------
}else if(($rolActivo->getIdrol() == 3) && (!isset($arrMenuPadre))){ // si es cliente pero el enlace-menu(padre) no está disponible
    ?>
        <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <span style="font-weight: bold;">Este apartado no se encuentra disponible.</span>
            </div>
        </div>
    </div>
    <?php
// ----------------------------------------------------------------------------------------------------------

// ---------------------- Si es Cliente pero el enlace-menu(sub menú o padre) no está disponible  -------------------------------
// ---------------------- Esto es para no acceder por url a la página si el enlace-menú esta deshabilitado  -------------------------------
 }else if(($rolActivo->getIdrol() == 3) && (isset($arrMenuPadre)) && ($existeSubEnlace) || $arrMenuPadre[0]->getMedeshabilitado() != "0000-00-00 00:00:00"){
    ?>
        <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <span style="font-weight: bold;">Este apartado no se encuentra disponible.</span>
            </div>
        </div>
        </div>
    <?php
}else{
// ----------------------------------------------------------------------------------------------------------    

// ---------------------- Si es Cliente y existe el enlace-menu (padre e hijo)  ------------------------------- 
?>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;margin-bottom: 50px;">
        <div class="container">
            <h1 class="display-5 fuente-monts">Actualizar información del cliente</h1>
            <p class="lead">Seleccione la fila de su usuario y luego presione en <span style="color: green;">Editar Usuario</span>.</p>
        </div>
    </div>

    <!-- ---TABLA USUARIO--- -->

    <table id="dg" title="Usuario" class="easyui-datagrid" style="width:700px;height:250px;"
        url="accion/cliente/listarUsuarioActual.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="usnombre" width="50">Nombre</th>
                <th field="uspass" width="50">Contraseña</th>
                <th field="usmail" width="50">Email</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editClUser()">Editar Usuario</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion Usuario</h3>
            <div style="margin-bottom:10px">
                <input name="usnombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="uspass" class="easyui-textbox" required="true" label="Contraseña:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="usmail" class="easyui-textbox" required="true" label="Mail:" style="width:100%">
            </div>
            <div>
                <input name="idusuario" value="idusuario" type="hidden">
                <input name="usdeshabilitado" value="usdeshabilitado" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveClUser()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
<div>

<?php
}
?>

<?php
include_once "estructura/pie.php";
?>