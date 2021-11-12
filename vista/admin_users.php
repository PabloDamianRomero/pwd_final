<?php
    include_once("../configuracion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador - Usuarios</title>
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../util/jquery-easyui/demo/demo.css">
    <script type="text/javascript" src="../util/jquery-easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../util/jquery-easyui/jquery.easyui.min.js"></script>
</head>
<body>
<h2>Basic CRUD Application</h2>
    <p>Click the buttons on datagrid toolbar to do crud actions.</p>
    
    <!-- ---TABLA USUARIOS--- -->

    <table id="dg" title="Usuarios" class="easyui-datagrid" style="width:700px;height:250px"
            url="accion/listar_usuarios.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idusuario" width="30">ID</th>
                <th field="usnombre" width="50">Nombre</th>
                <th field="uspass" width="50">Contraseña</th>
                <th field="usmail" width="50">Email</th>
                <th field="usdeshabilitado" width="70">Deshabilitado</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar Usuario</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
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
            <div style="margin-bottom:10px">
                <input name="usdeshabilitado" value="usdeshabilitado" class="easyui-checkbox" label="Des-habilitar:">
            </div>
            <div>
                <input name="idusuario" value="idusuario" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>


    <!-- ---TABLA ROLES USUARIO--- -->
    </br>
    </br>

    <table id="dgRol" title="UsuarioRol" class="easyui-datagrid" style="width:700px;height:250px"
            url="accion/listar_usuariosRol.php"
            toolbar="#toolbar2" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idusuario" width="50">ID</th>
                <th field="usnombre" width="50">Usuario</th>
                <th field="idrol" width="50">Rol</th>
                <th field="rodescripcion" width="50">Descripcion</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar2">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUsRol()">Nuevo Rol Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUsRol()">Eliminar Rol Usuario</a>
    </div>
    
    <div id="dlgRol" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRol-buttons'">
        <form id="fmRol" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion UsuarioRol</h3>
            <div style="margin-bottom:10px">
                <input name="idusuario" class="easyui-textbox" required="true" label="ID Usuario:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="idrol" class="easyui-textbox" required="true" label="ID Rol:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlgRol-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsRol()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRol').dialog('close')" style="width:90px">Cancelar</a>
    </div>




    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Usuario');
            $('#fm').form('clear');
            url = 'accion/alta_usuario.php';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
                $('#fm').form('load',row);
                url = 'accion/mod_usuario.php?id='+row.id;
            }
        }
        function saveUser(){
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
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Esta seguro de borrar el usuario?',function(r){
                    if (r){
                        $.post('accion/baja_usuario.php',{idusuario:row.idusuario},function(result){
                            if (result.respuesta){
                                $('#dg').datagrid('reload');    // reload the user data
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
        // ---TABLA USUARIO-ROL---
        //

        function newUsRol(){
            $('#dlgRol').dialog('open').dialog('center').dialog('setTitle','Nuevo Usuario');
            $('#fmRol').form('clear');
            url = 'accion/alta_usuarioRol.php';
        }
        function saveUsRol(){
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
        function destroyUsRol(){
            var row = $('#dgRol').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                    if (r){
                        $.post('accion/baja_usuarioRol.php',{idusuario:row.idusuario,idrol:row.idrol},function(result){
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
    </script>
</body>
</html>