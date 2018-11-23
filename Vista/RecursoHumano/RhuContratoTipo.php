<?php
include('../../Controlador/RecursoHumano/RhuContratoTipo.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarContratoTipo=new RhuContratoTipo();
$migrarContratoTipo->migrarContratoTipo();



