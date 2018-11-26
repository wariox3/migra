<?php

include_once(realpath(__DIR__ . "/../../../Conexion.php"));

class ValidarRhuContrato{

    /**
     * ValidarRhuContrato constructor.
     */
    public function __construct()
    {
    }

    public function validarContratoTipo(){
        try {
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $cromo=$conexion->conexion2();
            $contratoTipoUsado=$vanadio->query("SELECT codigo_contrato_tipo_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_contrato_tipo on rhu_contrato.codigo_contrato_tipo_fk=rhu_contrato_tipo.codigo_contrato_tipo_pk 
group by codigo_contrato_tipo_fk");

//Validar contrato tipo
            $contratoTipoUsado->execute();
            $contratoTipoUsado=$contratoTipoUsado->fetchAll();
            foreach ($contratoTipoUsado as $sinCodigoExterno){
                if($sinCodigoExterno['codigo_externo']===null){
                    echo "- Contrato tipo {$sinCodigoExterno['codigo_contrato_tipo_fk']} no tiene codigo externo y es usado <br/>";
                } else {
                    $contratoTipoDestino=$cromo->query("SELECT codigo_contrato_tipo_pk  
              FROM rhu_contrato_tipo  
              WHERE codigo_contrato_tipo_pk = '" . $sinCodigoExterno['codigo_externo'] . "'");
                    $contratoTipoDestino->execute();
                    $contratoTipoDestino=$contratoTipoDestino->fetchAll();
                    if(!$contratoTipoDestino) {
                        echo "- Contrato tipo {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                    }
                }
            }



        }
        catch (PDOException $exception){
            echo "Erro {$exception->getMessage()} <br>";
            die();
        }
    }

    public function validarContratoClase(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        //Validar contrato clase
        $contratoClaseUsado=$vanadio->query("SELECT codigo_contrato_clase_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_contrato_clase on rhu_contrato.codigo_contrato_clase_fk=rhu_contrato_clase.codigo_contrato_clase_pk 
group by codigo_contrato_clase_fk");

        $contratoClaseUsado->execute();
        $contratoClaseUsado=$contratoClaseUsado->fetchAll();
        foreach ($contratoClaseUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Contrato clase {$sinCodigoExterno['codigo_contrato_clase_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $contratoClaseDestino=$cromo->query("SELECT codigo_contrato_clase_pk
              FROM rhu_contrato_clase
              WHERE codigo_contrato_clase_pk = '" . $sinCodigoExterno['codigo_externo'] . "'");
                $contratoClaseDestino->execute();
                $contratoClaseDestino=$contratoClaseDestino->fetchAll();
                if(!$contratoClaseDestino) {
                    echo "- Contrato clase {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }

    public function validarClasificacionRiesgo(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        $contratoClasificacionRiesgoUsado=$vanadio->query("SELECT codigo_clasificacion_riesgo_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_clasificacion_riesgo on rhu_contrato.codigo_clasificacion_riesgo_fk=rhu_clasificacion_riesgo.codigo_clasificacion_riesgo_pk 
group by codigo_clasificacion_riesgo_fk");

        $contratoClasificacionRiesgoUsado->execute();
        $contratoClasificacionRiesgoUsado=$contratoClasificacionRiesgoUsado->fetchAll();
        foreach ($contratoClasificacionRiesgoUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Clasificacion riesgo {$sinCodigoExterno['codigo_clasificacion_riesgo_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $contratoClasificacionRiesgoDestino=$cromo->query("SELECT codigo_clasificacion_riesgo_pk
              FROM rhu_clasificacion_riesgo
              WHERE codigo_clasificacion_riesgo_pk = '" . $sinCodigoExterno['codigo_externo'] . "'");
                $contratoClasificacionRiesgoDestino->execute();
                $contratoClasificacionRiesgoDestino=$contratoClasificacionRiesgoDestino->fetchAll();
                if(!$contratoClasificacionRiesgoDestino) {
                    echo "- Clasificacion riesgo {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }

    public function validarPension(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        $pensionUsado=$vanadio->query("SELECT codigo_tipo_pension_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_tipo_pension on rhu_contrato.codigo_tipo_pension_fk=rhu_tipo_pension.codigo_tipo_pension_pk 
group by codigo_tipo_pension_fk");

        $pensionUsado->execute();
        $pensionUsado=$pensionUsado->fetchAll();
        foreach ($pensionUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Pension {$sinCodigoExterno['codigo_tipo_pension_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $pensionDestino=$cromo->query("SELECT codigo_pension_pk
              FROM rhu_pension
              WHERE codigo_pension_pk = '" . $sinCodigoExterno['codigo_externo'] . "'");
                $pensionDestino->execute();
                $pensionDestino=$pensionDestino->fetchAll();
                if(!$pensionDestino) {
                    echo "- Pension {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }

    public function validarSalud(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        $saludUsado=$vanadio->query("SELECT codigo_tipo_salud_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_tipo_salud on rhu_contrato.codigo_tipo_salud_fk=rhu_tipo_salud.codigo_tipo_salud_pk 
group by codigo_tipo_salud_fk");

        $saludUsado->execute();
        $saludUsado=$saludUsado->fetchAll();
        foreach ($saludUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Salud {$sinCodigoExterno['codigo_tipo_salud_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $saludDestino=$cromo->query("SELECT codigo_salud_pk
              FROM rhu_salud
              WHERE codigo_salud_pk = '" . $sinCodigoExterno['codigo_externo'] . "'");
                $saludDestino->execute();
                $saludDestino=$saludDestino->fetchAll();
                if(!$saludDestino) {
                    echo "- Salud {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }

    public function validarEntidadCesantia(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        $entidadCesantiaUsado=$vanadio->query("SELECT codigo_entidad_cesantia_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_entidad_cesantia on rhu_contrato.codigo_entidad_cesantia_fk=rhu_entidad_cesantia.codigo_entidad_cesantia_pk
group by codigo_entidad_cesantia_fk");

        $entidadCesantiaUsado->execute();
        $entidadCesantiaUsado=$entidadCesantiaUsado->fetchAll();
        foreach ($entidadCesantiaUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Entidad censatia {$sinCodigoExterno['codigo_entidad_cesantia_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $entidadCesantiaDestino=$cromo->query("SELECT codigo_interface
              FROM rhu_entidad
              WHERE codigo_interface = '" . $sinCodigoExterno['codigo_externo'] . "' AND
              ces=1
              ");
                $entidadCesantiaDestino->execute();
                $entidadCesantiaDestino=$entidadCesantiaDestino->fetchAll();
                if(!$entidadCesantiaDestino) {
                    echo "- Entidad censatia {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }

    public function validarEntidadSalud(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        $entidadSaludUsado=$vanadio->query("SELECT codigo_entidad_salud_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_entidad_salud on rhu_contrato.codigo_entidad_salud_fk=rhu_entidad_salud.codigo_entidad_salud_pk
group by codigo_entidad_salud_fk");

        $entidadSaludUsado->execute();
        $entidadSaludUsado=$entidadSaludUsado->fetchAll();
        foreach ($entidadSaludUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Entidad salud {$sinCodigoExterno['codigo_entidad_salud_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $entidadSaludDestino=$cromo->query("SELECT codigo_interface
              FROM rhu_entidad
              WHERE codigo_interface = '" . $sinCodigoExterno['codigo_externo'] . "' AND
              eps=1
              ");
                $entidadSaludDestino->execute();
                $entidadSaludDestino=$entidadSaludDestino->fetchAll();
                if(!$entidadSaludDestino) {
                    echo "- Entidad salud {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }

    public function validarEntidadPension(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        $entidadPensionUsado=$vanadio->query("SELECT codigo_entidad_pension_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_entidad_pension on rhu_contrato.codigo_entidad_pension_fk=rhu_entidad_pension.codigo_entidad_pension_pk
group by codigo_entidad_pension_fk");

        $entidadPensionUsado->execute();
        $entidadPensionUsado=$entidadPensionUsado->fetchAll();
        foreach ($entidadPensionUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Entidad pension {$sinCodigoExterno['codigo_entidad_pension_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $entidadPensionDestino=$cromo->query("SELECT codigo_interface
              FROM rhu_entidad
              WHERE codigo_interface = '" . $sinCodigoExterno['codigo_externo'] . "' AND
              pen=1
              ");
                $entidadPensionDestino->execute();
                $entidadPensionDestino=$entidadPensionDestino->fetchAll();
                if(!$entidadPensionDestino) {
                    echo "- Entidad pension {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }
    public function validarEntidadCaja(){
        $conexion = new Conexion();
        $vanadio=$conexion->conexion1();
        $cromo=$conexion->conexion2();
        $entidadCajaUsado=$vanadio->query("SELECT codigo_entidad_caja_fk, codigo_externo  
FROM rhu_contrato 
left join rhu_entidad_caja on rhu_contrato.codigo_entidad_caja_fk=rhu_entidad_caja.codigo_entidad_caja_pk
group by codigo_entidad_caja_fk");

        $entidadCajaUsado->execute();
        $entidadCajaUsado=$entidadCajaUsado->fetchAll();
        foreach ($entidadCajaUsado as $sinCodigoExterno){
            if($sinCodigoExterno['codigo_externo']===null){
                echo "- Entidad caja {$sinCodigoExterno['codigo_entidad_caja_fk']} no tiene codigo externo y es usado <br/>";
            } else {
                $entidadCajaDestino=$cromo->query("SELECT codigo_interface
              FROM rhu_entidad
              WHERE codigo_interface = '" . $sinCodigoExterno['codigo_externo'] . "' AND
              ccf=1
              ");
                $entidadCajaDestino->execute();
                $entidadCajaDestino=$entidadCajaDestino->fetchAll();
                if(!$entidadCajaDestino) {
                    echo "- Entidad caja {$sinCodigoExterno['codigo_externo']} no existe en la base de datos destino<br/>";
                }
            }
        }
    }

}