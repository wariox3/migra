<?php
include('../../Controlador/RecursoHumano/RhuPago.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarPago=new RhuPago();
$migrarPago->migrarPago();



