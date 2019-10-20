<?php

class RhuIncapacidad{


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
                'codigo_incapacidad_pk',
                'numero',
                'fecha',
                'fecha_desde',
                'fecha_hasta',
                'codigo_centro_costo_fk',
                'tipo_incapacidad',
                'codigo_incapacidad_diagnostico_fk',
                'cantidad',
                'dias_cobro',
                'estado_transcripcion',
                'vr_incapacidad',
                'vr_pagado',
                'vr_saldo',
                'porcentaje_pago',
                'codigo_usuario',
                'estado_legalizado',
                'vr_cobro',
                'vr_ibc_propuesto',
                'dias_entidad',
                'dias_empresa',
                'dias_acumulados',
                'pagar_empleado',
                'vr_ibc_mes_anterior', 
                'dias_ibc_mes_anterior', 
                'vr_hora', 
                'codigo_incapacidad_prorroga_fk', 
                'fecha_desde_empresa', 
                'fecha_hasta_empresa', 
                'fecha_desde_entidad', 
                'fecha_hasta_entidad', 
                'vr_propuesto', 
                'vr_hora_empresa', 
                'fecha_documento_fisico', 
                'aplicar_adicional', 
                'fecha_aplicacion', 
                'vr_abono', 
                'medico', 
                'vr_salario',
                'codigo_empleado_fk',
                'codigo_contrato_fk',
                'numero_eps',
                'comentarios',
                'estado_cobrar',
                'estado_prorroga',
                'codigo_cliente_fk',
                'codigo_cobro_fk',
                'estado_cobrado',
                'estado_cobrar_cliente',
                'codigo_entidad_salud_externo'
            );
             
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_incapacidad");
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
                        codigo_incapacidad_pk,
                        numero,
                        fecha,
                        fecha_desde,
                        fecha_hasta,
                        codigo_centro_costo_fk,
                        IF(codigo_incapacidad_tipo_fk = 1, 'GEN', 'LAB') AS tipo_incapacidad,
                        codigo_incapacidad_diagnostico_fk,
                        cantidad,
                        dias_cobro,
                        estado_transcripcion,
                        vr_incapacidad,
                        vr_pagado,
                        vr_saldo, 
                        porcentaje_pago, 
                        codigo_usuario, 
                        estado_legalizado,
                        vr_cobro,
                        vr_ibc_propuesto, 
                        dias_entidad, 
                        dias_empresa, 
                        dias_acumulados, 
                        pagar_empleado,
                        vr_ibc_mes_anterior, 
                        dias_ibc_mes_anterior, 
                        vr_hora, 
                        codigo_incapacidad_prorroga_fk, 
                        fecha_desde_empresa, 
                        fecha_hasta_empresa, 
                        fecha_desde_entidad, 
                        fecha_hasta_entidad, 
                        vr_propuesto, 
                        vr_hora_empresa, 
                        fecha_documento_fisico, 
                        aplicar_adicional, 
                        fecha_aplicacion, 
                        vr_abono, 
                        medico, 
                        vr_salario,  
                        codigo_empleado_fk, 
                        codigo_contrato_fk, 
                        numero_eps, 
                        comentarios, 
                        estado_cobrar, 
                        estado_prorroga, 
                        codigo_cliente_fk, 
                        codigo_cobro_fk, 
                        estado_cobrado, 
                        estado_cobrar_cliente,
                        rhu_entidad_salud.codigo_externo as codigo_entidad_salud_externo                                                                          
                 FROM rhu_incapacidad    
                 left join rhu_entidad_salud on rhu_entidad_salud.codigo_entidad_salud_pk=rhu_incapacidad.codigo_entidad_salud_fk               
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
                    $cromo->query("insert into rhu_incapacidad(
                        codigo_incapacidad_pk,
                        numero,
                        fecha,
                        fecha_desde,
                        fecha_hasta,
                        codigo_grupo_fk,
                        codigo_incapacidad_tipo_fk,
                        codigo_incapacidad_diagnostico_fk,
                        cantidad,
                        dias_cobro,
                        estado_transcripcion,
                        vr_incapacidad,
                        vr_pagado,
                        vr_saldo, 
                        porcentaje_pago, 
                        codigo_usuario, 
                        estado_legalizado,
                        vr_cobro,
                        vr_ibc_propuesto, 
                        dias_entidad, 
                        dias_empresa, 
                        dias_acumulados, 
                        pagar_empleado,
                        vr_ibc_mes_anterior, 
                        dias_ibc_mes_anterior, 
                        vr_hora, 
                        codigo_incapacidad_prorroga_fk, 
                        fecha_desde_empresa, 
                        fecha_hasta_empresa, 
                        fecha_desde_entidad, 
                        fecha_hasta_entidad, 
                        vr_propuesto, 
                        vr_hora_empresa, 
                        fecha_documento_fisico, 
                        aplicar_adicional, 
                        fecha_aplicacion, 
                        vr_abono, 
                        medico, 
                        vr_salario,   
                        codigo_empleado_fk, 
                        codigo_contrato_fk, 
                        numero_eps, 
                        comentarios, 
                        estado_cobrar, 
                        estado_prorroga, 
                        codigo_cliente_fk, 
                        codigo_cobro_fk, 
                        estado_cobrado, 
                        estado_cobrar_cliente,
                        codigo_entidad_salud_fk                                                                          
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

