<?php
session_start();

// Verificar si se recibió una solicitud de vaciar el carro
if (isset($_GET['accion']) && $_GET['accion'] == 'vaciar') {
    // Borrar todos los productos del carro
    unset($_SESSION['carro']);
    $_SESSION['mensaje'] = "El carro se ha vaciado correctamente.";
    header("Location: carro.php");
    exit;
}

// Verificar si se recibió una solicitud de agregar un producto al carro
if (isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    // Obtener los datos del producto y la cantidad
    $id_producto = $_POST['id_producto'];
    $cantidad = (int)$_POST['cantidad'];

    // Verificar si ya existe el producto en el carro
    if (isset($_SESSION['carro'][$id_producto])) {
        // Si ya existe, sumar la cantidad
        $_SESSION['carro'][$id_producto]['cantidad'] += $cantidad;
    } else {
        // Si no existe, agregar el producto al carro
        $_SESSION['carro'][$id_producto] = [
            'cantidad' => $cantidad,
        ];
    }

    $_SESSION['mensaje'] = "El producto ha sido agregado al carro.";
    header("Location: carro.php");
    exit;
}

// Verificar si se recibió una solicitud de continuar comprando
if (isset($_POST['continuar'])) {
    header("Location: index.php");
    exit;
}

// Verificar si se recibió una solicitud de ir a pagar
if (isset($_POST['pagar'])) {
    header("Location: pagar.php");
    exit;
}

// Verificar si se recibió una solicitud de cambiar el tipo de envío
if (isset($_POST['envio'])) {
    $_SESSION['tipo_envio'] = $_POST['envio'];
}

include('configuracion.php');
include('header.php');
?>
<form id="envio-form" method="POST">
    <label for="envio">Seleccione el tipo de envío:</label><br>
    <input type="radio" id="delivery" name="envio" value="1" onchange="document.getElementById('envio-form').submit()">
    <label for="delivery">Delivery</label><br>
    <input type="radio" id="tienda" name="envio" value="2" onchange="document.getElementById('envio-form').submit()">
    <label for="tienda">Retiro en tienda</label><br><br>
</form>

<?php
// Verificar si se recibió una solicitud de cambiar el tipo de envío
if (isset($_POST['envio'])) {
    $_SESSION['tipo_envio'] = $_POST['envio'];
}


// Verificar si hay productos en el carro
if (isset($_SESSION['carro']) && count($_SESSION['carro']) > 0) {
    // Obtener los IDs de los productos del carro
    $ids_productos = array_keys($_SESSION['carro']);

    // Obtener los detalles de los productos del carro
    $sql = "SELECT * FROM producto WHERE id_producto IN (" . implode(",", array_map('intval', $ids_productos)) . ")";
    $result = mysqli_query($con, $sql);
// Inicializar el total del carro
$total = 0;

// Imprimir la tabla de productos del carro
echo "<table class='table'><thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead><tbody>";
while ($row = mysqli_fetch_assoc($result)) {
    $id_producto = $row['id_producto'];
    $nombre = $row['nombre'];
    $precio = $row['precio'];
    $cantidad = $_SESSION['carro'][$id_producto]['cantidad'];
    $subtotal = $precio * $cantidad;
    $total += $subtotal;

    echo "<tr><td>$nombre</td><td>$precio</td><td>$cantidad</td><td>$subtotal</td></tr>";
}
echo "</tbody><tfoot><tr><td colspan='3'><strong>Total:</strong></td><td><strong>$total</strong></td></tr></tfoot></table>";

// Imprimir el botón de vaciar carro y los botones de continuar comprando y pagar
echo "<a href='carro.php?accion=vaciar' class='btn btn-danger'>Vaciar carro</a>";
echo "<form action='carro.php' method='POST'><input type='submit' class='btn btn-primary' name='continuar' value='Continuar comprando'>";
echo "<input type='submit' class='btn btn-success' name='pagar' value='Ir a pagar'></form>";
} else {
    echo "<p>No hay productos en el carro.</p>";
    }
    

    ?>