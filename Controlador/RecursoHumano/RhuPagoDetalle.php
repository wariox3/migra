<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 20/11/18
 * Time: 12:41 PM
 */

class RhuPagoDetalle{


    /**
     * RhuPago constructor.
     */
    public function __construct()
    {
    }

    public function migrarPagoDetalle(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_pago_detalle_pk',
                'codigo_pago_fk',
                'codigo_pago_concepto_fk',
//                'codigo_credito_fk', //referencia
                'vr_pago',
                'operacion',
                'vr_pago_operado',
                'numero_horas',
                'vr_hora',
                'porcentaje_aplicado',
                'numero_dias',
                'detalle',
///                'vr_deduccion', //no existe o se desconoce el nombre en vanadio
//                'vr_devengado', //no existe o se desconoce el nombre en vanadio
                'vr_ingreso_base_cotizacion',
                'vr_ingreso_base_prestacion'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_pago_detalle");
            $totalDatos->execute();
            $count=$totalDatos->fetchAll();
            $aux=0;
            if(!isset($count[0]['numeroRegistro'])){
                $count=0;
            }else{

            $count=$count[0]['numeroRegistro'];
            }

            while ($aux!==(int)$count) {
                $limite=$aux+1000;
                $datos = $vanadio->query("SELECT
                codigo_pago_detalle_pk,
                codigo_pago_fk,
                codigo_pago_concepto_fk,
                /*codigo_credito_fk,*/
                vr_pago,
                operacion,
                vr_pago_operado,
                numero_horas,
                vr_hora,
                porcentaje_aplicado,
                numero_dias,
                detalle,
                /*vr_deduccion, 
                vr_devengado,*/ 
                vr_ingreso_base_cotizacion,
                vr_ingreso_base_prestacion
                 FROM rhu_pago_detalle limit {$aux},{$limite}");
                $value="";
                foreach($datos as $row) {
                    $aux++;
                    $value="{$value}(";
                    for ($i = 0; $i < count($columnas); $i++) {
                        if (isset($row[$columnas[$i]])) {
                            $value="{$value}'{$row[$columnas[$i]]}',";
                        } else{
                            $value="{$value}null,";
                        }
                    }
                    $value=substr($value,0,-1);
                    $value="{$value}),";

                }

                $value=substr($value,0,-1);
                $cromo = $conexion->conexion2();
                if($value!="") {
                    $cromo->query("insert into rhu_pago_detalle(
                codigo_pago_detalle_pk,
                codigo_pago_fk,
                codigo_concepto_fk,
                /*codigo_credito_fk,*/
                vr_pago,
                operacion,
                vr_pago_operado,
                horas,
                vr_hora,
                porcentaje,
                dias,
                detalle,
                /*vr_deduccion,
                vr_devengado,*/
                vr_ingreso_base_cotizacion,
                vr_ingreso_base_prestacion
                )
                values {$value}");
                }

            }
            $vanadio = $conexion->cerrarConexion();
            $cromo = $conexion->cerrarConexion();
            echo "ok";
            die();
        }
        catch (Exception $exception){
            echo "Error:{$exception->getMessage()}<br/>";
            die();
        }
    }
}

