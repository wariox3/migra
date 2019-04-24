<?php
include('../../Controlador/RecursoHumano/RhuCredito.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuCredito();
$migrar->migrar();



