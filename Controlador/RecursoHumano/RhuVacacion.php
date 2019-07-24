<?php


class RhuVacacion{
    public function __construct()
    {
    }

    public function migrar(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_vacacion_pk',
                'codigo_empleado_fk',
                'codigo_contrato_fk',
                'fecha',
                'fecha_desde_periodo',
                'fecha_hasta_perioro',
                'fecha_desde_disfrute',
                'fecha_hasta_disfrute',
                'dias_disfrutados',
                'dias_disfrutados_reales',
                'vr_ibc_promedio',
                'vr_salud',
                'vr_pension',
                'vr_fondo_solidaridad',
                'vr_ibc',
                'vr_deduccion',
                'vr_bonificacion',
                'vr_vacacion_disfrute',
                'vr_vacacion_dinero',
                'vr_vacacion_total'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_vacacion");
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
                        codigo_vacacion_pk,
                        codigo_empleado_fk,                        
                        codigo_contrato_fk,
                        fecha,
                        fecha_desde_periodo,
                        fecha_hasta_periodo,
                        fecha_desde_disfrute,
                        fecha_hasta_disfrute,
                        dias_disfrutados,
                        dias_disfrutados_reales,
                        vr_ibc_promedio,
                        vr_salud,
                        vr_pension,
                        vr_fondo_solidaridad,
                        vr_ibc,
                        vr_deduccion,
                        vr_bonificacion,
                        vr_vacacion_disfrute,
                        vr_vacacion_dinero,
                        vr_vacacion_total

                 FROM rhu_vacacion limit {$aux},{$limite}");
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
                    $cromo->query("insert into rhu_vacacion(
                        codigo_vacacion_pk,
                        codigo_empleado_fk,
                        codigo_contrato_fk,
                        fecha,
                        fecha_desde_periodo,
                        fecha_hasta_periodo,
                        fecha_desde_disfrute,
                        fecha_hasta_disfrute,
                        dias_disfrutados,
                        dias_disfrutados_reales,
                        vr_ibc_promedio,
                        vr_salud,
                        vr_pension,
                        vr_fondo_solidaridad,
                        vr_ibc,
                        vr_deduccion,
                        vr_bonificacion,                        
                        vr_disfrute,
                        vr_dinero,
                        vr_total
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

