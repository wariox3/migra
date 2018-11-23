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
$cromo=$conexion->conexion2();
$contratoTipoUsado=$vanadio->query("SELECT codigo_contrato_tipo_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_contrato_tipo on rhu_contrato.codigo_contrato_tipo_fk=rhu_contrato_tipo.codigo_contrato_tipo_pk 
group by codigo_contrato_tipo_fk");

//Validar contrato tipo
$contratoTipoUsado->execute();
$contratoTipoUsado=$contratoTipoUsado->fetchAll();
foreach ($contratoTipoUsado as $sinCodigoExterno){
    if($sinCodigoExterno['codigo_externo']===null){
        echo "- Contrato tipo {$sinCodigoExterno['codigo_contrato_tipo_fk']} no tiene codigo externo y es usado <br/>";
    } else {
        $contratoTipoDestino=$cromo->query("SELECT codigo_contrato_tipo_pk  
              FROM rhu_contrato_tipo  
              WHERE codigo_contrato_tipo_pk = '" . $sinCodigoExterno['codigo_externo'] . "'");
        $contratoTipoDestino->execute();
        $contratoTipoDestino=$contratoTipoDestino->fetchAll();
        if(!$contratoTipoDestino) {
            echo "- Contrato tipo {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
        }
    }
}

//Validar contrato clase
$contratoClaseUsado=$vanadio->query("SELECT codigo_contrato_clase_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_contrato_clase on rhu_contrato.codigo_contrato_clase_fk=rhu_contrato_clase.codigo_contrato_clase_pk 
group by codigo_contrato_clase_fk");

$contratoClaseUsado->execute();
$contratoClaseUsado=$contratoClaseUsado->fetchAll();
foreach ($contratoClaseUsado as $sinCodigoExterno){
    if($sinCodigoExterno['codigo_externo']===null){
        echo "- Contrato clase {$sinCodigoExterno['codigo_contrato_clase_fk']} no tiene codigo externo y es usado <br/>";
    } else {
        $contratoClaseDestino=$cromo->query("SELECT codigo_contrato_clase_pk
              FROM rhu_contrato_clase
              WHERE codigo_contrato_clase_pk = '" . $sinCodigoExterno['codigo_externo'] . "'");
        $contratoClaseDestino->execute();
        $contratoClaseDestino=$contratoClaseDestino->fetchAll();
        if(!$contratoClaseDestino) {
            echo "- Contrato clase {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
        }
    }
}

?>