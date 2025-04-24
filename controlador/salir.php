<?php
session_start(); // Iniciar la sesión si no está iniciada

// Cerrar sesión
if (isset($_POST['cerrar_sesion'])) {
    session_unset(); // Desactivar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Cerrando sesión...</title>
                <link rel="stylesheet" href="../vista/css/salir.css"> <!-- Enlazar archivo de estilos CSS -->
            </head>
            <body>
                <div class="cerrar-sesion">
                    <div class="logo-container">
                        <img src="../vista/img/logo.png" alt="Logo" class="logo">
                    </div>
                    <p>Cerrando sesión...</p>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "../vista/index.php";
                    }, 3000); // Redirigir a ../vista/index.php después de 3 segundos
                </script>
            </body>
            </html>
';
    exit;
}
?>
