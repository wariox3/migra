<?php
include('../Controlador/MigrarEmpleados.php');

$migrarEmpleado=new MigrarEmpleados();
$migrarEmpleado->migrarEmpledos();
echo '<a href="../index.php">Volver</a>';



