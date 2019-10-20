<?php
include('../../Controlador/RecursoHumano/RhuIncapacidadDiagnostico.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuIncapacidadDiagnostico();
$migrar->migrar();



