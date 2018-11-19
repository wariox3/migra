<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 15/11/18
 * Time: 11:36 AM
 */

class MigrarEmpleados{


    /**
     * MigrarEmpleados constructor.
     */
    public function __construct()
    {
        $this->migrarEmpledos();
    }

    public function migrarEmpledos(){
        try{
            require_once ('Conexion.php');
            $conexion = new Conexion();
            $vanadio=$conexion->conexion1();
            $cromo  = $conexion->conexion2();

            $datos=$vanadio->prepare("select
                codigo_empleado_pk,
                numero_identificacion,
                codigo_ciudad_fk,
                codigo_clasificacion_riesgo_fk,
                codigo_empleado_tipo_fk,
                /*codigo_contrato_fk,
                codigo_cuenta_tipo_fk,*/
                codigo_contrato_ultimo_fk,
                numero_identificacion,
                discapacidad,
                estado_contrato_activo, /*aparece con el nombre de estado_contracto en cromo*/
                carro,
                moto,
                padre_familia,
                cabeza_hogar,
                nombre_corto,
                nombre1,
                nombre2,
                apellido1,
                apellido2,
                telefono,
                celular,
                direccion,
                codigo_ciudad_fk,
                codigo_ciudad_expedicion_fk, /*aparece con el nombre de codigo_ciudad_expedicion_identificacion_fk en cromo*/
                fecha_expedicion_identificacion,
                barrio,
                codigo_rh_fk,
                codigo_sexo_fk,
                correo,
                fecha_nacimiento,
                tipo_cuenta, /*aparece con el nombre de cuenta_tipo en cromo*/
                codigo_ciudad_nacimiento_fk,
                codigo_estado_civil_fk,
                cuenta,
                codigo_banco_fk,
                camisa, /*aparece con el nombre de talla_camisa en cromo*/
                jeans, /*aparece con el nombre de talla_pantalon en cromo*/
                calzado, /*aparece con el nombre de talla_calzado en cromo*/
                estatura,
                peso,
                codigo_cargo_fk from bdsos.rhu_empleado");
            $datos=$datos->fetchAll();
            var_dump($datos);
//            $cromo->prepare("insert into rhu_empleado(
//                codigo_empleado_pk,
//                codigo_identificacion_pk,
//                codigo_ciudad_fk,
//                codigo_clasificacion_riesgo_fk,
//                codigo_empleado_tipo_fk),
//                /*codigo_contrato_fk,
//                codigo_cuenta_tipo_fk,*/
//                codigo_contrato_ultimo_fk,
//                numero_identificacion,
//                discapacidad,
//                estado_contrato,
//                carro,
//                moto,
//                padre_familia,
//                cabeza_hogar,
//                nombre_corto,
//                nombre1,
//                nombre2,
//                apellido1,
//                apellido2,
//                telefono,
//                celular,
//                direccion,
//                codigo_ciudad_fk,
//                codigo_ciudad_expedicion_identificacion_fk,
//                fecha_expedicion_identificacion,
//                barrio,
//                codigo_rh_fk,
//                codigo_sexo_fk,
//                correo,
//                fecha_nacimiento,
//                cueta_tipo,
//                codigo_ciudad_nacimiento_fk,
//                codigo_estado_civil_fk,
//                cuenta,
//                codigo_banco_fk,
//                talla_camisa,
//                talla_pantalon,
//                talla_calzado,
//                estatura,
//                peso,
//                codigo_cargo_fk) values({$datos->execute()})");
//            $cromo->exec();

            $cromo = $conexion->cerrarConexion();
            $vanadio= $conexion->cerrarConexion();
//            echo "realizado <br/>";
        }
        catch (Exception $exception){
            echo "Error:{$exception->getMessage()}<br/>";
        }
    }
}

