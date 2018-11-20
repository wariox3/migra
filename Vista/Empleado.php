<?php
include('../Controlador/MigrarEmpleados.php');

echo '<a href="../index.php">Volver</a> <br>';
$migrarEmpleado=new MigrarEmpleados();
$migrarEmpleado->migrarEmpledos();



