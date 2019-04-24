<?php
include('../../Controlador/RecursoHumano/RhuCreditoTipo.php');

echo '<a href="index.php">Volver</a> <br>';

$migrar=new RhuCreditoTipo();
$migrar->migrar();



