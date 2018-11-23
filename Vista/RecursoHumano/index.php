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
        <a href="RhuContratoTipo.php" >Contrato tipo</a>
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
            Contratos tipos
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
    <td>
        Dependencia
    </td>
    <td>
        Ninguna
    </td>
    <td>
        Ciudad
    </td>
    <th>
        Contratos clase
    </th>
    <td>
        Grupo, Contrato tipo Empleados
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
require_once('../../Conexion.php');
$conexion = new Conexion();
$vanadio=$conexion->conexion1();
$contratoTipoUsado=$vanadio->query("SELECT codigo_contrato_tipo_fk, codigo_externo  FROM rhu_contrato inner join rhu_contrato_tipo on rhu_contrato.codigo_contrato_tipo_fk=rhu_contrato_tipo.codigo_contrato_tipo_pk group by codigo_contrato_tipo_fk");
$contratoTipoUsado->execute();
$contratoTipoUsado=$contratoTipoUsado->fetchAll();
$error=0;
foreach ($contratoTipoUsado as $sinCodigoExterno){
    if($sinCodigoExterno['codigo_externo']===null){
        if($error===0){
         echo "<h1 style='color: red;font-size: 20px'>Error: el tipo de contrato";
        }
        $error++;
        echo " {$sinCodigoExterno['codigo_contrato_tipo_fk']}, ";
    }
}
if($error!=0){
    echo "usados no tiene el codigo externo de migracion. Pueden haber error al intentar migrar Contratos, o causar error mas adelante.</h1><br>";
}
?>