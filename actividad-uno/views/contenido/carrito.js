$(document).ready(function () {
    var fila;
    var idProducto;
    var descripcion;
    var precio;
    var productosCompra = Array();
    var tablaCarrito;
    var carrito = Array();
    var productos = Array();



    $.get("../../controllers/producto.php?op=getCarrito", function (data) {

        data = JSON.parse(data);

        if (data.STATUS == 'OK') {

            carrito.length = 0;

            if (data.DATA.carrito != null) {
                console.log(typeof (data.DATA.carrito));
                data.DATA.carrito.forEach(element => {
                    console.log(element);
                    carrito.push(element);

                });
            }



            tablaCarrito = $('#tablaProductosC').DataTable({
                "destroy": true,
                "data": carrito,
                "columns": [
                    { "data": "id" },
                    { "data": "descripcion" },
                    { "data": "precio" },
                    { "data": "cantidad" },
                    { "data": "importe" },
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
            asignarTotalPrecio();


        }

    });


    function asignarTotalPrecio() {



        var filasTabla = $("#tablaProductosC tr").length;
        var base = 0;
        var total = 0;
        if (filasTabla > 1 && carrito.length > 0) {

            for (var i = 1; i < filasTabla; i++) {

                base += parseFloat($('#tablaProductosC').find('tr').eq(i).find('td').eq(4).html());



            }

        }
        $('#base').val(base);
        const IVA = 19
        $('#IVA').val(IVA + '%');
        if (base != 0) {
            total = base + (base * (IVA / 100));
        }

        $('#total').val(total);




    }


    function llenarArrayProductos() {

        var filasTabla = $("#tablaProductosC tr").length;
        var columTabla = $("#tablaProductosC th").length;
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var year = d.getFullYear();
        fecha = year + "-" + month + "-" + day;


        for (var i = 1; i < filasTabla; i++) {
            var filas = Array();
            for (var j = 0; j < columTabla; j++) {


                var valor = ($('#tablaProductosC').find('tr').eq(i).find('td').eq(j).html());
                if (j == 0 || j == 3 || j == 4) {
                    valor = ($('#tablaProductosC').find('tr').eq(i).find('td').eq(j).html());
                    filas.push(valor);

                }

            }

            productosCompra.push(filas);
        }



    }

    $('#btnComprar').click(() => {
        console.log('comprar');
        llenarArrayProductos();
        console.log(productosCompra);

        /*  $.get("../../controllers/usuario.php?op=getSession", function (data) {
              console.log(data);
          });*/
    })


    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt(fila.closest('tr').find('td:eq(0)').text());




        swal({
            title: "Elimar producto",
            text: "Seguro de eliminar producto del carrito!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    var buscar = buscarProducto(carrito, id);


                    if (buscar >= 0) {

                        carrito.splice(buscar, 1);
                        guardarCarrito(carrito);
                        var productosCarrito = Array();
                        productosCarrito.length = 0;
                        productosCarrito.push(productos);

                        console.log(productosCarrito);

                        $.post("../../controllers/producto.php?op=agregarCarrito", { carrito: productosCarrito }, function (data) {
                            tablaCarrito.row(fila.parents('tr')).remove().draw();
                            asignarTotalPrecio();
                        });


                    }


                }
            });

    });


    function guardarCarrito(carrito) {
        productos.length = 0;
        carrito.forEach(element => {
            productos.push(element)
        });
    }
    function buscarProducto(carrito, id) {
        var posicion = -1;
        for (var i = 0; i < carrito.length; i++) {
            if (carrito[i].id == id) {
                posicion = i;
            }
        }
        return posicion;
    }



});
