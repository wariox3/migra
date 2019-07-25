<?php
include('../../Controlador/Turno/TurProgramacion.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurProgramacion();
$migrarConcepto->migrar();



