<?php
include_once "encabezado.php";

if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = "Sin identificar";
} else {
    if (isset($_REQUEST['nombre'])) { 
        $_SESSION['nombre'] = $_REQUEST['nombre'];
        $_SESSION['tipo'] = $_REQUEST['tipo'];
        $_SESSION['id'] = $_REQUEST['id'];
    }
}

include_once "../modelo/servidor.php"; 

// Crear la conexión usando la clase Servidor
$cone = new Servidor("root", "proyecto", ""); 
$conexion = $cone->conecta();

if (!$conexion) {
    die("Error al conectar con la base de datos.");
}

// Obtener el ID del cliente de la sesión
$id_cliente = $_SESSION['id'];

try {
    // Consulta con JOIN para unir las tablas ventas y productos, incluyendo el estado
    $sql = "SELECT v.id_venta, v.id_producto, v.cantidad, v.total, v.precio, v.estado, 
               p.producto, p.imagen, p.alterno 
        FROM ventas v
        INNER JOIN productos p ON v.id_producto = p.id
        WHERE v.id_cliente = :id_cliente AND v.estado IN ('carro', 'pendiente')";

$stmt = $conexion->prepare($sql);
$stmt->bindValue(":id_cliente", $id_cliente, PDO::PARAM_INT);
$stmt->execute();
$ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Subtotal y total solo de productos con estado "carro"
$subtotal = 0;
foreach ($ventas as $venta) {
    if ($venta['estado'] === 'carro') { // Filtrar solo los productos en el carrito
        $subtotal += $venta['total'];
    }
}
$envio = 54.00;
$total = ($subtotal > 0) ? $subtotal + $envio : 0; // Si no hay productos en carro, total = 0

    // Cerrar conexión
    $conexion = null;
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/carrito.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <title>Carrito</title>

    <script>
    $(document).ready(function () {
        $(".btn-eliminar").click(function () {
            let idVenta = $(this).data("id");
            let fila = $(this).closest(".item-carrito"); // Identificar el elemento padre a eliminar

            $.ajax({
                url: "../controlador/btn_eliminar_producto_carro.php",
                type: "POST",
                data: { id_venta: idVenta },
                dataType: "json", // Esperamos una respuesta en formato JSON
                success: function (response) {
                    if (response.status === "success") {
                        
                        // Actualizar el subtotal y total
                        let valorARestar = parseFloat(response.valor_a_restar);
                        
                        // Obtener el subtotal y total actuales de los elementos correctos
                        let subtotal = parseFloat($(".fw-bold.subtotal").text().replace('$', '').trim());
                        let envio = parseFloat($(".text-muted.envio").text().replace('$', '').trim());

                        // Asegurarnos de que los valores no sean NaN
                        if (isNaN(subtotal)) subtotal = 0;
                        if (isNaN(envio)) envio = 54;
                        
                        // Restar el valor del producto eliminado del subtotal
                        subtotal -= valorARestar;
                        
                        // Recalcular el total
                        let total = subtotal + envio;

                        // Asegurarse de que el total no sea NaN
                        if (isNaN(total)) total = 0;

                        // Actualizamos los valores en la interfaz
                        $(".fw-bold.subtotal").text("$" + subtotal.toFixed(2)); // Actualiza el subtotal
                        $(".fw-bold.total").text("$" + total.toFixed(2)); // Actualiza el total
                        location.reload(); 

                    } else {
                        alert("Error al eliminar el producto");
                    }
                },
                error: function () {
                    alert("Error en la conexión con el servidor");
                }
            });
        });


    $(".btn-agregar_producto").click(function () {
    let idVenta = $(this).data("id");
    let cantidadElemento = $(this).prev("span"); // Referencia al elemento que muestra la cantidad
    let cantidadActual = parseInt(cantidadElemento.text());
    let nuevaCantidad = cantidadActual + 1;

    // Obtener el precio unitario desde el precio tachado (original) en la interfaz
    let precioUnitario = parseFloat($(this).closest(".item-carrito").find(".text-danger").text().replace('$', '').trim());

    $.ajax({
        url: "../controlador/btn_agregar_producto_carro.php",
        type: "POST",
        data: { id_venta: idVenta, cantidad: nuevaCantidad },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                cantidadElemento.text(nuevaCantidad);

                // Calcular el nuevo total del producto
                let nuevoTotal = precioUnitario * nuevaCantidad;
                $(cantidadElemento).closest(".item-carrito").find(".text-success").text("$" + nuevoTotal.toFixed(2));

                // Actualizar el subtotal y total en el carrito
                let subtotal = parseFloat($(".fw-bold.subtotal").text().replace('$', '').trim());
                let envio = parseFloat($(".text-muted.envio").text().replace('$', '').trim());

                if (isNaN(subtotal)) subtotal = 0;
                if (isNaN(envio)) envio = 54;

                subtotal += precioUnitario; // Aumentamos el subtotal con el precio del producto
                let total = subtotal + envio;

                $(".fw-bold.subtotal").text("$" + subtotal.toFixed(2));
                $(".fw-bold.total").text("$" + total.toFixed(2));
                location.reload();
            } else if (response.status === "no_stock") {
                alert("Stock insuficiente. Solo puedes agregar " + response.stock_disponible + " unidades.");
            } else {
                alert("Error al actualizar la cantidad del producto");
            }
        },
        error: function () {
            alert("Error en la conexión con el servidor");
        }
    });
});


// Restar producto
$(".btn-restar_producto").click(function () {
    let idVenta = $(this).data("id");
    let cantidadElemento = $(this).next("span"); // El span está después del botón de restar
    let cantidadActual = parseInt(cantidadElemento.text());

    // Evitar que la cantidad sea menor a 1
    if (cantidadActual <= 1) {
        return; // No hacemos nada si la cantidad ya es 1
    }

    let nuevaCantidad = cantidadActual - 1; // Restamos 1

    // Obtener el precio unitario desde la interfaz
    let precioUnitario = parseFloat($(this).closest(".item-carrito").find(".text-danger").text().replace('$', '').trim());

    $.ajax({
        url: "../controlador/btn_restar_producto_carro.php",
        type: "POST",
        data: { id_venta: idVenta, cantidad: nuevaCantidad },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                cantidadElemento.text(nuevaCantidad); // Actualiza la cantidad en pantalla

                // Calcular el nuevo total del producto
                let nuevoTotal = precioUnitario * nuevaCantidad;
                $(cantidadElemento).closest(".item-carrito").find(".text-success").text("$" + nuevoTotal.toFixed(2));

                // Actualizar el subtotal y total en el carrito
                let subtotal = parseFloat($(".fw-bold.subtotal").text().replace('$', '').trim());
                let envio = parseFloat($(".text-muted.envio").text().replace('$', '').trim());

                if (isNaN(subtotal)) subtotal = 0;
                if (isNaN(envio)) envio = 54;

                subtotal -= precioUnitario; // Restamos el precio del producto al subtotal
                let total = subtotal + envio;

                $(".fw-bold.subtotal").text("$" + subtotal.toFixed(2));
                $(".fw-bold.total").text("$" + total.toFixed(2));
                location.reload();
            } else {
                alert("Error al actualizar la cantidad del producto");
            }
        },
        error: function () {
            alert("Error en la conexión con el servidor");
        }
    });
});

