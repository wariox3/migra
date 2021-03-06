<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 20/11/18
 * Time: 15:02 PM
 */

require_once('../../Conexion.php');
class RhuContrato{


    /**
     * RhuEmpleados constructor.
     */
    public function __construct()
    {
    }



    public function migrarContratos(){
        try{
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_contrato_pk',
                'codigo_contrato_tipo_externo',
                'codigo_contrato_clase_externo',
                'codigo_clasificacion_riesgo_externo',
//                'codigo_contrato_motivo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'fecha',
                'codigo_tipo_tiempo_externo',
                'factor_horas_dia',
                'codigo_tipo_pension_externo',
                'codigo_tipo_salud_externo',
                'codigo_empleado_fk',
                'fecha_desde',
                'fecha_hasta',
                'numero',
//                'codigo_cargo_fk',//tabla con referencia (relacion)
                'cargo_descripcion',
                'vr_salario',
                'vr_salario_pago',
//                'vr_adicional', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'vr_adicional_prestacional', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'estado_terminado',
                'indefinido',
//                'comentario_terminacion', //no existe el campo, pero si una fk codigo_motivo_terminacion_contrato_fk
                'codigo_centro_costo_fk',
                'fecha_ultimo_pago_cesantias',
                'fecha_ultimo_pago_vacaciones',
                'fecha_ultimo_pago_primas',
                'fecha_ultimo_pago',
                'codigo_tipo_cotizante_fk',
                'codigo_subtipo_cotizante_fk', //tabla con referencia (relacion)
                'salario_integral',
//                'costo_tipo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'codigo_entidad_salud_externo', //tabla con referencia (relacion)
                'codigo_entidad_pension_externo', //tabla con referencia (relacion)
                /*'codigo_entidad_cesantia_externo',*/
                'codigo_entidad_caja_externo', //tabla con referencia (relacion)
                'codigo_ciudad_contrato_fk',
                'codigo_ciudad_labora_fk',
//                'codigo_costo_clase_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'codigo_costo_grupo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
//                'codigo_costo_tipo_fk', //no existe en vanadio o no se conoce el nombre de referecia en vanadio
                'codigo_centro_trabajo_fk',
                'auxilio_transporte'

            );

            $columnasCodigosInterface=[
                'codigo_entidad_salud_externo', //tabla con referencia (relacion)
                'codigo_entidad_pension_externo', //tabla con referencia (relacion)
                /*'codigo_entidad_cesantia_externo',*/
                'codigo_entidad_caja_externo',
            ];

            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_contrato");
            $totalDatos->execute();
            $count=$totalDatos->fetchAll();
            $aux=0;
            if(!isset($count[0]['numeroRegistro'])){
                $count=0;
            }else{

                $count=$count[0]['numeroRegistro'];
            }
            $cromo = $conexion->conexion2();
            $entidad=$cromo->query("SELECT codigo_interface, codigo_entidad_pk FROM rhu_entidad ");
            $entidad->execute();
            $datosEntidad=$entidad->fetchAll();
            while ($aux!==(int)$count) {
                $limite = $aux + 1000;
                $datos = $vanadio->query("SELECT
                    codigo_contrato_pk,
                    rhu_contrato_tipo.codigo_externo as codigo_contrato_tipo_externo,
                    rhu_contrato_clase.codigo_externo as codigo_contrato_clase_externo,
                    rhu_clasificacion_riesgo.codigo_externo as codigo_clasificacion_riesgo_externo,
                    /*codigo_contrato_motivo_fk,*/
                    fecha,
                    rhu_tipo_tiempo.codigo_externo as codigo_tipo_tiempo_externo,
                    rhu_contrato.factor_horas_dia,
                    rhu_tipo_pension.codigo_externo as codigo_tipo_pension_externo,
                    rhu_tipo_salud.codigo_externo as codigo_tipo_salud_externo,
                    codigo_empleado_fk,
                    fecha_desde,
                    fecha_hasta,
                    numero,
                    /*codigo_cargo_fk,*/
                    cargo_descripcion,
                    vr_salario,
                    vr_salario_pago,
                    /*vr_adicional,*/
                    /*vr_adicional_prestacional,*/
                    estado_terminado,
                    rhu_contrato.indefinido,
                    /*comentario_terminacion,*/
                    codigo_centro_costo_fk,
                    fecha_ultimo_pago_cesantias,
                    fecha_ultimo_pago_vacaciones,
                    fecha_ultimo_pago_primas,
                    fecha_ultimo_pago,
                    codigo_tipo_cotizante_fk,
                    codigo_subtipo_cotizante_fk,
                    salario_integral,
                    /*costo_tipo_fk,*/
                    rhu_entidad_salud.codigo_interface as codigo_entidad_salud_externo,
                    rhu_entidad_pension.codigo_interface as codigo_entidad_pension_externo,
                    /*rhu_entidad_cesantia.codigo_externo as codigo_entidad_cesantia_externo,*/
                    rhu_entidad_caja.codigo_interface as codigo_entidad_caja_externo,
                    codigo_ciudad_contrato_fk,
                    codigo_ciudad_labora_fk,
                    /*codigo_costo_clase_fk,*/
                    /*codigo_costo_grupo_fk,*/
                    /*codigo_costo_tipo_fk,*/
                    codigo_centro_trabajo_fk,
                    auxilio_transporte
                  FROM rhu_contrato 
                  left join rhu_contrato_tipo on rhu_contrato.codigo_contrato_tipo_fk = rhu_contrato_tipo.codigo_contrato_tipo_pk
                  left join rhu_contrato_clase on rhu_contrato_clase.codigo_contrato_clase_pk=rhu_contrato.codigo_contrato_clase_fk
                  left join rhu_clasificacion_riesgo on rhu_clasificacion_riesgo.codigo_clasificacion_riesgo_pk=rhu_contrato.codigo_clasificacion_riesgo_fk
                  left join rhu_tipo_pension on rhu_tipo_pension.codigo_tipo_pension_pk=rhu_contrato.codigo_tipo_pension_fk
                  left join rhu_tipo_salud on rhu_tipo_salud.codigo_tipo_salud_pk=rhu_contrato.codigo_tipo_salud_fk
                  left join rhu_entidad_salud on rhu_entidad_salud.codigo_entidad_salud_pk=rhu_contrato.codigo_entidad_salud_fk
                  left join rhu_entidad_pension on rhu_entidad_pension.codigo_entidad_pension_pk=rhu_contrato.codigo_entidad_pension_fk
                  left join rhu_entidad_cesantia on rhu_entidad_cesantia.codigo_entidad_cesantia_pk=rhu_contrato.codigo_entidad_cesantia_fk
                  left join rhu_entidad_caja on rhu_entidad_caja.codigo_entidad_caja_pk=rhu_contrato.codigo_entidad_caja_fk
                  left join rhu_tipo_tiempo on rhu_contrato.codigo_tipo_tiempo_fk=rhu_tipo_tiempo.codigo_tipo_tiempo_pk
                  limit {$aux},{$limite} ");
                $value="";
                foreach($datos as $row) {
                    $aux++;
                    $value="{$value}(";
                    for ($i = 0; $i < count($columnas); $i++) {
                        if(in_array($columnas[$i],$columnasCodigosInterface)){
                            $auxEncontrarCodigoInterface=0;
                            for ($j=0;$j<count($datosEntidad);$j++){
                               if( $datosEntidad[$j]['codigo_interface']===$row[$columnas[$i]]){
                                   $value="{$value}{$datosEntidad[$j]['codigo_entidad_pk']},";
                                   $auxEncontrarCodigoInterface=1;
                               }
                               else if($j==count($datosEntidad)-1 && $auxEncontrarCodigoInterface==0){
                                   $value="{$value}null,";
                               }
                            }
                        }
                        else if(isset($row[$columnas[$i]])) {
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

                if($value!=""){
                    $cromo->query("insert into rhu_contrato(
                    codigo_contrato_pk,
                    codigo_contrato_tipo_fk,
                    codigo_contrato_clase_fk,
                    codigo_clasificacion_riesgo_fk,
                    /*codigo_contrato_motivo_fk,*/
                    fecha,
                    codigo_tiempo_fk,
                    factor_horas_dia,
                    codigo_pension_fk,
                    codigo_salud_fk,
                    codigo_empleado_fk,
                    fecha_desde,
                    fecha_hasta,
                    numero,
                    /*codigo_cargo_fk,*/
                    cargo_descripcion,
                    vr_salario,
                    vr_salario_pago,
                    /*vr_adicional,*/
                    /*vr_adicional_prestacional,*/
                    estado_terminado,
                    indefinido,
                    /*comentario_terminacion,*/
                    codigo_grupo_fk,
                    fecha_ultimo_pago_cesantias,
                    fecha_ultimo_pago_vacaciones,
                    fecha_ultimo_pago_primas,
                    fecha_ultimo_pago,
                    codigo_tipo_cotizante_fk,
                    codigo_subtipo_cotizante_fk,
                    salario_integral,
                    /*costo_tipo_fk,*/
                    codigo_entidad_salud_fk,
                    codigo_entidad_pension_fk,
                    /*codigo_entidad_cesantia_fk,*/
                    codigo_entidad_caja_fk,
                    codigo_ciudad_contrato_fk,
                    codigo_ciudad_labora_fk,
                    /*codigo_costo_clase_fk,*/
                    /*codigo_costo_grupo_fk,*/
                    /*codigo_costo_tipo_fk,*/
                    codigo_centro_trabajo_fk,
                    auxilio_transporte
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

