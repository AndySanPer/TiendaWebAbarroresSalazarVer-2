<?php include_once "encabezado.php"; ?>
<?php include_once "../modelo/servidor.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate</title>
    <link rel="stylesheet" href="css/registrate.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#forma').on('submit', function(event){
                event.preventDefault();

                var nombre = $('#nombre').val().trim();
                var apellidos = $('#apellidos').val().trim();
                var correo = $('#correo').val().trim();
                var conficorreo = $('#conficorreo').val().trim();
                var contraseña = $('#contraseña').val().trim();
                var conficontraseña = $('#conficontraseña').val().trim();
                var tipo = 'cliente'; // Se asigna automáticamente como cliente

                if (nombre === '' || apellidos === '' || correo === '' || conficorreo === '' || contraseña === '' || conficontraseña === '') {
                    alert('Por favor completa todos los campos.');
                    return;
                }

                if (correo !== conficorreo) {
                    alert('El correo y la confirmación de correo no coinciden.');
                    $('#correo').val('');
                    $('#conficorreo').val('');
                    return;
                }

                if (contraseña !== conficontraseña) {
                    alert('La contraseña y la confirmación de contraseña no coinciden.');
                    $('#contraseña').val('');
                    $('#conficontraseña').val('');
                    return;
                }

                registrarUsuario(nombre, apellidos, correo, contraseña, tipo);
            });

            function registrarUsuario(nombre, apellidos, correo, contraseña, tipo){
                $.ajax({
                    url: '../controlador/registratebase.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { nombre: nombre, apellidos: apellidos, correo: correo, password: contraseña, tipo: tipo },
                    success: function(resultados){
                        if (resultados.error === 'error correo') {
                            alert('El correo proporcionado ya existe. Por favor, ingresa uno válido.');
                            $('#correo').val('');
                            $('#conficorreo').val('');
                        } else if (resultados.error === 'error sql') {
                            alert('Error en el servidor. Inténtalo más tarde.');
                        } else {
                            alert("¡Bienvenido " + resultados.nombre + "! Para continuar ingresa tu correo y contraseña");
                            limpiarFormulario();
                            window.location.href = "login.php";
                        }
                    },
                    error: function(){
                        alert('Error en el servidor. Inténtalo más tarde.');
                    }
                });
            }

            function limpiarFormulario(){
                $('#nombre').val('');
                $('#apellidos').val('');
                $('#correo').val('');
                $('#conficorreo').val('');
                $('#contraseña').val('');
                $('#conficontraseña').val('');
            }
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <div class="imagen text-center mb-3">
                <img src="img/logo.png" alt="Logo" style="width: 100px;">
            </div>
            <form id="forma" method="POST">
                <div class="field-container">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required class="form-control">
                </div>
                <div class="field-container">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" required class="form-control">
                </div>
                <div class="field-container">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required class="form-control">
                </div>
                <div class="field-container">
                    <label for="conficorreo">Confirma tu correo:</label>
                    <input type="email" id="conficorreo" name="conficorreo" required class="form-control">
                </div>
                <div class="field-container">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" required class="form-control">
                </div>
                <div class="field-container">
                    <label for="conficontraseña">Confirma tu contraseña:</label>
                    <input type="password" id="conficontraseña" name="conficontraseña" required class="form-control">
                </div>
                <div class="text-center">
                    <button id="enviar" type="submit" class="btn btn-primary">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
