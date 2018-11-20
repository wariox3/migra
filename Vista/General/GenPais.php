<?php
include('../../Controlador/General/GenPais.php');

echo '<a href="index.php">Volver</a> <br>';
$migrarPais=new GenPais();
$migrarPais->migrarPais();