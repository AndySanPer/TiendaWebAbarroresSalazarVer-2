<?php 
include_once "encabezado.php";
include_once "../modelo/servidor.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mantenimientoproductos.css"> <!-- Archivo CSS separado -->
   

    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/mantenimientoproductos.js"></script> <!-- Archivo JS separado -->

    <script>
      $(function() {
    function imprimir() {
        $.getJSON("../controlador/consultaproductos.php", {}, function(datos) {
            $("#tabla tbody").empty();
            for (let i = 0; i < datos.length; i++) {
                var row = '<tr>' +
                    '<td>' + datos[i].id + '</td>' +
                    '<td>' + datos[i].producto + '</td>' +
                    '<td>' + datos[i].imagen + '</td>' +
                    '<td>' + datos[i].alterno + '</td>' +
                    '<td>' + datos[i].descripcion + '</td>' +
                    '<td>' + datos[i].estado + '</td>' +
                    '<td>' + datos[i].precio + '</td>' +
                    '<td>' + datos[i].categoria + '</td>' +
                    '<td>' + datos[i].cantidad + '</td>' +
                    '<td>' + datos[i].proveedor + '</td>' +
                    '<td><button class="borra btn" data-id="' + datos[i].id + '"><img class="img-fluid" src="img/basurachico.png"></button></td>' +
                    '<td><button class="modifica btn" data-id="' + datos[i].id + '"><img class="img-fluid" id="cambia" src="img/modificarchico.png"></button></td>' +
                    '</tr>';
                $("#tabla tbody").append(row);
            }
        });
    }
    
    imprimir();

    $('#grabar').on('click', function(){
        var id = $('#id').val();
        var producto = $('#producto').val();
        var imagen = $('#imagen').val();
        var alterno = $('#alterno').val();
        var descripcion = $('#descripcion').val();
        var estado = $('#estado').val();
        var precio = $('#precio').val();
        var categoria = $('#categoria option:selected').val();
        var cantidad = $('#cantidad').val();
        var proveedor = $('#proveedor option:selected').val();

        // alert("Valores capturados:\n" +
        //     "ID: " + id + "\n" +
        //     "Producto: " + producto + "\n" +
        //     "Imagen: " + imagen + "\n" +
        //     "Alterno: " + alterno + "\n" +
        //     "Descripción: " + descripcion + "\n" +
        //     "Estado: " + estado + "\n" +
        //     "Precio: " + precio + "\n" +
        //     "Categoría: " + categoria + "\n" +
        //     "Cantidad: " + cantidad + "\n" +
        //     "Proveedor: " + proveedor);
        
        $.getJSON("../controlador/altaproductos.php", {id, producto, imagen, alterno, descripcion, estado, precio, categoria, cantidad, proveedor}, function(resultados) {
            if (resultados == 'okey') {
                alert('¡Registro dado de alta con éxito!');
                limpiaalta();
                refrescarpagina();
                imprimir();
            } else {
                alert('Ocurrió un error al intentar registrar el producto :(');
            }
        });
    });

    function limpiaalta() {
        // Limpiar los valores de los campos del formulario
        $('#id').val('');
        $('#producto').val('');
        $('#imagen').val('');
        $('#alterno').val('');
        $('#descripcion').val('');
        $('#estado').val('');
        $('#precio').val('');
        $('#categoria').val('');
        $('#categoria, #proveedor').prop('selectedIndex', 0);
    }


    function refrescarpagina() {
        location.reload();
    }

    $('#tabla').on('click', '.modifica', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');
        $('#id').val(id).prop('readonly', true);
        $('#producto').val(row.find('td:eq(1)').text());
        $('#imagen').val(row.find('td:eq(2)').text());
        $('#alterno').val(row.find('td:eq(3)').text());
        $('#descripcion').val(row.find('td:eq(4)').text());
        $('#estado').val(row.find('td:eq(5)').text());
        $('#precio').val(row.find('td:eq(6)').text());
        $('#categoria').val(row.find('td:eq(7)').text());
        $('#cantidad').val(row.find('td:eq(8)').text());
        $('#proveedor').val(row.find('td:eq(9)').text());
    });

    $('#tabla').on('click', '.borra', function() {
        var id = $(this).data('id');
        if (confirm("¿Estás seguro de borrar el registro?")) {
            $.getJSON("../controlador/btnborrarproducto.php", { registro: id }, function(resultados) {
                if (resultados == 'okey') {
                    alert('¡Registro borrado con éxito!');
                    imprimir();
                    refrescarpagina();
                } else {
                    alert('Ocurrió un error al intentar borrar el registro :(');
                }
            });
        }
    });
});
    </script>
    
</head>
<body>
    <div class="separa">

    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 formulario">
            <!-- Formulario de registro de datos -->
            <form id="formulario-productos">
            <div class="mb-3" id="id-container">
                <label for="clave" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" readonly>
            </div>
            <div class="mb-3">
                <label for="producto" class="form-label">PRODUCTO</label>
                <textarea class="form-control" id="producto"></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">IMAGEN</label>
                <textarea class="form-control" id="imagen"></textarea>
            </div>
            <div class="mb-3">
                <label for="alterno" class="form-label">ALTERNO</label>
                <textarea class="form-control" id="alterno"></textarea>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">DESCRIPCIÓN</label>
                <textarea class="form-control" id="descripcion"></textarea>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">ESTADO</label>
                <textarea class="form-control" id="estado"></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">PRECIO</label>
                <input type="number" class="form-control" id="precio" name="precio">
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">CATEGORIA</label>
                <select class="form-control" id="categoria" name="categoria">
                    <option value="">Seleccione una categoría</option>
                    <option value="fresco">fresco</option>
                    <option value="enlatado">enlatado</option>
                    <option value="bebidas">bebidas</option>
                    <option value="snacks">snacks</option>
                    <option value="limpieza">limpieza</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">CANTIDAD</label>
                <input type="number" class="form-control" id="cantidad">
            </div>
            <div class="mb-3">
                <label for="proveedor" class="form-label">PROVEEDOR</label>
                <select class="form-control" id="proveedor" name="proveedor">
                    <option value="">Seleccione un proveedor</option>
                    <option value="sabritas">sabritas</option>
                    <option value="coca">coca</option>
                    <option value="bimbo">bimbo</option>
                    <option value="tiarosa">tiarosa</option>
                    <option value="marinela">marinela</option>
                    <option value="grupo corona">grupo corona</option>
                    <option value="la costeña">la costeña</option>
                    <option value="alpura">alpura</option>
                    <option value="jarritos">jarritos</option>
                    <option value="ace">ace</option>
                    <option value="ariel">ariel</option>
                    <option value="lala">lala</option>
                    <option value="kelloggs">kelloggs</option>
                    <option value="rancho salazar">rancho salazar</option>
                    <option value="dolores">dolores</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" id="grabar">Grabar</button>
            <button type="button" class="btn btn-secondary" id="limpiar">Limpiar Campos</button>
        </form>
        </div>
        <div class="col-md-8">
            <!-- Tabla de productos -->
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">ALTERNO</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CATEGORIA</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PROVEEDOR</th>
                            <th scope="col">BORRAR</th>
                            <th scope="col">MODIFICAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filas de la tabla se insertarán dinámicamente con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
