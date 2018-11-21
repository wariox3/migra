<?php
include('../../Controlador/RecursoHumano/RhuPagoDetalle.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarPagoDetalle=new RhuPagoDetalle();
$migrarPagoDetalle->migrarPagoDetalle();



