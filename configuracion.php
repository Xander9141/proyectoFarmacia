<?php
// Datos de conexión a la base de datos
$host = "clubnerudavoley.cl";
$user = "develop";
$password = "dev753?!22";
$dbname = "farmacia";

// Conexión a la base de datos
$con = new mysqli($host, $user, $password, $dbname);

// Verificación de errores en la conexión
if ($con->connect_errno) {
    die("Error en la conexión a la base de datos: " . $con->connect_error);
}

// Configuración de codificación de caracteres
$con->set_charset("utf8");


?>
