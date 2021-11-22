<?php
    $titulo = "Gestionar Compras";
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

    // ---------------------- Si el usuario actual no es admin  -------------------------------
    if($rolActivo->getIdrol() != 1){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede gestionar Compras (No está con el rol <span style='font-weight: bold; font-style: italic;'>Administrador</span>).
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
// ---------------------- Si es admin pero el enlace-menu(sub menú) no está disponible  -------------------------------
// ---------------------- Esto es para no acceder por url a la página si el enlace-menú esta deshabilitado  -------------------------------
// ---------------------- SECCIÓN NO IMPLEMENTADA SÓLO PARA EL ADMINISTRADOR  -------------------------------
// }else if(($rolActivo->getIdrol() == 1) && (isset($arrMenuPadre)) && ($existeSubEnlace)){
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
                <h1 class="display-6 fuente-monts">Gestión de Compras</h1>
                <p class="lead">En esta página el admin puede gestionar los estados de las compras.</p>
            </div>
        </div>
    

        <table id="dg" title="Compras" class="easyui-datagrid" style="width:800px;height:400px"
                url="accion/admin/listar_compras.php"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idcompraestado" width="30">ID Estado</th>
                    <th field="idcompra" width="30">ID Compra</th>
                    <th field="idcompraestadotipo" width="30">ID EstTipo</th>
                    <th field="cetdescripcion" width="30">Estado</th>
                    <th field="cefechaini" width="60">Fecha Inicio</th>
                    <th field="cefechafin" width="60">Fecha Fin</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="estadoCompra()">Cambiar Estado</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="cancelarCompra()">Cancelar</a>
        </div>
        
        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Informacion Compra</h3>
                <div style="margin-bottom:10px">
                    <input name="idcompraestado" value="idcompraestado" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="idcompra" value="idcompra" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="idcompraestadotipo" value="idcompraestadotipo" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="cetdescripcion" value="cetdescripcion" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="cefechaini" value="cefechaini" class="easyui-textbox" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="cefechafin" value="cefechafin" class="easyui-textbox" style="width:100%">
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMenu()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>



    <script>
        var url;
        function estadoCompra(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#fm').form('load',row);
                url = 'accion/admin/estadoCompra.php';
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
        }
        function cancelarCompra(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','Cancelar la compra?',function(r){
                    if (r){
                        $('#fm').form('load',row);
                        url = 'accion/admin/baja_compra.php';
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
    </script>
<?php
}
include_once "estructura/pie.php";
?>