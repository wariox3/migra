<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 20/11/18
 * Time: 15:02 PM
 */

class RhuContrato{


    /**
     * RhuEmpleados constructor.
     */
    public function __construct()
    {
    }

    public function migrarContratos(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_contrato_pk',
//                'codigo_contrato_tipo_fk', //tabla con referencia (relacion)
//                'codigo_contrato_clase_fk',//tabla con referencia (relacion)
//                'codigo_clasificacion_riesgo_fk', //tabla con referencia (relacion)
//                'codigo_contrato_motivo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'fecha',
//                'codigo_tiempo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'factor_horas_dia',
//                'codigo_pension_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'codigo_salud_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'codigo_empleado_fk',
                'fecha_desde',
                'fecha_hasta',
                'numero',
//                'codigo_cargo_fk',//tabla con referencia (relacion)
                'cargo_descripcion',
                'vr_salario',
//                'vr_adicional', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'vr_adicional_prestacional', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'estado_terminado',
                'indefinido',
//                'comentario_terminacion', //no existe el campo, pero si una fk codigo_motivo_terminacion_contrato_fk
//                'codigo_grupo_fk', //no existe el campo, pero si una fk codigo_contrato_grupo_fk
                'fecha_ultimo_pago_cesantias',
                'fecha_ultimo_pago_vacaciones',
                'fecha_ultimo_pago_primas',
                'fecha_ultimo_pago',
                'codigo_tipo_cotizante_fk',
                /*'codigo_subtipo_cotizante_fk',*/ //tabla con referencia (relacion)
                'salario_integral',
//                'costo_tipo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'codigo_entidad_salud_fk', //tabla con referencia (relacion)
//                'codigo_entidad_pension_fk', //tabla con referencia (relacion)
                'codigo_entidad_cesantia_fk',
//                'codigo_entidad_caja_fk', //tabla con referencia (relacion)
                'codigo_ciudad_contrato_fk',
                'codigo_ciudad_labora_fk',
//                'codigo_costo_clase_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'codigo_costo_grupo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'codigo_costo_tipo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'codigo_centro_trabajo_fk',
                'codigo_sucursal_fk',
                'auxilio_transporte'

            );

            $datos=$vanadio->query('SELECT
                    codigo_contrato_pk,
                    /*codigo_contrato_tipo_fk,*/
                    /*codigo_contrato_clase_fk,*/
                    /*codigo_clasificacion_riesgo_fk,*/
                    /*codigo_contrato_motivo_fk,*/
                    fecha,
                    /*codigo_tiempo_fk,*/
                    factor_horas_dia,
                    /*codigo_pension_fk,*/
                    /*codigo_salud_fk,*/
                    codigo_empleado_fk,
                    fecha_desde,
                    fecha_hasta,
                    numero,
                    /*codigo_cargo_fk,*/
                    cargo_descripcion,
                    vr_salario,
                    /*vr_adicional,*/
                    /*vr_adicional_prestacional,*/
                    estado_terminado,
                    indefinido,
                    /*comentario_terminacion,*/
                    /*codigo_grupo_fk,*/
                    fecha_ultimo_pago_cesantias,
                    fecha_ultimo_pago_vacaciones,
                    fecha_ultimo_pago_primas,
                    fecha_ultimo_pago,
                    codigo_tipo_cotizante_fk,
                    /*codigo_subtipo_cotizante_fk,*/
                    salario_integral,
                    /*costo_tipo_fk,*/
                    /*codigo_entidad_salud_fk,
                    codigo_entidad_pension_fk,*/
                    codigo_entidad_cesantia_fk,
                    /*codigo_entidad_caja_fk,*/
                    codigo_ciudad_contrato_fk,
                    codigo_ciudad_labora_fk,
                    /*codigo_costo_clase_fk,*/
                    /*codigo_costo_grupo_fk,*/
                    /*codigo_costo_tipo_fk,*/
                    codigo_centro_trabajo_fk,
                    codigo_sucursal_fk,
                    auxilio_transporte
                 FROM rhu_contrato');
            $datosAMigrar=[];
            foreach($datos as $row) {
                $registro = [];
                for ($i = 0; $i < count($columnas); $i++) {
                    if (isset($row[$columnas[$i]])) {
                        array_push($registro, $row[$columnas[$i]]);
                    } else{
                        array_push($registro, null);
                    }
                }
                array_push($datosAMigrar, $registro);
            }


            $vanadio = $conexion->cerrarConexion();
            $cromo  = $conexion->conexion2();
            $migrarRegistros=$cromo->prepare("insert into rhu_contrato(
                    codigo_contrato_pk,
                    /*codigo_contrato_tipo_fk,*/
                    /*codigo_contrato_clase_fk,*/
                    /*codigo_clasificacion_riesgo_fk,*/
                    /*codigo_contrato_motivo_fk,*/
                    fecha,
                    /*codigo_tiempo_fk,*/
                    factor_horas_dia,
                    /*codigo_pension_fk,*/
                    /*codigo_salud_fk,*/
                    codigo_empleado_fk,
                    fecha_desde,
                    fecha_hasta,
                    numero,
                    /*codigo_cargo_fk,*/
                    cargo_descripcion,
                    vr_salario,
                    /*vr_adicional,*/
                    /*vr_adicional_prestacional,*/
                    estado_terminado,
                    indefinido,
                    /*comentario_terminacion,*/
                    /*codigo_grupo_fk,*/
                    fecha_ultimo_pago_cesantias,
                    fecha_ultimo_pago_vacaciones,
                    fecha_ultimo_pago_primas,
                    fecha_ultimo_pago,
                    codigo_tipo_cotizante_fk,
                    /*codigo_subtipo_cotizante_fk,*/
                    salario_integral,
                    /*costo_tipo_fk,*/
                    /*codigo_entidad_salud_fk,
                    codigo_entidad_pension_fk,*/
                    codigo_entidad_cesantia_fk,
                    /*codigo_entidad_caja_fk,*/
                    codigo_ciudad_contrato_fk,
                    codigo_ciudad_labora_fk,
                    /*codigo_costo_clase_fk,*/
                    /*codigo_costo_grupo_fk,*/
                    /*codigo_costo_tipo_fk,*/
                    codigo_centro_trabajo_fk,
                    codigo_sucursal_fk,
                    auxilio_transporte
                )
                values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            foreach ($datosAMigrar as $datosAMigr) {

                $migrarRegistros->execute($datosAMigr);

            }
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
