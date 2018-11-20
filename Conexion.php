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
            $bd = 'mysql:'.'localhost;'.'dbname=bdsos';
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


    public function conexion2(){

        try
        {

            $usuario = 'root';
            $contrasena = '123456';
            $conexion = new PDO('mysql:localhost;dbname=bdcromo', $usuario, $contrasena);
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

