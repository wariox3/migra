<?php

class RhuCredito{


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
                'codigo_credito_pk',
                'codigo_empleado_fk',
                'vr_pagar',
                'vr_cuota',
                'fecha',
                'fecha_inicio',
                'fecha_credito',
                'fecha_finalizacion',
                'codigo_credito_tipo_fk',
                'codigo_centro_costo_fk',
                'numero_cuotas',
                'numero_cuota_actual',
                'nro_libranza',
                'codigo_usuario',
                'comentarios',
                'aplicar_cuota_prima',
                'aplicar_cuota_cesantia',
                'validar_cuotas',
                'estado_suspendido',
                'saldo'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_credito");
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
                        codigo_credito_pk,
                        codigo_empleado_fk,
                        vr_pagar,
                        vr_cuota,
                        fecha,
                        fecha_inicio,
                        fecha_credito,
                        fecha_finalizacion,
                        codigo_credito_tipo_fk,
                        codigo_centro_costo_fk,
                        numero_cuotas,
                        numero_cuota_actual,
                        nro_libranza,
                        codigo_usuario,
                        comentarios,
                        aplicar_cuota_prima,
                        aplicar_cuota_cesantia,
                        validar_cuotas,
                        estado_suspendido,
                        saldo
                 FROM rhu_credito limit {$aux},{$limite}");
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
                    $cromo->query("insert into rhu_credito(
                        codigo_credito_pk,                        
                        codigo_empleado_fk,
                        vr_credito,
                        vr_cuota,
                        fecha,
                        fecha_inicio,
                        fecha_credito,
                        fecha_finalizacion,
                        codigo_credito_tipo_fk,
                        codigo_grupo_fk,
                        numero_cuotas,
                        numero_cuota_actual,
                        numero_libranza,
                        usuario,
                        comentario,
                        aplicar_cuota_prima,
                        aplicar_cuota_cesantia,
                        validar_cuotas,
                        estado_suspendido,
                        vr_saldo
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

