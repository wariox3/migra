<?php
include('../../Controlador/Turno/TurCliente.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new TurCliente();
$migrarConcepto->migrar();



