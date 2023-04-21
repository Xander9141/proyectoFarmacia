<?php
session_start();
include('configuracion.php');
include('header.php');
?>

<div class="container_resultados">
    <h1>Resultados de búsqueda</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Concentración</th>
                <th>Precio</th>
                <th>Bioequivalente</th>
                <th>Comprar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si se envió una búsqueda
            if (isset($_POST['busqueda'])) {
                // Obtener el término de búsqueda
                $termino = $_POST['busqueda'];

                // Preparar la consulta para buscar el término en la tabla 'producto'
                $sql = "SELECT * FROM producto WHERE nombre LIKE ? OR concentracion LIKE ?";

                // Preparar la declaración
                $stmt = mysqli_prepare($con, $sql);

                // Vincular los parámetros
                mysqli_stmt_bind_param($stmt, "ss", $termino, $termino);

                // Ejecutar la consulta preparada
                mysqli_stmt_execute($stmt);

                // Obtener los resultados de la consulta
                $resultado = mysqli_stmt_get_result($stmt);

                // Mostrar los resultados de la búsqueda
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["concentracion"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    echo "<td>" . $row["bioequivalente"] . "</td>";
                    echo '<td><img src="https://acortar.link/oxeG5F" width="100"/></td>';
            echo '<td style="text-align: center;">
                <a href="detalle.php?id=' . $row["id_producto"] . '">
                    <button type="button" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Comprar</button>
                </a>
            </td>';
            echo "</tr>";
                }

                // Cerrar la consulta preparada y liberar los recursos
                mysqli_stmt_close($stmt);
            } else {
                // Si no se envió una búsqueda, redireccionar a index.php
                header("Location: index.php");
                exit();
            }

            // Cerrar la conexión y liberar los recursos
            mysqli_free_result($resultado);
            mysqli_close($con);
            ?>
        </tbody>
    </table>
</div>


