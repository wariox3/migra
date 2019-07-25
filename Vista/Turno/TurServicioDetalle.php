<?php
include('../../Controlador/Turno/TurServicioDetalle.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurServicioDetalle();
$migrarConcepto->migrar();



