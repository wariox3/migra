<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 20/11/18
 * Time: 15:02 PM
 */

class GenDepartamento{


    /**
     * RhuEmpleados constructor.
     */
    public function __construct()
    {
    }

    public function migrarDepartamentos(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_departamento_pk',
                'nombre',
                'codigo_pais_fk',
                'codigo_dane'

            );

            $datos=$vanadio->query('SELECT
                  codigo_departamento_pk,
                  nombre,
                  codigo_pais_fk,
                  codigo_dane
                 FROM gen_departamento');
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
                $cromo->query("insert into gen_departamento(
                  codigo_departamento_pk,
                  nombre,
                  codigo_pais_fk,
                  codigo_dane
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

