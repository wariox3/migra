<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 15/11/18
 * Time: 11:27 AM
 */
        require ("vendor/autoload.php");
class Conexion
{

    /**
     * Conexion constructor.
     */
    public function __construct()
    {
        $dotenv = new Dotenv\Dotenv(__DIR__);
        $dotenv->load();
    }

    public function motorBaseDatos($configuracion){
        $mbd=strpos($configuracion,':');
        $mbd=substr($configuracion,0,$mbd);
        return $mbd;
    }


    public function host($configuracion){
        $stringHost=strpos($configuracion,'@');
        $stringFinalHost=substr($configuracion,$stringHost+1);
        $stringFinalHost =substr($stringFinalHost,0,strpos($stringFinalHost,':'));
        return $stringFinalHost;
    }

    public function usuario($configuracion){
        $usuario=strpos($configuracion,'//');
        $usuario=substr($configuracion,$usuario+2,strpos(substr($configuracion,$usuario+1),':')-1);
        return $usuario;
    }

    public function clave($configuracion){
        $clavePosicionInicial=strpos($configuracion,$this->usuario($configuracion));
        $claveString=substr($configuracion,$clavePosicionInicial+strlen($this->usuario($configuracion)));
        $clavePosicionFinal=strpos($claveString,'@');
        $clave=substr($claveString,1,$clavePosicionFinal-1);
        return $clave;
    }

    public function baseDatos($configuracion){
        $baseDatos=strripos($configuracion,"/");
        $baseDatos=substr($configuracion,$baseDatos+1);
        return $baseDatos;
    }

    public function bd($configuracion){
        $bd="{$this->motorBaseDatos($configuracion)}:host={$this->host($configuracion)};dbname={$this->baseDatos($configuracion)}";
        return $bd;
    }

    public function conexion1(){
        try
        {
            $config=getenv('DATABASE_ORIGEN');
            if($config) {
                $bd = $this->bd($config);
                $usuario = $this->usuario($config);
                $contrasena = $this->clave($config);
                $conexion = new PDO($bd, $usuario, $contrasena);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
            }
            else{
                echo "debe configuracion sus conexiones. Cree el archivo .env y configure <br>";
            }

        }

        catch
        (PDOException $exception){
            echo "Error: " . $exception->getMessage() . "<br/>";
        }
    }


    public function conexion2(){

        try
        {
            $config=getenv('DATABASE_DESTINO');
            if($config){
                $bd = $this->bd($config);
                $usuario = $this->usuario($config);
                $contrasena = $this->clave($config);
                $conexion = new PDO($bd, $usuario, $contrasena);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
        }
            else{
            echo "debe configuracion sus conexiones. Cree el archivo .env y configure <br>";
        }
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

