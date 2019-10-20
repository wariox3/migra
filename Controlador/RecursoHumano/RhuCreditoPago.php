<?php

class RhuCreditoPago{


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
                'codigo_credito_pago_pk',
                'codigo_credito_fk',
                'codigo_credito_pago_tipo_externo',
                'vr_cuota', 
                'saldo', 
                'numero_cuota_actual',
                'fecha_pago'
            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_credito_pago");
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
                        codigo_credito_pago_pk,
                        codigo_credito_fk,
                        rhu_credito_tipo_pago.codigo_externo as codigo_credito_pago_tipo_externo, 
                        vr_cuota, 
                        saldo, 
                        numero_cuota_actual,
                        fecha_pago                                                
                 FROM rhu_credito_pago
                 left join rhu_credito_tipo_pago ON rhu_credito_pago.codigo_credito_tipo_pago_fk = rhu_credito_tipo_pago.codigo_credito_tipo_pago_pk           
                 limit {$aux},{$limite}");
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
                    $cromo->query("insert into rhu_credito_pago(
                        codigo_credito_pago_pk,
                        codigo_credito_fk, 
                        codigo_credito_pago_tipo_fk, 
                        vr_pago, 
                        vr_saldo, 
                        numero_cuota_actual,
                        fecha_pago                        
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

