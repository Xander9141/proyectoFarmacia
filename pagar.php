<?php
session_start();
include('header.php');

// Verificar si se recibió una solicitud de pago
if (isset($_POST['pagar'])) {
    // Obtener los detalles de la venta
    $cliente = $_POST['cliente'];
    $dni = $_POST['dni'];
    $total = $_SESSION['total'];
    $vendedor = 1; // Aquí deberías obtener el ID del vendedor de alguna manera
    $id_sucursal = 1; // Aquí deberías obtener el ID de la sucursal de alguna manera
    $tipo_despacho = 1; // Aquí deberías obtener el ID del tipo de despacho de alguna manera
    $confirmacion = 0;

    // Insertar los datos de la venta en la base de datos
    include('configuracion.php');
    $conexion = new mysqli($host, $user, $password, $dbname);

    $query = "INSERT INTO venta (fecha, cliente, dni, total, estado_activo, vendedor, id_sucursal, tipo_despacho, confirmacion) VALUES (NOW(), '$cliente', $dni, $total, 1, $vendedor, $id_sucursal, $tipo_despacho, $confirmacion)";
    $resultado = $conexion->query($query);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        // Borrar los datos de la sesión y mostrar un mensaje de éxito
        unset($_SESSION['carro']);
        unset($_SESSION['total']);
        $_SESSION['mensaje'] = "La compra se ha realizado correctamente.";
        header("Location: index.php");
        exit;
    } else {
        // Mostrar un mensaje de error si la consulta no se ejecutó correctamente
        $_SESSION['mensaje'] = "Ha ocurrido un error al realizar la compra. Por favor, inténtelo de nuevo más tarde.";
        header("Location: carro.php");
        exit;
    }
}
?>

<!-- Aquí va el código HTML para mostrar el formulario de pago -->
<div class="row">
    <div class="col-md-12">
        <h1>Pagar</h1>
        <hr>
        <form method="post" action="">
            <div class="form-group">
                <label for="cliente">Nombre completo:</label>
                <input type="text" class="form-control" id="cliente" name="cliente" required>
            </div>
            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <button type="submit" class="btn btn-primary" name="pagar">Pagar</button>
        </form>
    </div>
</div>
