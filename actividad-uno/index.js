console.log('index');
var usuario = document.getElementById('usuario');
var password = document.getElementById('password');


$('#formLogin').submit(function (e) {
    e.preventDefault();


    if (usuario.value != "" && password.value != "") {

        console.log('login');
        $.post("./controllers/usuario.php?op=validLogin", { user: usuario.value, pass: password.value }, function (data) {
            $('#formLogin').trigger("reset");


        });
    } else {
        console.log('vacio');
    }


});
