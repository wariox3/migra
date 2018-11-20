<?php
include('../../Controlador/RecursoHumano/RhuEmpleados.php');

echo '<a href="index.php">Volver</a> <br>';
$migrarEmpleado=new RhuEmpleados();
$migrarEmpleado->migrarEmpledos();



