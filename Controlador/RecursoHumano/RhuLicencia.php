<?php

class RhuLicencia{


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
                'codigo_licencia_pk',
                'codigo_licencia_tipo_fk',
                'codigo_centro_costo_fk',
                'codigo_empleado_fk',
                'codigo_contrato_fk',
                'fecha',
                'fecha_desde',
                'fecha_hasta',
                'cantidad',
                'comentarios',
                'afecta_transporte',
                'codigo_usuario',
                'maternidad',
                'codigo_entidad_salud_fk',
                'paternidad',
                'estado_cobrar',
                'estado_cobrar_cliente',
                'dias_cobro',
                'estado_prorroga',
                'estado_transcripcion',
                'estado_legalizado',
                'porcentaje_pago',
                'vr_cobro',
                'vr_licencia',
                'vr_saldo',
                'vr_pagado',
                'pagar_empleado',
                'vr_ibc_mes_anterior',
                'dias_ibc_mes_anterior',
                'vr_hora',
                'codigo_novedad_programacion',
                'aplicar_adicional',
                'fecha_aplicacion',
                'vr_abono',
                'vr_ibc_propuesto',
                'vr_propuesto'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_licencia");
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
                    codigo_licencia_pk,
                    codigo_licencia_tipo_fk,
                    codigo_centro_costo_fk,
                    codigo_empleado_fk,
                    codigo_contrato_fk,
                    fecha,
                    fecha_desde,
                    fecha_hasta,
                    cantidad,
                    comentarios,
                    afecta_transporte,
                    codigo_usuario,
                    maternidad,
                    codigo_entidad_salud_fk,
                    paternidad,
                    estado_cobrar,
                    estado_cobrar_cliente,
                    dias_cobro,
                    estado_prorroga,
                    estado_transcripcion,
                    estado_legalizado,
                    porcentaje_pago,
                    vr_cobro,
                    vr_licencia,
                    vr_saldo,
                    vr_pagado,
                    pagar_empleado,
                    vr_ibc_mes_anterior,
                    dias_ibc_mes_anterior,
                    vr_hora,
                    codigo_novedad_programacion,
                    aplicar_adicional,
                    fecha_aplicacion,
                    vr_abono, 
                    vr_ibc_propuesto, 
                    vr_propuesto
                 FROM rhu_licencia limit {$aux},{$limite}");
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
                    $cromo->query("insert into rhu_licencia (
                        codigo_licencia_pk,
                        codigo_licencia_tipo_fk,
                        codigo_grupo_fk,
                        codigo_empleado_fk,
                        codigo_contrato_fk,
                        fecha,
                        fecha_desde,
                        fecha_hasta,
                        cantidad,
                        comentarios,
                        afecta_transporte,
                        codigo_usuario,
                        maternidad,
                        codigo_entidad_salud_fk,
                        paternidad,
                        estado_cobrar,
                        estado_cobrar_cliente,
                        dias_cobro,
                        estado_prorroga,
                        estado_transcripcion,
                        estado_legalizado,
                        porcentaje_pago,
                        vr_cobro,
                        vr_licencia,
                        vr_saldo,
                        vr_pagado,
                        pagar_empleado,
                        vr_ibc_mes_anterior,
                        dias_ibc_mes_anterior,
                        vr_hora,
                        codigo_novedad_programacion,
                        aplicar_adicional,
                        fecha_aplicacion,
                        vr_abono, 
                        vr_ibc_propuesto, 
                        vr_propuesto
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

