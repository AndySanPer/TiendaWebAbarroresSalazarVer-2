<?php
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
include_once "encabezado.php";

$id = $_REQUEST['id']; // Asegúrate de que $id esté disponible

$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta();
$sql = $conexion->prepare("SELECT * FROM productos WHERE id = :id");
$sql->bindParam(':id', $id, PDO::PARAM_INT);
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();

$producto = $sql->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/detalleproducto.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>

    <title>Detalle Producto</title>

    <script>
    $(function(){
        $(document).ready(function () {
    $("#btn_agregar").click(function () {
        let nombre = <?php echo json_encode($_SESSION['nombre'] ?? ""); ?>;
        let id_cliente = <?php echo json_encode($_SESSION['id'] ?? null); ?>;

        if (!id_cliente) {
            alert("Debes iniciar sesión para agregar productos al carrito.");
            window.location.href = "login.php";
            return;
        }

        let cantidad = $("#cantidad").val();
        let productoID = <?php echo json_encode($producto['id']); ?>;
        let precio = <?php echo json_encode($producto['precio']); ?>;
        let total = cantidad * precio;
        let tipo = <?php echo json_encode($_SESSION['tipo'] ?? ""); ?>;

        $.getJSON("../controlador/ventas.php", {
            id: productoID,
            cantidad: cantidad,
            total: total,
            nombre: nombre,
            tipo: tipo,
            id_cliente: id_cliente
        }, function (response) {
            alert(response.message);
        });
    });
});

    });
</script>


    
</head>
<body>
    <main class="producto-detallado">
        <section class="divizquierdo">
            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['alterno']); ?>" class="imagen2">
        </section>

        <section class="divderecho">
            <h2 class="nombreproducto"><?php echo htmlspecialchars($producto['producto']); ?></h2>
            <p class="precio">$<?php echo number_format($producto['precio'], 2); ?></p>
            <p class="descuento"><span class="precio-original">$<?php echo number_format($producto['precio'] * 1.3, 2); ?></span> Ahorras 25%</p>
            <p class="stock">Stock disponible: <span><?php echo htmlspecialchars($producto['cantidad']); ?></span></p>

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" value="1">

            <button type="button" class="boton" id="btn_agregar">Agregar al carrito</button>

            <!-- Nueva sección de detalles de envío -->
            <div class="detalles-envio">
                <p>📍 <span class="resaltado">Pickup</span> sin costo en tienda</p>
                <p>🚚 Envío disponible, <span class="resaltado">entrega estimada mañana</span></p>
                <p>🏪 Vendido y enviado por <span class="resaltado">Abarrotes Salazar</span></p>
                <p>🔄 <span class="resaltado">Devolución no disponible</span></p>
            </div>
        </section>
    </main>
</body>
</html>

