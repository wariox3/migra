<?php
include('../../Controlador/Turno/TurServicio.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurServicio();
$migrarConcepto->migrar();



