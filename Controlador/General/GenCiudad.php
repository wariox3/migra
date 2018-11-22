<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 20/11/18
 * Time: 15:02 PM
 */

class GenCiudad{


    /**
     * RhuEmpleados constructor.
     */
    public function __construct()
    {
    }

    public function migrarCiudades(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_ciudad_pk',
                'nombre',
                'codigo_departamento_fk',
                'codigo_dane'
            );

            $datos=$vanadio->query('SELECT
                codigo_ciudad_pk,
                nombre,
                codigo_departamento_fk,
                codigo_dane
                 FROM gen_ciudad');
            $value="";
            foreach($datos as $row) {
                $value="{$value}(";
                for ($i = 0; $i < count($columnas); $i++) {
                    if (isset($row[$columnas[$i]])) {
                        $value="{$value}'{$row[$columnas[$i]]}',";
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
            echo($value);
            $migrarRegistros=$cromo->query("insert into gen_ciudad(
                  codigo_ciudad_pk,
                nombre,
                codigo_departamento_fk,
                codigo_dane
                )
                values {$value}");
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

