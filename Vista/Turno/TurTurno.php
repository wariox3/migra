<?php
include('../../Controlador/Turno/TurTurno.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurTurno();
$migrarConcepto->migrar();



