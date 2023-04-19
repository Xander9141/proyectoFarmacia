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

include('configuracion.php');
include('header.php');

// Verificar si hay productos en el carro
if (isset($_SESSION['carro']) && count($_SESSION['carro']) > 0) {
    // Obtener los IDs de los productos del carro
    $ids_productos = array_keys($_SESSION['carro']);

    // Obtener los detalles de los productos del carro
    $sql = "SELECT * FROM producto WHERE id_producto IN (" . implode(",", array_map('intval', $ids_productos)) . ")";

    $resultado = mysqli_query($con, $sql);

    // Calcular el total y mostrar los productos del carro
    $total = 0;
?>
    <h2 class="carro"> CARRITO DE COMPRAS </h2>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th><strong>Precio Total</strong></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $id_producto = $fila['id_producto'];
                    $cantidad = $_SESSION['carro'][$id_producto]['cantidad'];
                    $precio_unitario = $fila['precio'];
                    $precio_total = $cantidad * $precio_unitario;
                    $total += $precio_total;
                ?>
                    <tr>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $cantidad; ?></td>
                        <td>$<?php echo $precio_unitario; ?></td>
                        <td>$<?php echo number_format($precio_total, 0, ',', '.'); ?></td>

                        <td>
                            <a href="carro.php?accion=eliminar&id_producto=<?php echo $id_producto; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="3" align="right"><strong>Total:</strong></td>
                    <td>$<?php echo number_format($total, 2, '.', ','); ?></td>

                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
} else {
    // Si no hay productos en el carro, mostrar un mensaje
?>
    <h2 class="carro"> CARRITO DE COMPRAS </h2>
    <div class="container">
        <p>No hay productos en el carro.</p>
    </div>
<?php
}

// Mostrar botones para vaciar el carro, continuar comprando o ir a pagar
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a class="btn btn-danger" href="carro.php?accion=vaciar">Vaciar Carro</a>
        </div>
        <div class="col-md-4">
            <form action="carro.php" method="POST">
                <input type="submit" class="btn btn-primary" name="continuar" value="Continuar Comprando">
            </form>
        </div>
        <div class="col-md-4">
            <form action="carro.php" method="POST">
                <input type="submit" class="btn btn-success" name="pagar" value="Ir a Pagar">
            </form>
        </div>
    </div>
</div>