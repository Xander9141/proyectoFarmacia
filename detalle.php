<?php
session_start();
include('configuracion.php');
include('header.php');

// Verificar si se recibió un ID de producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta para obtener los detalles del producto con el ID especificado
    $sql = "SELECT * FROM producto WHERE id_producto = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró un producto con ese ID
    if (mysqli_num_rows($resultado) > 0) {
        $producto = mysqli_fetch_assoc($resultado);
    } else {
        echo "Producto no encontrado";
        exit;
    }

    // Liberar los recursos de la consulta preparada
    mysqli_stmt_close($stmt);
} else {
    echo "No se especificó un producto";
    exit;
}
?>
<h2 class="detalle"> DETALLE </h2>
<div class="container">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Concentración</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $producto['nombre']; ?></td>
        <td><?php echo $producto['concentracion']; ?></td>
        <td>$<?php echo $producto['precio']; ?></td>
      </tr>
      <tr>
        <td>Cantidad:</td>
        <td>
          <form action="carro.php" method="POST">
            <div class="input-group">
              <input type="number" class="form-control" name="cantidad" id="cantidad" value="1">
              <div class="input-group-append">
                <span class="input-group-text">Unidades</span>
              </div>
            </div>
            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Comprar</button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<?php
mysqli_free_result($resultado);
mysqli_close($con);
?>
