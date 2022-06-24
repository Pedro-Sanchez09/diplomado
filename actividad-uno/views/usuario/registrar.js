document.getElementById("passwordV").addEventListener("blur", verificarPassword);
document.getElementById("usuario").addEventListener("blur", verificarUsuario);

var verificar = Object();
var mensaje = '';


function verificarPassword() {


    var pass = document.getElementById("password").value;
    var passV = document.getElementById("passwordV").value;

    if (pass.length >= 6 || passV.length >= 6) {
        if (pass != passV) {
            mensaje = "<span style='color:red;'>¡Las contraseñas no coinciden! </span>";
            verificar.password = '';
            $('#mensPass').fadeIn().html(mensaje);
        } else {

            mensaje = '';
            $('#mensPass').fadeOut().html(mensaje);
        }
    } else {
        verificar.password = '';
        mensaje = "<span style='color:red;'>¡Las contraseñas deben tener mino 6 caracteres! </span>";
        $('#mensPass').fadeIn().html(mensaje);
    }

}

function verificarUsuario() {

    var user = document.getElementById("usuario").value;

    $.ajax({
        url: "../../controllers/usuario.php?op=validUser",
        type: "POST",
        data: { user: user },
        success: function (data) {

            data = JSON.parse(data);
            console.log('Datos', data);


            if (data.length > 0) {
                mensaje = "<span style='color:red'>¡Usuario invalido! </span>";
                $('#mensajeE').fadeIn().html(mensaje);
                verificar.usuario = '';
            } else {
                mensaje = "<span style='color:green'>¡Usuario valido! </span>";
                $('#mensajeE').fadeIn().html(mensaje);

            }

        }

    });


}


$(document).ready(function () {


    $('#formRegistro').submit(function (e) {
        e.preventDefault();

        var formData = new FormData($("#formRegistro")[0]);




        if ((verificar.password == undefined) && (verificar.usuario == undefined)) {


            $.ajax({
                url: "../../controllers/usuario.php?op=crearUsuario",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {


                    datos = JSON.parse(datos);
                    console.log("Res", datos);
                    if (datos.STATUS == 'OK') {

                        swal({
                            title: 'Usuario registrado',
                            icon: 'success',
                        }).then(() => {

                            $('#formRegistro')[0].reset();
                            $('.mostrar').fadeOut().html(mensaje);

                        });

                    }else{
                        swal({
                            title: 'Cliente existe',
                            icon: 'error',
                            text:'La cédula ingresada ya se encuentra en el sistema!'
                        }) 
                    }

                }

            });

        } else {

            $('#mensaje').fadeIn().html("<span style='color:red;'>¡Por favor llenar todos los campos! </span>");
        }
    });



    $(document).on('click', '#cancelar', function () {


        window.location.href = "../../";

    });

});