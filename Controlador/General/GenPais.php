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
            $datosAMigrar=[];
            foreach($datos as $row) {
                $registro = [];
                for ($i = 0; $i < count($columnas); $i++) {
                    if (isset($row[$columnas[$i]])) {
                        array_push($registro, $row[$columnas[$i]]);
                    } else{
                        array_push($registro, null);
                    }
                }
                array_push($datosAMigrar, $registro);
            }


            $vanadio = $conexion->cerrarConexion();
            $cromo  = $conexion->conexion2();
            $migrarRegistros=$cromo->prepare("insert into gen_pais(
                  codigo_pais_pk,
                  nombre
                )
                values(?,?)");
            foreach ($datosAMigrar as $datosAMigr) {

                $migrarRegistros->execute($datosAMigr);

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

