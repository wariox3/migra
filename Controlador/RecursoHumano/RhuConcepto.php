<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21/11/18
 * Time: 13:20 PM
 */

class RhuConcepto{


    /**
     * RhuConcepto constructor.
     */
    public function __construct()
    {
    }

    public function migrarConcepto(){
        try{
            require_once('../../Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $columnas=array(
                'codigo_pago_concepto_pk',
                'nombre',
//                'porcentaje', //no aparece o tiene un nombre distinto
                'genera_ingreso_base_prestacion',
                'genera_ingreso_base_cotizacion',
                'operacion',
                'concepto_adicion',
                'tipo_adicional',
                'concepto_auxilio_transporte',
                'concepto_incapacidad',
                'concepto_incapacidad_entidad',
                'concepto_pension',
                'concepto_salud',
                'concepto_vacacion',
                'concepto_comision',
                'concepto_cesantia',
                'numero_dian',
                'recargo_nocturno',
                'concepto_fondo_solidaridad_pensional'

            );
            $totalDatos=$vanadio->query("SELECT COUNT(*) as 'numeroRegistro' FROM rhu_pago_concepto");
            $totalDatos->execute();
            $count=$totalDatos->fetchAll();
            $aux=0;
            if(!isset($count[0]['numeroRegistro'])){
                $count=0;
            }
            while ($aux!==(int)$count) {
                $limite = $aux + 1000;
                $datos = $vanadio->query("SELECT
                codigo_pago_concepto_pk,
                nombre,
                /*porcentaje,*/ 
                genera_ingreso_base_prestacion,
                genera_ingreso_base_cotizacion,
                operacion,
                concepto_adicion,
                tipo_adicional,
                concepto_auxilio_transporte,
                concepto_incapacidad,
                concepto_incapacidad_entidad,
                concepto_pension,
                concepto_salud,
                concepto_vacacion,
                concepto_comision,
                concepto_cesantia,
                numero_dian,
                recargo_nocturno,
                concepto_fondo_solidaridad_pensional
                 FROM rhu_pago_concepto limit {$aux},{$limite}");
                $datosAMigrar = [];
                foreach ($datos as $row) {
                    $registro = [];
                    for ($i = 0; $i < count($columnas); $i++) {
                        if (isset($row[$columnas[$i]])) {
                            array_push($registro, $row[$columnas[$i]]);
                        } else {
                            array_push($registro, null);
                        }
                    }
                    array_push($datosAMigrar, $registro);
                }


                $cromo = $conexion->conexion2();
                $migrarRegistros = $cromo->prepare("insert into rhu_concepto(
                codigo_concepto_pk,
                nombre,
                /*porcentaje,*/
                genera_ingreso_base_prestacion,
                genera_ingreso_base_cotizacion,
                operacion,
                adicional,
                adicional_tipo,
                auxilio_transporte,
                incapacidad,
                incapacidad_entidad,
                pension,
                salud,
                vacacion,
                comision,
                cesantia,
                numero_dian,
                recargo_nocturno,
                fondo_solidaridad_pensional
                )
                values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                foreach ($datosAMigrar as $datosAMigr) {

                    $migrarRegistros->execute($datosAMigr);

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

