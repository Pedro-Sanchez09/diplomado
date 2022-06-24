
$(document).ready(function () {
    var fila;
    var idProducto;
    var descripcion;
    var precio;
    var productoCompra = Array();
    var productos = Array();
    var carrito;

    $.get("../../controllers/producto.php?op=getProductos", function (data) {


        data = JSON.parse(data);


        tablaUsuarios = $('#tablaProductos').DataTable({
            "destroy": true,
            "data": data.DATA,
            "columns": [
                { "data": "id" },
                { "data": "descripcion" },
                { "data": "precio" },
                { "defaultContent": "<button type='button' class='form btn-sm btnAgregarC btn-primary '>Agregar al carrito</button>" }
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

    //Editar        
    $(document).on("click", ".btnAgregarC", function () {
        $('#cantidad').val('1');
        fila = $(this).closest("tr");
        idProducto = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        descripcion = (fila.find('td:eq(1)').text());
        precio = parseInt(fila.find('td:eq(2)').text());
        console.log('id pr', idProducto);

        $(".modal-title").text("Agregar producto al carrito");
        $('#modalProducto').modal('show');



    });

    $('#btnVerCarrito').click(() => {
        console.log('ver');
        window.location.href = "./carrito.php";
    })


    function buscarProducto(productos, id) {
        var encontrado = false;
        if (productos.length > 0) {

            for (var i = 0; i < productos.length; i++) {
                console.log('id', productos[i][i].id);
                if (productos[i][i].id == id) {
                    encontrado = true;
                }
            }
        }
        return encontrado;
    }

    async function getCarrito() {
        var res = await $.get("../../controllers/producto.php?op=getCarrito");
        return res;
    }


    $('#formCantidad').submit(async function (e) {
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        var cantidad = parseInt($('#cantidad').val());

        var importe = cantidad * parseInt(precio);
        carrito = JSON.parse(await getCarrito());



        if (carrito.STATUS == 'OK') {
            productoCompra.length = 0;

            if (carrito.DATA.carrito != null) {
                carrito.DATA.carrito.forEach(element => {
                    productoCompra.push(element);
                });
            }



        }

        var buscar = buscarProducto(productoCompra, idProducto);


        if (!buscar) {
            productoCompra.push({ 'id': idProducto, 'descripcion': descripcion, 'precio': precio, 'cantidad': cantidad, 'importe': importe });
            productos.length = 0
            productos.push(productoCompra);
            $.post("../../controllers/producto.php?op=agregarCarrito", { carrito: productos }, function (data) {
                $('#modalProducto').modal('hide');

                data = JSON.parse(data);
                swal({
                    title: "Agregado!",
                    icon: "success",
                    text: "Producto agregado al carrito"

                });
            })
        } else {
            $('#modalProducto').modal('hide');
            swal({
                title: "Existe en carrito!",
                icon: "warning",
                text: "Producto ya se encuentra en él carrito, dirigase a el si desea cambiar la cantidad!"

            });
        }




    });






});
