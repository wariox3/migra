<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21/11/18
 * Time: 13:20 PM
 */

class RhuAdicional{


    /**
     * RhuConcepto constructor.
     */
    public function __construct()
    {
    }

    public function migrarAdicional(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_adicional_pk',
                'codigo_pago_concepto_fk',
                'codigo_empleado_fk',
                'codigo_contrato_fk',
                'fecha',
                'valor',
                'permanente',
                'aplica_dia_laborado',
//                'aplica_nomina', //no exite o no se conoce el nombre de referencia
                'aplica_prima',
                'aplica_cesantia',
                'detalle',
                'estado_inactivo',
                'estado_inactivo_periodo'
//                'estado_autorizado',
//                'estado_aprobado',
//                'estado_anulado'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_pago_adicional");
            $totalDatos->execute();
            $count=$totalDatos->fetchAll();
            $aux=0;
            if(!isset($count[0]['numeroRegistro'])){
                $count=0;
            }else{

                $count=$count[0]['numeroRegistro'];
            }

            while ($aux!==(int)$count) {
                $limite = $aux + 1000;
                $datos = $vanadio->query("SELECT
                        codigo_pago_adicional_pk,
                        codigo_pago_concepto_fk,
                        codigo_empleado_fk,
                        codigo_contrato_fk,
                        fecha,
                        valor,
                        permanente,
                        aplica_dia_laborado,
                        /*aplica_nomina,*/
                        aplica_prima,
                        aplica_cesantia,
                        detalle,
                        estado_inactivo,
                        estado_inactivo_periodo
                        /*estado_autorizado,
                        estado_aprobado,
                        estado_anulado*/
                 FROM rhu_pago_adicional limit {$aux},{$limite}");
                $value="";
                foreach($datos as $row) {
                    $aux++;
                    $value="{$value}(";
                    for ($i = 0; $i < count($columnas); $i++) {
                        if (isset($row[$columnas[$i]])) {
                            if(is_numeric($row[$columnas[$i]])){
                                $value="{$value}{$row[$columnas[$i]]},";
                            }
                            else if(is_string($row[$columnas[$i]])){
                                $value="{$value}'{$row[$columnas[$i]]}',";

                            }
                        } else{
                            $value="{$value}null,";
                        }
                    }
                    $value=substr($value,0,-1);
                    $value="{$value}),";

                }
                $value=substr($value,0,-1);


                $cromo = $conexion->conexion2();
                if($value!=""){
                    $cromo->query("insert into rhu_adicional(
                        codigo_adicional_pk,
                        codigo_concepto_fk,
                        codigo_empleado_fk,
                        codigo_contrato_fk,
                        fecha,
                        vr_valor,
                        permanente,
                        aplica_dia_laborado,
                        /*aplica_nomina,*/
                        aplica_prima,
                        aplica_cesantia,
                        detalle,
                        estado_inactivo,
                        estado_inactivo_periodo
                        /*estado_autorizado,
                        estado_aprobado,
                        estado_anulado*/
                )
                values {$value}");
                }
            }
            $vanadio = $conexion->cerrarConexion();
            $cromo = $conexion->cerrarConexion();

            $cromo = $conexion->conexion2();
            $cromo->query("update rhu_adicional set aplica_nomina=1 where aplica_cesantia=0 and aplica_prima=0");

            echo "ok";
            die();
        }
        catch (Exception $exception){
            echo "Error:{$exception->getMessage()}<br/>";
            die();
        }
    }
}

