<?php
include('../../Controlador/RecursoHumano/RhuContrato.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarContrato=new RhuContrato();
$migrarContrato->migrarContratos();



