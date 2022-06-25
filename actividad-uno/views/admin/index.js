$(document).ready(function () {
    var id_producto, fila;
    var verificar = Array();

    $.get("../../controllers/producto.php?op=getProductos", function (data) {


        data = JSON.parse(data);


        tablaUsuarios = $('#tablaProductos').DataTable({
            "destroy": true,
            "data": data.DATA,
            "columns": [
                { "data": "id" },
                { "data": "descripcion" },
                { "data": "precio" },
                { "defaultContent": "<div class='text-center'><div class='btn-toolbar'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Eliminar</button></div></div>" }
            ],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
            }
        });

    });

    $('#formUsuario').submit(function (e) {
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        var formData = new FormData($("#formUsuario")[0]);


        if (sessionStorage.getItem('datos') == 'guardar') {


            var camposRe = 7;
            if (formData.get('usuario_id') != '' && formData.get('perfil') != '' && formData.get('nombres') != '' && formData.get('apellidos') != '' && formData.get('correo') != '' && formData.get('celular') != '' && formData.get('password') != '') {
                camposRe = 0;

            }
        } else {
            if (formData.get('usuario_id') != '' && formData.get('perfil') != '' && formData.get('nombres') != '' && formData.get('apellidos') != '' && formData.get('correo') != '' && formData.get('celular') != '') {
                camposRe = 0;
            }
        }


        if (camposRe == 0) {
            $.ajax({
                url: "controllers/usuario.php?op=guardarEditar",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {

                    $('#formUsuario')[0].reset();
                    $('#tablaUsuarios').DataTable().ajax.reload();
                    datos = JSON.parse(datos);

                    if (datos == 'setExitoso') {
                        swal.fire('Registro!',
                            'El registro se guardó correctamente.',
                            'success')
                    } else {
                        swal.fire(
                            'Registro!',
                            'El registro se modificó correctamente.',
                            'success'
                        )
                    }
                }
            }); $('#modalUsuario').modal('hide');
        } else {
            $('#mensaje').html("<span style='color:red;'>¡Por favor llenar todos los campos ! </span>");
        }


    });


    $("#btnNuevo").click(function () {

        $('#id').prop("readonly", false);
        $("#formProducto").trigger("reset");
        $(".modal-header").css("background-color", "#17a2b8");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar producto");
        $('#modalProducto').modal('show');
    });

    //Editar        
    $(document).on("click", ".btnEditar", function () {

        fila = $(this).closest("tr");
        id_producto = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            

        $.get("../../controllers/producto.php?op=getProducto", { id: id_producto }, function (data) {

            data = JSON.parse(data);

            $('#id').val(data.DATA[0].id);
            $('#descripcion').val(data.DATA[0].descripcion);
            $('#precio').val(data.DATA[0].precio);

        });

        $('#id').prop("readonly", true);
        $(".modal-header").css("background-color", "#17a2b8");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar producto");
        $('#modalProducto').modal('show');


    });

    //Borrar
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id_producto = parseInt(fila.closest('tr').find('td:eq(0)').text());

        console.log('id', id_producto);

        swal({
            title: "Elimar producto",
            text: "Seguro de eliminar producto del carrito?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {

                $.post("../../controllers/producto.php?op=eliminar", { id: id_producto }, function (data) {

                    data = JSON.parse(data);
                    if (data.STATUS == "OK") {
                        tablaUsuarios.row(fila.parents('tr')).remove().draw();
                        swal(
                            'Eliminado!',
                            'El registro se eliminó correctamente.',
                            'success'
                        );
                    }


                });


            }
        })

    });



    $('#formProducto').submit(async function (e) {
        e.preventDefault();


        if ($('#id').is('[readonly]')) {
            var formDataE = new FormData($("#formProducto")[0]);
            if (parseInt(formDataE.get('precio')) > 0) {


                $.ajax({
                    url: "../../controllers/producto.php?op=update",
                    type: "POST",
                    data: formDataE,
                    contentType: false,
                    processData: false,
                    success: function (datos) {

                        datos = JSON.parse(datos);
                        if (datos.STATUS == 'OK') {
                            $('#precioS').fadeIn().html('');
                            $('#modalProducto').modal('hide');
                            swal({
                                title: 'Producto Actualizado!',
                                icon: 'success',
                            }).then(() => location.reload());
                        }


                    }

                });

            } else {
                $('#precioS').fadeIn().html("<span style='color:red;'>Precio debe ser mayor de 0 </span>");

            }


        } else {

            var formDataG = new FormData($("#formProducto")[0]);
            if (verificar.length == 0) {


                $.ajax({
                    url: "../../controllers/producto.php?op=setProducto",
                    type: "POST",
                    data: formDataG,
                    contentType: false,
                    processData: false,
                    success: function (datos) {


                        datos = JSON.parse(datos);
                        console.log("Res", datos);
                        if (datos.STATUS == 'OK') {
                            $('#modalProducto').modal('hide');
                            swal({
                                title: 'Producto registrado!',
                                icon: 'success',
                            }).then(() => location.reload());
                        }


                    }

                });

            } else {

                $('#id-producto').fadeIn().html("<span style='color:red;'>¡Intente con otro id! </span>");
            }

        }





    });

    $("#id").blur(() => verificarIdProducto());

    function verificarIdProducto() {
        var id_producto = parseInt($('#id').val());
        console.log('id', id_producto);
        $.get("../../controllers/producto.php?op=getProducto", { id: id_producto }, function (data) {
            data = JSON.parse(data);
            if (data.DATA.length == 0) {
                $('#id-producto').html("<span style='color:green;'>Id valido!</span>");
                verificar.length = 0;
            } else {
                verificar.push('Id no valido');
                $('#id-producto').html("<span style='color:red;'>Id no valido!</span>");
            }
        });
    }
});
