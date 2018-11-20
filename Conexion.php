<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 15/11/18
 * Time: 11:27 AM
 */
class Conexion
{

    /**
     * Conexion constructor.
     */
    public function __construct()
    {
        ini_set('display_errors', true);
        error_reporting(E_ALL);
    }

    public function conexion1(){
        try
        {

            $bd = 'mysql:host=localhost;dbname=bdsos';
            $usuario = 'root';
            $contrasena = '123456';
            $conexion = new PDO($bd, $usuario, $contrasena);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }

        catch
        (PDOException $exception){
            return "Error: " . $exception->getMessage() . "<br/>";
        }
    }


    public function conexion2(){

        try
        {
            $bd='mysql:host=localhost;dbname=bdcromo';
            $usuario = 'root';
            $contrasena = '123456';
            $conexion = new PDO($bd, $usuario, $contrasena);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }

        catch
        (PDOException $exception){
            echo "Error: " . $exception->getMessage() . "<br/>";
        }
    }

    public function cerrarConexion(){
        return null;
    }
}

