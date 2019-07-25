<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21/11/18
 * Time: 13:20 PM
 */

class TurProgramacion{


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
                'codigo_programacion_detalle_pk',
                'codigo_recurso_fk',
                'codigo_puesto_fk',
                'anio',
                'mes',
                'dia_1',
                'dia_2',
                'dia_3',
                'dia_4',
                'dia_5',
                'dia_6',
                'dia_7',
                'dia_8',
                'dia_9',
                'dia_10',
                'dia_11',
                'dia_12',
                'dia_13',
                'dia_14',
                'dia_15',
                'dia_16',
                'dia_17',
                'dia_18',
                'dia_19',
                'dia_20',
                'dia_21',
                'dia_22',
                'dia_23',
                'dia_24',
                'dia_25',
                'dia_26',
                'dia_27',
                'dia_28',
                'dia_29',
                'dia_30',
                'dia_31',
                'horas',
                'horas_diurnas',
                'horas_nocturnas',
                'complementario',
                'adicional'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM tur_programacion_detalle");
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
                    codigo_programacion_detalle_pk,
                    codigo_recurso_fk,
                    codigo_puesto_fk,
                    anio,
                    mes,
                    dia_1,
                    dia_2,
                    dia_3,
                    dia_4,
                    dia_5,
                    dia_6,
                    dia_7,
                    dia_8,
                    dia_9,
                    dia_10,
                    dia_11,
                    dia_12,
                    dia_13,
                    dia_14,
                    dia_15,
                    dia_16,
                    dia_17,
                    dia_18,
                    dia_19,
                    dia_20,
                    dia_21,
                    dia_22,
                    dia_23,
                    dia_24,
                    dia_25,
                    dia_26,
                    dia_27,
                    dia_28,
                    dia_29,
                    dia_30,
                    dia_31,
                    horas,
                    horas_diurnas,
                    horas_nocturnas,
                    complementario,
                    adicional
                 FROM tur_programacion_detalle                                    
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
                    $cromo->query("insert into tur_programacion(
                    codigo_programacion_pk,
                    codigo_empleado_fk,
                    codigo_puesto_fk,
                    anio,
                    mes,
                    dia_1,
                    dia_2,
                    dia_3,
                    dia_4,
                    dia_5,
                    dia_6,
                    dia_7,
                    dia_8,
                    dia_9,
                    dia_10,
                    dia_11,
                    dia_12,
                    dia_13,
                    dia_14,
                    dia_15,
                    dia_16,
                    dia_17,
                    dia_18,
                    dia_19,
                    dia_20,
                    dia_21,
                    dia_22,
                    dia_23,
                    dia_24,
                    dia_25,
                    dia_26,
                    dia_27,
                    dia_28,
                    dia_29,
                    dia_30,
                    dia_31,
                    horas,
                    horas_diurnas,
                    horas_nocturnas,
                    complementario,
                    adicional            
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

