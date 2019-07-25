<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21/11/18
 * Time: 13:20 PM
 */

class TurServicio{


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
                'codigo_servicio_pk',
                'codigo_cliente_fk',
                'codigo_sector_externo',
                'fecha_generacion',
                'soporte',
                'estado_autorizado',
                'horas',
                'horas_diurnas',
                'horas_nocturnas',
                'vr_total_servicio',
                'vr_total_precio_ajustado',
                'vr_total_precio_minimo',
                'vr_subtotal',
                'vr_iva',
                'vr_base_aiu',
                'vr_total',
                'usuario',
                'comentarios',
                'vr_salario_base',
                'estrato'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM tur_servicio");
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
                codigo_servicio_pk,
                codigo_cliente_fk,  
                tur_sector.codigo_externo as codigo_sector_externo,              
                fecha_generacion,
                soporte,
                estado_autorizado,
                horas,
                horas_diurnas,
                horas_nocturnas,
                vr_total_servicio,
                vr_total_precio_ajustado,
                vr_total_precio_minimo,
                vr_subtotal,
                vr_iva,
                vr_base_aiu,
                vr_total,
                usuario,
                tur_servicio.comentarios,
                vr_salario_base,
                estrato 
                 FROM tur_servicio 
                 left join tur_sector on tur_servicio.codigo_sector_fk = tur_sector.codigo_sector_pk   
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
                    $cromo->query("insert into tur_contrato(
                codigo_contrato_pk,
                codigo_cliente_fk,
                codigo_sector_fk,                
                fecha_generacion,
                soporte,
                estado_autorizado,
                horas,
                horas_diurnas,
                horas_nocturnas,
                vr_total_servicio,
                vr_total_precio_ajustado,
                vr_total_precio_minimo,
                vr_subtotal,
                vr_iva,
                vr_base_aiu,
                vr_total,
                usuario,
                comentarios,
                vr_salario_base,
                estrato                
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

