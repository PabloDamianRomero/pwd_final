<?php
    include_once("../configuracion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador - Menu</title>
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/demo/demo.css">
    <script type="text/javascript" src="../util/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../util/jquery-easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>MENU - ROL</h2>
    <p>En esta pagina el admin puede gestionar los menus y sus roles.</p>

    <!-- ---TABLA MENU--- -->

    <table id="dg" title="Menu" class="easyui-datagrid" style="width:800px;height:250px"
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

    <table id="dgRol" title="MenuRol" class="easyui-datagrid" style="width:700px;height:250px"
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

    <table id="dgRoll" title="Rol" class="easyui-datagrid" style="width:700px;height:250px"
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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRol()">Nuevo Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editRol()">Editar Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyRol()">Eliminar Rol</a>
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
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveRol()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRoll').dialog('close')" style="width:90px">Cancelar</a>
    </div>








    <script type="text/javascript">
        var url;
        function newMenu(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Menu');
            $('#fm').form('clear');
            url = 'accion/admin/alta_menu.php';
        }
        function editMenu(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Menu');
                $('#fm').form('load',row);
                url = 'accion/admin/mod_menu.php';
            }
        }
        function saveMenu(){
            $('#fm').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the menu data
                    }
                }
            });
        }
        function destroyMenu(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','Cambiar el estado del menu?',function(r){
                    if (r){
                        $('#fm').form('load',row);
                        url = 'accion/admin/baja_menu.php';
                        $('#fm').form('submit',{
                            url: url,
                            iframe: false,
                            onSubmit: function(){
                                return $(this).form('validate');
                            },
                            success: function(result){
                                var result = eval('('+result+')');
                                if (result.errorMsg){
                                    $.messager.show({
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                } else {
                                    $('#dg').datagrid('reload');    // reload the menu data
                                }
                            }
                        });
                    }
                });
            }
        }
        
        //
        // ---TABLA MENU-ROL---
        //

        function newMeRol(){
            $('#dlgRol').dialog('open').dialog('center').dialog('setTitle','Nuevo Menu');
            $('#fmRol').form('clear');
            url = 'accion/admin/alta_menuRol.php';
        }
        function saveMeRol(){
            $('#fmRol').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlgRol').dialog('close');        // close the dialog
                        $('#dgRol').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyMeRol(){
            var row = $('#dgRol').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','Esta seguro que desea eliminar este Menu-Rol?',function(r){
                    if (r){
                        $.post('accion/admin/baja_menuRol.php',{idmenu:row.idmenu,idrol:row.idrol},function(result){
                            if (result.respuesta){
                                $('#dgRol').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }

        //
        // ---TABLA ROLES---
        //

        function newRol(){
            $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle','Nuevo Rol');
            $('#fmRoll').form('clear');
            url = 'accion/admin/alta_rol.php';
        }
        function editRol(){
            var row = $('#dgRoll').datagrid('getSelected');
            if (row){
                $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle','Editar Rol');
                $('#fmRoll').form('load',row);
                url = 'accion/admin/mod_rol.php?id='+row.id;
            }
        }
        function saveRol(){
            $('#fmRoll').form('submit',{
                url: url,                
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlgRoll').dialog('close');        // close the dialog
                        $('#dgRoll').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyRol(){
            var row = $('#dgRoll').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','Esta seguro de borrar el Rol?',function(r){
                    if (r){
                        $.post('accion/admin/baja_rol.php',{idrol:row.idrol},function(result){
                            console.log(result);
                            if (result.respuesta){
                                $('#dgRoll').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>

</body>
</html>