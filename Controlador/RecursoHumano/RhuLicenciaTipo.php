<?php

class RhuLicenciaTipo{


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
                'codigo_licencia_tipo_pk',
                'nombre',
                'afecta_salud',
                'ausentismo',
                'maternidad',
                'paternidad',
                'suspension_contrato_trabajo',
                'tipo_novedad_turno',
                'remunerada'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_licencia_tipo");
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
                    codigo_licencia_tipo_pk,  
                    nombre, 
                    afecta_salud, 
                    ausentismo, 
                    maternidad, 
                    paternidad, 
                    suspension_contrato_trabajo, 
                    tipo_novedad_turno, 
                    remunerada
                 FROM rhu_licencia_tipo limit {$aux},{$limite}");
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
                    $cromo->query("insert into rhu_licencia_tipo(
                        codigo_licencia_tipo_pk,  
                        nombre, 
                        afecta_salud, 
                        ausentismo, 
                        maternidad, 
                        paternidad, 
                        suspension_contrato_trabajo, 
                        tipo_novedad_turno, 
                        remunerada
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

