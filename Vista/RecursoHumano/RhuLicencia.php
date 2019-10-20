<?php
include('../../Controlador/RecursoHumano/RhuLicencia.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuLicencia();
$migrar->migrar();



