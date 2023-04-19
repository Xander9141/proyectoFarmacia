<?php
$Chost = "clubnerudavoley.cl";
$Cuser = "develop";
$Cpass= "dev753?!22";
$Cdb = "farmacia";

$con = new mysqli($Chost, $Cuser, $Cpass, $Cdb);

if ($con->connect_errno) {
    die("Ha ocurrido un error");
}
?>