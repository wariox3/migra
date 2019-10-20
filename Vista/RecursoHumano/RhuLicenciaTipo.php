<?php
include('../../Controlador/RecursoHumano/RhuLicenciaTipo.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuLicenciaTipo();
$migrar->migrar();



