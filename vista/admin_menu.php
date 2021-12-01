<?php
    $titulo = "Gestionar Menus";
    $estructuraAMostrar = "desdeVista";
    $seguro = true;
    include_once "estructura/cabecera.php";

    // ---------------------- Verificar si el sub-enlace del menú está habilitado -------------------------------
    $i = 0;
    $existeSubEnlace = false;
    if(isset($arrSubMenu)){
        while(($i < count($arrSubMenu)) && (!$existeSubEnlace)){
            $subMenuActual = $arrSubMenu[$i];
            if(($subMenuActual->getMedeshabilitado() != "0000-00-00 00:00:00") && ($subMenuActual->getMedescripcion() == "admin_menu")){
                $existeSubEnlace = true;
            }
            $i++;
        }
    }
    // ----------------------------------------------------------------------------------------------------------

    // ---------------------- Si el usuario actual no es tiene permisos  -------------------------------
    $permiso=false;
    foreach ($arrMenu as $menu){
        if (($menu->getObjMenu()->getMedescripcion()=="admin_menu") && ($menu->getObjMenu()->getMedeshabilitado()=="0000-00-00 00:00:00")){
            $permiso=true;
        }
    }
    if(!$permiso){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede gestionar Menus (No tiene permisos de Rol o la página está deshabilitada).
            </div>
        </div>
    </div>
<?php
// ----------------------------------------------------------------------------------------------------------


// ---------------------- Si es admin pero el enlace-menu(padre) no está disponible  -------------------------------
}else if(($rolActivo->getIdrol() == 1) && (!isset($arrMenuPadre))){
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

// ---------------------- Si es admin pero el enlace-menu(sub menú o padre) no está disponible  -------------------------------
// ---------------------- Esto es para no acceder por url a la página si el enlace-menú esta deshabilitado  -------------------------------
// ---------------------- SECCIÓN NO IMPLEMENTADA SÓLO PARA EL ADMINISTRADOR  -------------------------------
// }else if(($rolActivo->getIdrol() == 1) && (isset($arrMenuPadre)) && ($existeSubEnlace) || $arrMenuPadre[0]->getMedeshabilitado() != "0000-00-00 00:00:00"){
?>
        <!-- <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <span style="font-weight: bold;">Este apartado no se encuentra disponible.</span>
            </div>
        </div>
        </div> -->
    <?php
}else{
// ----------------------------------------------------------------------------------------------------------    

// ---------------------- Si es admin y existe el enlace-menu (padre e hijo)  ------------------------------- 
?>
<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;margin-bottom: 50px;">
        <div class="container">
            <h1 class="display-6 fuente-monts">Gestión de menus</h1>
            <p class="lead">En esta página el admin puede gestionar los menus y sus roles.</p>
        </div>
    </div>

    <!-- ---TABLA MENU--- -->

    <table id="dg" title="Menu" class="easyui-datagrid" style="width:800px;height:400px"
            url="accion/admin/listar_menu.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idmenu" width="20">ID</th>
                <th field="menombre" width="90">Nombre</th>
                <th field="medescripcion" width="70">Descripcion</th>
                <th field="idpadre" width="30">ID padre</th>
                <th field="medeshabilitado" width="70">Deshabilitado</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMenu()">Nuevo Menu</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editMenu()">Editar Menu</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMenu()">Baja/Alta</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion Menu</h3>
            <div style="margin-bottom:10px">
                <input name="menombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="medescripcion" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="idpadre" class="easyui-textbox" label="ID Padre:" style="width:100%">
            </div>
            <div>
                <input name="medeshabilitado" value="medeshabilitado" type="hidden">
            </div>
            <div>
                <input name="idmenu" value="idmenu" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMenu()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>


    <!-- ---TABLA ROLES MENU--- -->
    </br>
    </br>

    <table id="dgRol" title="MenuRol" class="easyui-datagrid" style="width:800px;height:400px"
            url="accion/admin/listar_menuRol.php"
            toolbar="#toolbar2" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idmenu" width="50">ID</th>
                <th field="menombre" width="50">Menu</th>
                <th field="idrol" width="50">Rol</th>
                <th field="rodescripcion" width="50">Descripcion</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar2">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMeRol()">Nuevo Rol Menu</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMeRol()">Eliminar Rol Menu</a>
    </div>
    
    <div id="dlgRol" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRol-buttons'">
        <form id="fmRol" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion MenuRol</h3>
            <div style="margin-bottom:10px">
                <input name="idmenu" class="easyui-textbox" required="true" label="ID Menu:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="idrol" class="easyui-textbox" required="true" label="ID Rol:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlgRol-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMeRol()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRol').dialog('close')" style="width:90px">Cancelar</a>
    </div>


<!-- ---TABLA ROLES--- -->
    </br>
    </br>

    <table id="dgRoll" title="Rol" class="easyui-datagrid" style="width:800px;height:250px"
            url="accion/admin/listar_roles.php"
            toolbar="#toolbar3" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idrol" width="50">ID</th>
                <th field="rodescripcion" width="50">Descripcion</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar3">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRoll()">Nuevo Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editRoll()">Editar Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyRoll()">Eliminar Rol</a>
    </div>
    
    <div id="dlgRoll" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRoll-buttons'">
        <form id="fmRoll" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion Rol</h3>
            <div style="margin-bottom:10px">
                <input name="rodescripcion" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
            </div>
            <div>
                <input name="idrol" value="idrol" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlgRoll-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveRoll()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRoll').dialog('close')" style="width:90px">Cancelar</a>
    </div>
</div>







<?php
}
?>

<?php
include_once "estructura/pie.php";
?>