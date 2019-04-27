<?php
include('../../Controlador/RecursoHumano/RhuVacacion.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuVacacion();
$migrar->migrar();



