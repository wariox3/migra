<?php
include('../../Controlador/General/GenCiudad.php');

echo '<a href="index.php">Volver</a> <br>';
$migrarCiudad=new GenCiudad();
$migrarCiudad->migrarCiudades();