<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 20/11/18
 * Time: 15:02 PM
 */

class GenPais{


    /**
     * RhuEmpleados constructor.
     */
    public function __construct()
    {
    }

    public function migrarPais(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_pais_pk',
                'gentilicio'

            );

            $datos=$vanadio->query('SELECT
                  codigo_pais_pk,
                  gentilicio
                 FROM gen_pais');
            $value="";
            foreach($datos as $row) {
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


            $vanadio = $conexion->cerrarConexion();
            $cromo  = $conexion->conexion2();
            if($value!=""){
                $cromo->query("insert into gen_pais(
                  codigo_pais_pk,
                  nombre
                )
                values {$value}");
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

