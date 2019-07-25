<?php
include('../../Controlador/Turno/TurPuesto.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurPuesto();
$migrarConcepto->migrar();



