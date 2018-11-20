<?php
include('../../Controlador/General/GenDepartamento.php');

echo '<a href="index.php">Volver</a> <br>';
$migrarDepartamento=new GenDepartamento();
$migrarDepartamento->migrarDepartamentos();