<?php
session_start();
include('header.php');
include('configuracion.php');

// Realiza la consulta
$sql = "SELECT * FROM producto";
$resultado = mysqli_query($con, $sql);
?>

<div class="contenedor-padre">
   <div class="contenedor-izquierdo">
    <h2>Filtros</h2>
  <form action="resultados.php" method="POST">
    <label for="busqueda">Buscar:</label>
    <input type="text" name="busqueda" id="busqueda">
    <br>
    <label for="laboratorio">Laboratorio:</label>
<select name="laboratorio" id="laboratorio">
  <option value="todos">Todos</option>
  <?php
    $query = "SELECT nombre FROM laboratorio";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
    }
  ?>
</select>

<label for="farmacia">Nombre de farmacia:</label>
<select name="farmacia" id="farmacia">
  <option value="todas">Todas</option>
  <?php
    $query = "SELECT nombre_farmacia FROM farmacia";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)) {
      echo "<option value='". $row['nombre_farmacia'] ."'>". $row['nombre_farmacia'] ."</option>";
    }
  ?>
</select>

      <button type="submit" id="buscar-btn" disabled>Buscar</button>
      </form>
    </div>





    <div class="container">
  <h2>Productos</h2></h2>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Concentración</th>
          <th>Precio</th>
          <th>Bioequivalente</th>
          <th>Imagen</th>
          <th>Comprar</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
        // Muestra los datos de cada producto encontrado
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
        
        
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  const inputBusqueda = document.getElementById('busqueda');
  const botonBuscar = document.getElementById('buscar-btn');

  inputBusqueda.addEventListener('input', () => {
    if (inputBusqueda.value.length > 0) {
      botonBuscar.removeAttribute('disabled');
    } else {
      botonBuscar.setAttribute('disabled', true);
    }
  });
</script>