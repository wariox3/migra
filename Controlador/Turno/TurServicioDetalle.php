<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21/11/18
 * Time: 13:20 PM
 */

class TurServicioDetalle{


    /**
     * RhuConcepto constructor.
     */
    public function __construct()
    {
    }

    public function migrar(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_servicio_detalle_pk',
                'codigo_servicio_fk',
                'codigo_puesto_fk',
                'codigo_concepto_servicio_fk',
                'codigo_modalidad_servicio_externo',
                'fecha_desde',
                'fecha_hasta',
                'liquidar_dias_reales',
                'dias',
                'horas',
                'horas_diurnas',
                'horas_nocturnas',
                'cantidad',
                'vr_precio_minimo',
                'vr_precio',
                'vr_subtotal',
                'vr_iva',
                'vr_base_aiu',
                'vr_total_detalle',
                'lunes',
                'martes',
                'miercoles',
                'jueves',
                'viernes',
                'sabado',
                'domingo',
                'festivo',
                'estado_cerrado',
                'vr_salario_base',
                'porcentaje_iva',
                'porcentaje_base_iva'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM tur_servicio_detalle");
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
                    codigo_servicio_detalle_pk,
                    codigo_servicio_fk,
                    codigo_puesto_fk,
                    codigo_concepto_servicio_fk,
                    tur_modalidad_servicio.codigo_externo as codigo_modalidad_servicio_externo,
                    fecha_desde,
                    fecha_hasta,
                    liquidar_dias_reales,
                    dias,
                    horas,
                    horas_diurnas,
                    horas_nocturnas,
                    cantidad,
                    vr_precio_minimo,
                    vr_precio,
                    vr_subtotal,
                    vr_iva,
                    vr_base_aiu,
                    vr_total_detalle,
                    lunes,
                    martes,
                    miercoles,
                    jueves,
                    viernes,
                    sabado,
                    domingo,
                    festivo,
                    estado_cerrado,
                    vr_salario_base,
                    porcentaje_iva,
                    porcentaje_base_iva
                 FROM tur_servicio_detalle 
                 left join tur_modalidad_servicio on tur_servicio_detalle.codigo_modalidad_servicio_fk = tur_modalidad_servicio.codigo_modalidad_servicio_pk                  
                 limit {$aux},{$limite}");
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
                    $cromo->query("insert into tur_contrato_detalle(
                    codigo_contrato_detalle_pk,
                    codigo_contrato_fk,
                    codigo_puesto_fk,
                    codigo_concepto_fk,
                    codigo_modalidad_fk,
                    fecha_desde,
                    fecha_hasta,
                    liquidar_dias_reales,
                    dias,
                    horas,
                    horas_diurnas,
                    horas_nocturnas,
                    cantidad,
                    vr_precio_minimo,
                    vr_precio,
                    vr_subtotal,
                    vr_iva,
                    vr_base_aiu,
                    vr_total_detalle,
                    lunes,
                    martes,
                    miercoles,
                    jueves,
                    viernes,
                    sabado,
                    domingo,
                    festivo,
                    estado_terminado,
                    vr_salario_base,
                    porcentaje_iva,
                    porcentaje_base_iva              
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

