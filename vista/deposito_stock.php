<?php
    $titulo = "Gestionar Productos - Stock";
    $estructuraAMostrar = "desdeVista";
    $seguro = true;
    include_once "estructura/cabecera.php";

    // ---------------------- Verificar si el sub-enlace del menú está habilitado -------------------------------
    $i = 0;
    $existeSubEnlace = false;
    if(isset($arrSubMenu)){
        while(($i < count($arrSubMenu)) && (!$existeSubEnlace)){
            $subMenuActual = $arrSubMenu[$i];
            if(($subMenuActual->getMedeshabilitado() != "0000-00-00 00:00:00") && ($subMenuActual->getMedescripcion() == "deposito_stock")){
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
                    No puede actualizar stock de Productos (No está con el rol <span style='font-weight: bold; font-style: italic;'>Depósito</span>).
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

// ---------------------- Si es Deposito pero el enlace-menu(sub menú) no está disponible  -------------------------------
// ---------------------- Esto es para no acceder por url a la página si el enlace-menú esta deshabilitado  -------------------------------
}else if(($rolActivo->getIdrol() == 2) && (isset($arrMenuPadre)) && ($existeSubEnlace)){
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
            <h1 class="display-6 fuente-monts">Gestión de productos - Stock</h1>
            <p class="lead">En esta página el engarcado del depósito puede gestionar el stock de los productos.</p>
        </div>
    </div>

    <table id="dg" title="Productos" class="easyui-datagrid" style="width:950px;height:500px"
                url="accion/deposito/listar_productos.php"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idproducto" width="10">ID</th>
                    <th field="pronombre" width="100">Nombre</th>
                    <th field="prodetalle" width="70">Detalle</th>
                    <th field="proprecio" width="20">Precio</th>
                    <th field="procantstock" width="50">Stock</th>
                </tr>
            </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProd()">Cambiar Stock</a>
    </div>
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion Producto</h3>
            <div style="margin-bottom:10px">
                <input name="procantstock" class="easyui-textbox" required="true" label="Stock:" style="width:100%">
            </div>
            <div>
                <input name="pronombre" value="pronombre" type="hidden">
            </div>
            <div>
                <input name="prodeshabilitado" value="prodeshabilitado" type="hidden">
            </div>
            <div>
                <input name="prodetalle" value="prodetalle" type="hidden">
            </div>
            <div>
                <input name="proprecio" value="proprecio" type="hidden">
            </div>
            <div>
                <input name="idproducto" value="idproducto" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveProd()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>



    <script type="text/javascript">
        var url;
        function editProd(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Stock');
                $('#fm').form('load',row);                
                url = 'accion/deposito/stock_prod.php';
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
    </script>


<?php
}
include_once "estructura/pie.php";
?>