//btn_continuar

$(document).ready(function () {
    $(".btn_continuar").click(function () {
        let idCliente = <?php echo isset($_SESSION['id']) ? json_encode($_SESSION['id']) : 'null'; ?>;

        if (idCliente === null) {
            alert("Error: No se encontró el ID del cliente.");
            return;
        }

        $.ajax({
            url: "../controlador/carrito_btn_continuar.php",
            type: "POST",
            data: { id_cliente: idCliente },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("¡Tu pedido esta en camino!");
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert("Error al actualizar el pedido.");
                }
            },
            error: function () {
                alert("Error en la conexión con el servidor.");
            }
        });
    });
});

});
    
</script>


</head>
<body>
    <div class="container_car mt-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5>🛒 Carrito (<?php echo count($ventas); ?> artículos)</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <strong>Envío a domicilio, llega entre mañana, sáb. 15 de marzo – vie. 28 de marzo</strong>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <h6 class="fw-bold"><?php echo count($ventas); ?> artículos</h6>

                        <?php foreach ($ventas as $venta): ?>
                            <?php 
                                // Si el estado es "pendiente", aplicar estilos de deshabilitación
                                $claseEstado = ($venta['estado'] == 'pendiente') ? 'opacidad' : '';
                                $botonDisabled = ($venta['estado'] == 'pendiente') ? 'disabled' : '';
                            ?>
                            <div class="border p-3 mb-3 item-carrito <?php echo $claseEstado; ?>" style="position: relative;">
                                <?php if ($venta['estado'] == 'pendiente'): ?>
                                    <div class="etiqueta-pendiente">En camino</div>
                                <?php endif; ?>
                                <div class="d-flex align-items-start">
                                    <img src="<?php echo $venta['imagen']; ?>" alt="<?php echo $venta['producto']; ?>" class="img-thumbnail" style="max-width: 80px;">
                                    <div class="ms-3">
                                        <h6><?php echo $venta['producto']; ?></h6>
                                        <p class="text-danger text-decoration-line-through">$<?php echo number_format($venta['precio'], 2); ?></p>
                                        <p class="text-success fw-bold">$<?php echo number_format($venta['total'], 2); ?></p>
                                        <button class="btn btn-sm btn-outline-danger btn-eliminar" data-id="<?php echo $venta['id_venta']; ?>" <?php echo $botonDisabled; ?>>Eliminar</button>
                                        <div class="d-inline-block ms-2">
                                            <button class="btn btn-sm btn-outline-secondary btn-restar_producto" data-id="<?php echo $venta['id_venta']; ?>" <?php echo $botonDisabled; ?>>-</button>
                                            <span class="mx-2"><?php echo $venta['cantidad']; ?></span>
                                            <button class="btn btn-sm btn-outline-secondary btn-agregar_producto" data-id="<?php echo $venta['id_venta']; ?>" <?php echo $botonDisabled; ?>>+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                    
                    <div class="col-md-4">
                        <div class="border p-3">
                            <h6>Resumen</h6>
                            <p><span class="text-muted">Subtotal:</span> <span class="fw-bold subtotal">$<?php echo number_format($subtotal, 2); ?></span></p>
                            <p><span class="text-muted envio">Envío a domicilio:</span> $<?php echo number_format($envio, 2); ?></p>
                            <hr>
                            <h5>Total: <strong class="fw-bold total">$<?php echo number_format($total, 2); ?></strong></h5>
                            <button class="btn btn-success w-100 mt-2 btn_continuar">Continuar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>