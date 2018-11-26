
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
<table>
    <tr>
        <th>
            Modelo
        </th>
        <th>
            Dependencias
        </th>
    </tr>
    <tr>
        <td>
            Grupo
        </td>
        <td>
            Ninguna
        </td>
    </tr>
    <tr>
        <td>
            Empleados
        </td>
        <td>
            Ciudad
        </td>
    </tr>
    <tr>
        <td>
            Contratos
        </td>
        <td>
            Grupo,Contrato Tipo, Contrato Clase,Clasificacion Riesgo, Pension, Salud ,Empleados
        </td>
    </tr>
    <tr>
        <td>
            Concepto
        </td>
        <td>
            Ninguna
        </td>
    </tr>
    <tr>
        <td>
            Pago
        </td>
        <td>
            Empleados, Contrato
        </td>
    </tr>
    <tr>
        <td>
            Pago Detalle
        </td>
        <td>
            Pago
        </td>
    </tr>
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
$validacion->validarEntidadCesantia();
$validacion->validarEntidadSalud();
$validacion->validarEntidadPension();
$validacion->validarEntidadCaja();

?>