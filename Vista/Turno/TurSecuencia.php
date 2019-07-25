<?php
include('../../Controlador/Turno/TurSecuencia.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurSecuencia();
$migrarConcepto->migrar();



