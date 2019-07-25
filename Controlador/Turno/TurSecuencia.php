<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21/11/18
 * Time: 13:20 PM
 */

class TurSecuencia{


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
                'codigo_turno_pk', 
                'nombre', 
                'hora_desde', 
                'hora_hasta', 
                'horas',
                'horas_diurnas', 
                'horas_nocturnas', 
                'novedad', 
                'descanso', 
                'incapacidad', 
                'licencia', 
                'licencia_no_remunerada', 
                'vacacion', 
                'ingreso', 
                'retiro', 
                'induccion',
                'complementario', 
                'turno_completo',
                'ausentismo', 
                'dia', 
                'noche'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM tur_turno");
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
                codigo_turno_pk, 
                nombre, 
                hora_desde, 
                hora_hasta, 
                horas,                  
                horas_diurnas, 
                horas_nocturnas, 
                novedad, 
                descanso, 
                incapacidad, 
                licencia, 
                licencia_no_remunerada, 
                vacacion, 
                ingreso, 
                retiro, 
                induccion,                   
                complementario, 
                turno_completo,                  
                ausentismo, 
                dia, 
                noche
                 FROM tur_turno limit {$aux},{$limite}");
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
                    $cromo->query("insert into tur_turno(
                codigo_turno_pk, 
                nombre, 
                hora_desde, 
                hora_hasta, 
                horas,  
                horas_diurnas, 
                horas_nocturnas, 
                novedad, 
                descanso, 
                incapacidad, 
                licencia, 
                licencia_no_remunerada, 
                vacacion, 
                ingreso, 
                retiro, 
                induccion,                               
                complementario, 
                completo,                  
                ausentismo, 
                dia, 
                noche
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

