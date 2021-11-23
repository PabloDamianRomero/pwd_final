<?php
    $titulo = "Gestionar Productos";
    $estructuraAMostrar = "desdeVista";
    $seguro = true;
    include_once "estructura/cabecera.php";

    // ---------------------- Verificar si el sub-enlace del menú está habilitado -------------------------------
    $i = 0;
    $existeSubEnlace = false;
    if(isset($arrSubMenu)){
        while(($i < count($arrSubMenu)) && (!$existeSubEnlace)){
            $subMenuActual = $arrSubMenu[$i];
            if(($subMenuActual->getMedeshabilitado() != "0000-00-00 00:00:00") && ($subMenuActual->getMedescripcion() == "deposito_nuevo")){
                $existeSubEnlace = true;
            }
            $i++;
        }
    }
    // ----------------------------------------------------------------------------------------------------------

    // ---------------------- Si el usuario actual no es Deposito  -------------------------------
    if($rolActivo->getIdrol() != 2){?>
    <div style="margin-bottom: 20%" class="container-fluid text-center">
        <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;">
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    No puede gestionar Productos (No está con el rol <span style='font-weight: bold; font-style: italic;'>Depósito</span>).
            </div>
        </div>
    </div>
<?php
// ----------------------------------------------------------------------------------------------------------

// ---------------------- Si es Deposito pero el enlace-menu(padre) no está disponible  -------------------------------
}else if(($rolActivo->getIdrol() == 2) && (!isset($arrMenuPadre))){
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

// ---------------------- Si es Deposito pero el enlace-menu(sub menú o padre) no está disponible  -------------------------------
// ---------------------- Esto es para no acceder por url a la página si el enlace-menú esta deshabilitado  -------------------------------
}else if(($rolActivo->getIdrol() == 2) && (isset($arrMenuPadre)) && ($existeSubEnlace) || $arrMenuPadre[0]->getMedeshabilitado() != "0000-00-00 00:00:00"){
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

// ---------------------- Si es Deposito y existe el enlace-menu (padre e hijo)  ------------------------------- 
?>

<div style="margin-bottom: 20%" class="container-fluid text-center">
    <div class="jumbotron jumbotron-fluid" style="margin-top: 30px;margin-bottom: 50px;">
        <div class="container">
            <h1 class="display-6 fuente-monts">Gestión de productos</h1>
            <p class="lead">En esta página el engarcado del depósito puede gestionar los productos.</p>
        </div>
    </div>
    
    <!-- ---TABLA PRODUCTOS--- -->

    <table id="dg" title="Productos" class="easyui-datagrid" style="width:950px;height:500px"
            url="accion/deposito/listar_productos.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idproducto" width="10">ID</th>
                <th field="pronombre" width="120">Nombre</th>
                <th field="prodetalle" width="50">Detalle</th>
                <th field="proprecio" width="20">Precio</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newProd()">Nuevo Producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProd()">Editar Producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProdImg()">Cargar Imagen</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProdInfo()">Cargar Info</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion Producto</h3>
            <div style="margin-bottom:10px">
                <input name="pronombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="proprecio" class="easyui-textbox" required="true" label="Precio:" style="width:100%">
            </div>
            <div>
                <input name="prodeshabilitado" value="prodeshabilitado" type="hidden">
            </div>
            <div>
                <input name="prodetalle" value="prodetalle" type="hidden">
            </div>
            <div>
                <input name="procantstock" value="procantstock" type="hidden">
            </div>
            <div>
                <input name="idproducto" value="idproducto" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlgImg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-img'">
        <form id="fmImg" method="post" enctype="multipart/form-data" novalidate style="margin:0;padding:20px 50px">
            <div class="col-12">
                <label for="imagen" class="form-label"><strong>Cargar Imagen</strong></label> 
                <div class="col">
                    <input type="file" name="imagen" id="imagen" required>
                    
                    <small class="text-muted">Formato permitido: .jpg</small>
                    <div class="invalid-feedback">Seleccione una imagen de su equipo</div>
                </div>
                <div>
                    <input type="hidden" name="idproducto" value="idproducto">
                </div>
                <div>
                    <input name="prodetalle" value="prodetalle" type="hidden">
                </div>
            </div>
        </form>
    </div>
    <div id="dlgInfo" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-info'">
        <form id="fmInfo" method="post" enctype="multipart/form-data" novalidate style="margin:0;padding:20px 50px">
            <div class="col-12">
                <label for="texto" class="form-label"><strong>Cargar Informacion</strong></label> 
                <div class="col">
                    <input type="file" name="texto" id="texto" required>
                    
                    <small class="text-muted">Archivo TXT</small>
                    <div class="invalid-feedback">Seleccione un archivo de su equipo</div>
                </div>
                <div>
                    <input name="prodetalle" value="prodetalle" type="hidden">
                </div>
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveProd()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <div id="dlg-buttons-img">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveProdImg()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgImg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <div id="dlg-buttons-info">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveProdInfo()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgInfo').dialog('close')" style="width:90px">Cancelar</a>
    </div>



    <script type="text/javascript">
        var url;
        function newProd(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Producto');
            $('#fm').form('clear');
            url = 'accion/deposito/alta_prod.php';
        }
        function editProd(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Producto');
                $('#fm').form('load',row);                
                url = 'accion/deposito/mod_prod.php';
            }
        }
        function saveProd(){
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
        function editProdImg(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlgImg').dialog('open').dialog('center').dialog('setTitle','Cargar Imagen');
                $('#fmImg').form('load',row);
                url = 'accion/deposito/img_prod.php';
            }
        }
        function saveProdImg(){
            $('#fmImg').form('submit',{
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
                        if(result.exitoMsg){
                            $.messager.show({
                                title: 'Exito',
                                msg: result.exitoMsg
                            });
                        }
                        $('#dlgImg').dialog('close');        // close the dialog
                    }
                }
            });
        }
        function editProdInfo(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlgInfo').dialog('open').dialog('center').dialog('setTitle','Cargar Informacion');
                $('#fmInfo').form('load',row);
                url = 'accion/deposito/info_prod.php';
            }
        }
        function saveProdInfo(){
            $('#fmInfo').form('submit',{
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
                        if(result.exitoMsg){
                            $.messager.show({
                                title: 'Exito',
                                msg: result.exitoMsg
                            });
                        }
                        $('#dlgInfo').dialog('close');        // close the dialog
                    }
                }
            });
        }
    </script>

<?php
}
include_once "estructura/pie.php";
?>