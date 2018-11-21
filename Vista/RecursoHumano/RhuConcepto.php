<?php
include('../../Controlador/RecursoHumano/RhuConcepto.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarConcepto=new RhuConcepto();
$migrarConcepto->migrarConcepto();



