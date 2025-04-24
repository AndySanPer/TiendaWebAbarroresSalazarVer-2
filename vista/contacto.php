<?php include_once "encabezado.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Abarrotes Salazar</title>
    <link rel="stylesheet" href="css/contacto.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/popper.min.js"></script>

    <script>
    $(document).ready(function() {
    $("form").submit(function(event) {
        event.preventDefault(); 

        
        var nombre = $("input[placeholder='Nombre']").val().trim();
        var apellidos = $("input[placeholder='Apellido']").val().trim();
        var correo = $("input[placeholder='Correo electrónico']").val().trim();
        var telefono = $("input[placeholder='Teléfono']").val().trim();
        var motivo = $("#motivo").val();
        var mensaje = $(".textarea-field").val().trim();

        
        // alert("Nombre: " + nombre);
        // alert("Apellidos: " + apellidos);
        // alert("Correo: " + correo);
        // alert("Teléfono: " + telefono);
        // alert("Motivo: " + motivo);
        // alert("Mensaje: " + mensaje);

        
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var telefonoRegex = /^[0-9]{10}$/;

        if (!nombre || !apellidos || !correo || !telefono || !motivo || !mensaje) {
            alert("Por favor, complete todos los campos.");
            return;
        }
        if (!emailRegex.test(correo)) {
            alert("Correo inválido.");
            return;
        }
        if (!telefonoRegex.test(telefono)) {
            alert("Teléfono inválido (10 dígitos).");
            return;
        }

        // Enviar AJAX
        $.ajax({
            url: "../controlador/alta_contactanos.php", // 
            type: "POST",
            data: {
                nombre: nombre,
                apellidos: apellidos,
                correo: correo,
                telefono: telefono,
                motivo: motivo,
                mensaje: mensaje
            },
            success: function(response) {
                console.log("Respuesta del servidor: ", response);
                alert(response); // 
                if (response.includes("exitosamente")) {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.log("Error AJAX: ", error);
                alert("Error al enviar el mensaje.");
            }
        });
    });
});

    </script>

</head>
<body>
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-form">
                <h2 class="contact-title">Contáctanos</h2>
                <p class="contact-subtitle">¿Tienes alguna duda o quieres hacer un pedido? Envíanos un mensaje.</p>
                <form>
                    <div class="form-group">
                        <input class="input-field" type="text" placeholder="Nombre" required>
                        <input class="input-field" type="text" placeholder="Apellido" required>
                    </div>
                    <div class="form-group">
                        <input class="input-field" type="email" placeholder="Correo electrónico" required>
                        <input class="input-field" type="tel" placeholder="Teléfono" required>
                    </div>
                    <div class="form-group">
                        <select id="motivo" name="motivo" class="select-field">
                            <option value="" disabled selected>Motivo de contacto</option>
                            <option value="realizar un pedido">Realizar un pedido</option>
                            <option value="soy proveedor">Soy proveedor</option>
                            <option value="solicitar información">Solicitar información</option>
                        </select>
                    </div>
                    <textarea class="textarea-field" placeholder="Mensaje" required></textarea>
                    <button class="contact-button" type="submit">Enviar mensaje</button>
                </form>
            </div>
            <div class="contact-info">
                <h2 class="contact-title">Información de contacto</h2>
                <p class="contact-text"><strong>📍 Dirección:</strong> Moctezuma 11, Barrio del Carmen, 54960 Tultepec, Méx.</p>
                <p class="contact-text"><strong>📞 Teléfono:</strong> +52 55 1234 5678</p>
                <p class="contact-text"><strong>📧 Correo:</strong> contacto@abarrotessalazar.com</p>
                <ul class="schedule-list">
                    <li>Lunes a Sábado: 7:30 AM - 10:00 PM</li>
                    <li>Domingo: Cerrado</li>
                </ul>
                <div class="social-icons">
                    <img class="social-icon" src="img/face.png" alt="Facebook">
                    <img class="social-icon" src="img/what.png" alt="WhatsApp">
                    <img class="social-icon" src="img/insta.png" alt="Instagram">
                </div>
            </div>
        </div>
    </section>
</body>
</html>

