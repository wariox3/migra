
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;

    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<ul >
    <li >
        <a href="../../index.php" >Volver</a>
    </li>
    <li >
        <a href="RhuGrupo.php" >Grupo</a>
    </li>
    <li >
        <a href="RhuEmpleado.php" >Empleados</a>
    </li>
    <li >
        <a href="RhuContrato.php">Contratos</a>
    </li>
    <li >
        <a href="RhuConcepto.php">Concepto</a>
    </li>
    <li >
        <a href="RhuPago.php">Pago</a>
    </li>
    <li >
        <a href="RhuPagoDetalle.php">Pago detalle</a>
    </li>
</ul>
<table >
    <tr>
        <th>

        </th>
        <th>
            Grupo
        </th>
        <th>
            Empleados
        </th>
        <th>
            Contratos
        </th>
        <th>
            Concepto
        </th>
        <th>
            Pago
        </th>
        <th>
            Pago Detalle
        </th>
    </tr>
    <tbody>
    <th>
        Dependencia
    </th>
    <td>
        Ninguna
    </td>
    <td>
        Ciudad
    </td>
    <td>
        Grupo, Empleados
    </td>
    <td>
        Ninguna
    </td>
    <td>
        Empleados, Contrato
    </td>
    <td>
        Pago
    </td>
    </tbody>
</table>
<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
include("Validacion/ValidarRhuContrato.php");
$validacion=new ValidarRhuContrato();
$validacion->validarContratoTipo();
$validacion->validarContratoClase();
$validacion->validarClasificacionRiesgo();
$validacion->validarPension();
$validacion->validarSalud();

?>