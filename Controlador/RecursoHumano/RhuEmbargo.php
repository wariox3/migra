<?php

class RhuEmbargo{


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
                codigo_embargo_pk,
                tipo_embargo,
                codigo_empleado_fk,
                fecha,
                numero,
                estado_activo,
                valor_fijo,
                porcentaje_devengado,
                porcentaje_devengado_menos_descuento_ley,
                partesExcedaSalarioMinimo,
                partes,
                valor,
                porcentaje,
                codigo_usuario,
                comentarios,
                porcentaje_devengado_prestacional,
                porcentajeExcedaSalarioMinimo,
                codigo_embargo_juzgado_fk,
                cuenta,
                tipo_cuenta,
                numero_expediente,
                numero_proceso,
                oficio,
                fecha_inicio_folio,
                numero_identificacion_demandante,
                nombre_corto_demandante,
                numero_identificacion_beneficiario,
                nombre_corto_beneficiario,
                fecha_inactivacion,
                oficina,
                vr_monto_maximo,
                porcentaje_devengado_prestacional_menos_descuento_ley,
                porcentaje_devengado_prestacional_menos_descuento_ley_transporte,
                porcentaje_devengado_menos_descuento_ley_transporte,
                numero_radicado,
                oficio_inactivacion,
                afecta_nomina,
                afecta_vacacion,
                afecta_prima,
                afecta_liquidacion,
                afecta_cesantia,
                partesExcedaSalarioMinimoMenosDescuentoLey, 
                porcentaje_salario_minimo, 
                saldo, 
                descuento, 
                validar_monto_maximo, 
                oficina_destino, 
                consecutivo_juzgado, 
                codigo_instancia, 
                apellidos_demandante, 
                afecta_indemnizacion
            );
             
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_embargo");
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
                    codigo_embargo_pk,
                    IF(codigo_embargo_tipo_fk = 1, 'JUD', IF(codigo_embargo_tipo_fk = 2, 'COM', 'ALI')) AS tipo_embargo,
                    codigo_empleado_fk,
                    fecha,
                    numero,
                    estado_activo,
                    valor_fijo,
                    porcentaje_devengado,
                    porcentaje_devengado_menos_descuento_ley,
                    partesExcedaSalarioMinimo,
                    partes,
                    valor,
                    porcentaje,
                    codigo_usuario,
                    comentarios,
                    porcentaje_devengado_prestacional,
                    porcentajeExcedaSalarioMinimo,
                    codigo_embargo_juzgado_fk,
                    cuenta,
                    tipo_cuenta,
                    numero_expediente,
                    numero_proceso,
                    oficio,
                    fecha_inicio_folio,
                    numero_identificacion_demandante,
                    nombre_corto_demandante,
                    numero_identificacion_beneficiario,
                    nombre_corto_beneficiario,
                    fecha_inactivacion,
                    oficina,
                    vr_monto_maximo,
                    porcentaje_devengado_prestacional_menos_descuento_ley,
                    porcentaje_devengado_prestacional_menos_descuento_ley_transporte,
                    porcentaje_devengado_menos_descuento_ley_transporte,
                    numero_radicado,
                    oficio_inactivacion,
                    afecta_nomina,
                    afecta_vacacion,
                    afecta_prima,
                    afecta_liquidacion,
                    afecta_cesantia,
                    partesExcedaSalarioMinimoMenosDescuentoLey, 
                    porcentaje_salario_minimo, 
                    saldo, 
                    descuento, 
                    validar_monto_maximo, 
                    oficina_destino, 
                    consecutivo_juzgado, 
                    codigo_instancia, 
                    apellidos_demandante, 
                    afecta_indemnizacion                                                                      
                 FROM rhu_embargo                  
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
                    $cromo->query("insert into rhu_embargo(
                    codigo_embargo_pk,
                    codigo_embargo_tipo_fk,
                    codigo_empleado_fk,
                    fecha,
                    numero,
                    estado_activo,
                    valor_fijo,
                    porcentaje_devengado,
                    porcentaje_devengado_menos_descuento_ley,
                    partes_exceda_salario_minimo,
                    partes,
                    vr_valor,
                    vr_porcentaje,
                    codigo_usuario,
                    comentarios,
                    porcentaje_devengado_prestacional,
                    porcentaje_exceda_salario_minimo,
                    codigo_embargo_juzgado_fk,
                    cuenta,
                    tipo_cuenta,
                    numero_expediente,
                    numero_proceso,
                    oficio,
                    fecha_inicio_folio,
                    numero_identificacion_demandante,
                    nombre_corto_demandante,
                    numero_identificacion_beneficiario,
                    nombre_corto_beneficiario,
                    fecha_inactivacion,
                    oficina,
                    vr_monto_maximo,
                    porcentaje_devengado_prestacional_menos_descuento_ley,
                    porcentaje_devengado_prestacional_menos_descuento_ley_transporte,
                    porcentaje_devengado_menos_descuento_ley_transporte,
                    numero_radicado,
                    oficio_inactivacion,
                    afecta_nomina,
                    afecta_vacacion,
                    afecta_prima,
                    afecta_liquidacion,
                    afecta_cesantia,
                    partes_exceda_salario_minimo_menos_descuento_ley, 
                    porcentaje_salario_minimo, 
                    saldo, 
                    descuento, 
                    validar_monto_maximo, 
                    oficina_destino, 
                    consecutivo_juzgado, 
                    codigo_instancia, 
                    apellidos_demandante, 
                    afecta_indemnizacion                                                                     
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

