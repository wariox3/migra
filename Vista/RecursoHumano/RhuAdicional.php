<?php
include('../../Controlador/RecursoHumano/RhuAdicional.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarAdicional=new RhuAdicional();
$migrarAdicional->migrarAdicional();



