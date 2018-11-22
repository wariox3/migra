<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 20/11/18
 * Time: 13:30 PM
 */

class RhuPago{


    /**
     * RhuPago constructor.
     */
    public function __construct()
    {
    }

    public function migrarPago(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_pago_pk',
//                'codigo_pago_tipo_fk', //tiene referencias (relacion)
//                'codigo_entidad_salud_fk', //tiene referencias (relacion)
//                'codigo_entidad_pension_fk', //tiene referencias (relacion)
                'codigo_periodo_pago_fk',
                'numero',
                'codigo_empleado_fk',
                'codigo_contrato_fk',
//                'codigo_programacion_pago_detalle_fk', //tiene referencia (relacion)
//                'codigo_programacion_pago_fk', //tiene referencias (relacion)
                'fecha_desde',
                'fecha_hasta',
                'fecha_desde_pago',
                'fecha_hasta_pago',
                'vr_salario_empleado',
                'vr_devengado',
                'vr_deducciones',
                'vr_neto',
                'estado_anulado',
                'comentarios',
                'codigo_usuario'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_pago");
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
                codigo_pago_pk,
                /*codigo_pago_tipo_fk,*/
                /*codigo_entidad_salud_fk,
                codigo_entidad_pension_fk,*/
                codigo_periodo_pago_fk,
                numero,
                codigo_empleado_fk,
                codigo_contrato_fk,
                /*codigo_programacion_pago_detalle_fk,
                codigo_programacion_pago_fk,*/
                fecha_desde,
                fecha_hasta,
                fecha_desde_pago,
                fecha_hasta_pago,
                vr_salario_empleado,
                vr_devengado,
                vr_deducciones,
                vr_neto,
                estado_anulado,
                comentarios,
                codigo_usuario
                 FROM rhu_pago limit {$aux},{$limite}");
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
                $migrarRegistros = $cromo->query("insert into rhu_pago(
                codigo_pago_pk,
                /*codigo_pago_tipo_fk,*/
                /*codigo_entidad_salud_fk,
                codigo_entidad_pension_fk,*/
                codigo_periodo_fk,
                numero,
                codigo_empleado_fk,
                codigo_contrato_fk,
                /*codigo_programacion_detalle_fk,
                codigo_programacion_fk,*/
                fecha_desde,
                fecha_hasta,
                fecha_desde_contrato,
                fecha_hasta_contrato,
                vr_salario_contrato,
                vr_devengado,
                vr_deduccion,
                vr_neto,
                estado_anulado,
                comentario,
                usuario
                )
                values {$value}");
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

