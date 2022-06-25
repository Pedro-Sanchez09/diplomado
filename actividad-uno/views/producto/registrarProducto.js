
$(document).ready(function () {
    var productosCompra = new Array();
    var ref = $("#idProducto")
    var precio = $("#precio")
    var descripcion = $("#descripcion");
    var cantidad = $("#cantidad");
    var fecha;



    $('#formRegistro').submit(function (e) {
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        var importe = precio.val() * cantidad.val();

        if (descripcion.val() != "") {
            agregarFila(ref.val(), descripcion.val(), cantidad.val(), precio.val(), importe);
            $('#descripcion').val('');
            $('#precio').val('');
            $('#cantidad').val('');
            $('#idProducto').val('');

        }

    });

    ref.blur(() => getProductoById());




    function agregarFila(ref, descrip, cantidad, precio, importe) {


        if (buscarProductoTabla(ref)[0] == "agregar" && buscarProductoTabla(ref)[1] == -1) {
            var htmlTags = '<tr>' +
                '<td>' + ref + '</td>' +
                '<td>' + descrip + '</td>' +
                '<td>' + cantidad + '</td>' +
                '<td>' + precio + '</td>' +
                '<td>' + importe + '</td>' +
                '</tr>';
            $('#tablaProductos tbody').append(htmlTags);
        } else if (buscarProductoTabla(ref)[0] == "modificar" && buscarProductoTabla(ref)[1] >= 0) {
            $('#tablaProductos').find('tr').eq(buscarProductoTabla(ref)[1]).find('td').eq(2).html(cantidad);
        }







    }

    function buscarProductoTabla(referencia) {

        var nFilas = $("#tablaProductos tr").length;
        var respuesta = ["agregar", -1];

        if (nFilas > 1) {

            for (var i = 1; i < nFilas; i++) {

                var ref = parseInt(($('#tablaProductos').find('tr').eq(i).find('td').eq(0).html()));
                if (referencia == ref) {
                    var cant = parseInt(($('#tablaProductos').find('tr').eq(i).find('td').eq(2).html()));
                    if (cant != $('#cantidad').val()) {
                        respuesta[0] = "modificar";

                    }
                    respuesta[1] = i;
                } else {

                }


            }
        }
        return respuesta;

    }

    function llenarArrayProductos() {

        var filasTabla = $("#tablaProductos tr").length;
        var columTabla = $("#tablaProductos th").length;
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var year = d.getFullYear();
        fecha = year + "-" + month + "-" + day;

        productosCompra.length = 0;

        for (var i = 1; i < filasTabla; i++) {
            var filas = Array();
            for (var j = 0; j < columTabla; j++) {


                var valor = ($('#tablaProductos').find('tr').eq(i).find('td').eq(j).html());
                if (j == 0 || j == 2 || j == 4) {
                    valor = ($('#tablaProductos').find('tr').eq(i).find('td').eq(j).html());
                    filas.push(valor);

                }

            }

            productosCompra.push(filas);
        }

    }


    //Guardar productos de la lista de compra.

    $("#btncomprar").click(function () {
        var filasTabla = $("#tablaProductos tr").length;
        var cc = $('#cc').val();

        if (cc != "" && filasTabla > 1) {

            llenarArrayProductos();

            $.post("../../controllers/producto.php?op=setCompra", { productos: productosCompra, fecha: fecha, cliente: cc }, function (data) {




                data = JSON.parse(data);

                if (data.STATUS == 'ERROR') {

                    swal({
                        title: "Cliente no existe!",
                        icon: "error",

                    });
                } else {
                    $('#formRegistro').trigger("reset");
                    swal({
                        title: "Compra registrada!",
                        icon: "success",

                    }).then(() => {
                        location.reload();
                    });
                }
            });
        } else {
            $('#mensajeU').html("<span style='color:red;'>Llenar campo cliente o agregar productos</span>");
        }





    });


    function getProductoById() {

        $.get("../../controllers/producto.php?op=getProducto", { id: ref.val() }, function (data) {
            data = JSON.parse(data);
            if (data.DATA.length > 0) {
                $('#descripcion').val(data.DATA[0].descripcion);
                $('#precio').val(data.DATA[0].precio);
                $('#prod').html("")
            } else {
                $('#prod').html("<span style='color:red;'>Porducto no existe</span>")
            }


        });
    }
});