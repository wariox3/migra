<?php
include('../../Controlador/RecursoHumano/RhuIncapacidad.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuIncapacidad();
$migrar->migrar();



