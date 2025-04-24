<?php 
include_once "../modelo/servidor.php";
include_once "encabezado.php";

$productos_por_pagina = 8;

if (isset($_GET['pagina'])) {
    $pagina_actual = $_GET['pagina'];
} else {
    $pagina_actual = 1;
}

$productonoquiero = ($pagina_actual - 1) * $productos_por_pagina;
$categoria = $_GET['categoria'];

$cone = new Servidor("root","proyecto","");
$conexion = $cone->conecta(); 
$sql = $conexion->prepare("SELECT * FROM productos WHERE categoria = '$categoria' LIMIT $productonoquiero, $productos_por_pagina");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();

$productos = array();

while ($registro = $sql->fetch()) {
    $productos[] = array(
        'id' => $registro['id'],
        'nombre' => $registro['producto'],
        'imagen' => $registro['imagen'],
        'alterno' => $registro['alterno'],
        'descripcion' => $registro['descripcion'],
        'estado' => $registro['estado'],
        'precio' => $registro['precio'],
        'cantidad' => $registro['cantidad'] // Agregamos la cantidad
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/productos.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>

    <script>
        $(function(){
            $('.comprar:not(.disabled)').click(function() {
                var id = $(this).data('id');
                window.location.href = "detalleproducto.php?id=" + id;
            });
        });
    </script>

</head>
<body>

<div class="contenedor">
    <?php foreach ($productos as $productoreconocido){ 
        $sinStock = $productoreconocido['cantidad'] <= 0 ? 'sin-stock' : ''; 
        $botonTexto = $productoreconocido['cantidad'] > 0 ? '+ Agregar' : 'No disponible';
        $botonClase = $productoreconocido['cantidad'] > 0 ? '' : 'disabled';
    ?>
        <div class="caja <?php echo $sinStock; ?>">
            <img src="<?php echo $productoreconocido['imagen']; ?>" alt="<?php echo $productoreconocido['alterno']; ?>" class="imagen2">
            <div class="nombre"><?php echo $productoreconocido['nombre'];?></div>
            <div class="precio">$<?php echo $productoreconocido['precio']; ?></div>
            <div class="descripcion"><?php echo $productoreconocido['descripcion']; ?></div>
            <div class="divboton">
                <button type="button" class="boton comprar <?php echo $botonClase; ?>" data-id="<?php echo $productoreconocido['id']; ?>">
                    <?php echo $botonTexto; ?>
                </button>
            </div>
        </div>
    <?php } ?>
</div>

<?php
$sql_total = $conexion->prepare("SELECT COUNT(*) AS total FROM productos WHERE categoria = '$categoria'");
$sql_total->execute();
$total_registros = $sql_total->fetch()['total'];
$total_paginas = ceil($total_registros / $productos_por_pagina);

if ($total_paginas > 1) {
    echo '<div class="pagination">';
    if ($pagina_actual > 1) {
        echo '<a href="?categoria=' . $categoria . '&pagina=' . ($pagina_actual - 1) . '">Anterior</a>';
    }
    for ($i = 1; $i <= $total_paginas; $i++) {
        if ($i == $pagina_actual) {
            echo '<span>' . $i . '</span>';
        } else {
            echo '<a href="?categoria=' . $categoria . '&pagina=' . $i . '">' . $i . '</a>';
        }
    }
    if ($pagina_actual < $total_paginas) {
        echo '<a href="?categoria=' . $categoria . '&pagina=' . ($pagina_actual + 1) . '">Siguiente</a>';
    }
    echo '</div>';
}
?>

</body>
</html>

