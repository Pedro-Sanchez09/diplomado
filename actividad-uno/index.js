
var usuario = document.getElementById('usuario');
var password = document.getElementById('password');


$('#formLogin').submit(function (e) {
    e.preventDefault();


    if (usuario.value != "" && password.value != "") {


        $.post("./controllers/usuario.php?op=validLogin", { user: usuario.value, pass: password.value }, function (data) {

            data = JSON.parse(data);
            if (data == 'OK') {
                console.log(typeof (data));
                window.location.href = "./views/verificar-rol.php";

            } else {
                $('#mensaje').html("<span style='color:red;'>Usuario o Password incorrectos!</span>");
            }



        });
    } 
      


});
