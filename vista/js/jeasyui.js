var url;
//
// ------------------------------------
// ----- A  D   M   I   N -----
// ------------------------------------
//


//
// ----- ADMIN_MENU -----
//
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

function newMeRol(){
    $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle','Nuevo Rol');
    $('#fmRoll').form('clear');
    url = 'accion/admin/alta_rol.php';
}
function editMeRol(){
    var row = $('#dgRoll').datagrid('getSelected');
    if (row){
        $('#dlgRoll').dialog('open').dialog('center').dialog('setTitle','Editar Rol');
        $('#fmRoll').form('load',row);
        url = 'accion/admin/mod_rol.php?id='+row.id;
    }
}
function saveMeRol(){
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
function destroyMeRol(){
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






//
// ----- ADMIN_USERS -----
//
function newUser(){
    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Usuario');
    $('#fm').form('clear');
    url = 'accion/admin/alta_usuario.php';
}
function editUser(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
        $('#fm').form('load',row);
        url = 'accion/admin/mod_usuario.php';
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
        $.messager.confirm('Confirmar','Cambiar el estado del Usuario?',function(r){
            if (r){
                $('#fm').form('load',row);
                url = 'accion/admin/baja_usuario.php';
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
// ---TABLA USUARIO-ROL---
//

function newUsRol(){
    $('#dlgRol').dialog('open').dialog('center').dialog('setTitle','Nuevo Usuario');
    $('#fmRol').form('clear');
    url = 'accion/admin/alta_usuarioRol.php';
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
                $.post('accion/admin/baja_usuarioRol.php',{idusuario:row.idusuario,idrol:row.idrol},function(result){
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







//
// ----- ADMIN_COMPRAS -----
//
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
function detallesCompra(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        window.location.href = "accion/compra/detalleCompra.php?idcompra="+row.idcompra+"&rol=1";                    
    }
}



//
// ------------------------------------
// ----- D  E   P   O   S   I   T   O -----
// ------------------------------------
//




//
// ----- DEPOSITO_NUEVO -----
//
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





//
// ----- DEPOSITO_BAJA -----
//
function destroyProducto(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirmar','Cambiar el estado del Producto?',function(r){
            if (r){
                $('#fm').form('load',row);
                url = 'accion/deposito/baja_prod.php';
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
// ----- DEPOSITO_STOCK -----
//
function editProdSt(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Stock');
        $('#fm').form('load',row);                
        url = 'accion/deposito/stock_prod.php';
    }
}
function saveProdSt(){
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


//
// ------------------------------------
// ----- C  L   I   E   N   T   E -----
// ------------------------------------
//


//
// ----- CLIENTE_COMPRAS -----
//
function cancelarCompraCl(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        $.messager.confirm('Confirmar','Cancelar la compra?',function(r){
            if (r){
                $('#fm').form('load',row);
                url = 'accion/cliente/baja_compra.php';
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
function detallesCompraCl(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        window.location.href = "accion/compra/detalleCompra.php?idcompra="+row.idcompra+"&rol=3";                    
    }
}





//
// ----- actualizarInfoCliente -----
//
function editClUser(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
        $('#fm').form('load',row);
        url = 'accion/cliente/mod_usuarioCliente.php?id='+row.id;
    }
}
function saveClUser(){
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