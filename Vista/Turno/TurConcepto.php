<?php
include('../../Controlador/Turno/TurConcepto.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurConcepto();
$migrarConcepto->migrar();



