<?php
include('../../Controlador/RecursoHumano/RhuEmbargo.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuEmbargo();
$migrar->migrar();



