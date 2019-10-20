<?php
include('../../Controlador/RecursoHumano/RhuCreditoPago.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuCreditoPago();
$migrar->migrar();



