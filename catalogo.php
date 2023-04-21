<?php
include('header.php');
include('configuracion.php');

if ($con->connect_error) {
    die("La conexión ha fallado: " . $con->connect_error);
}

// Consultar todos los productos
$sql = mysqli_query($con, "SELECT * FROM producto");

?>
<br><br>
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <?php while ($rowSql = mysqli_fetch_array($sql)) { ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top" src=https://acortar.link/oxeG5F alt="<?php echo $rowSql["nombre"]; ?>" height="150px">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $rowSql["nombre"]; ?></h5>
                            <p class="card-text"><?php echo $rowSql["concentracion"]; ?></p>
                            <p class="card-text"><?php echo $rowSql["precio"]; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="detalle.php?id=<?php echo $rowSql['id_producto']; ?>">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Comprar</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
