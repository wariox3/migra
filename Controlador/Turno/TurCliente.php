<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21/11/18
 * Time: 13:20 PM
 */

class TurCliente{


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
                'codigo_cliente_pk',
                'nit',
                'digito_verificacion',
                'nombre_corto',
                'nombre_completo',
                'estrato',
                'direccion',
                'telefono'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM tur_cliente");
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
                codigo_cliente_pk,
                nit,
                digito_verificacion,
                nombre_corto,
                nombre_completo,
                estrato,
                direccion,
                telefono
                 FROM tur_cliente limit {$aux},{$limite}");
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
                    $cromo->query("insert into tur_cliente(
                codigo_cliente_pk,
                numero_identificacion,
                digito_verificacion,
                nombre_corto,
                nombre_extendido,
                estrato,
                direccion,
                telefono
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

