<?php
include('../../Controlador/RecursoHumano/RhuGrupo.php');

echo '<a href="index.php">Volver</a> <br>';

$migrarGrupo=new RhuGrupo();
$migrarGrupo->migrarGrupo();



