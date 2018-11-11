<?php
require_once("conexion.php");

class Reportes{
    function __construct(){
        
    }

    public static function mostrarItems($idrequest_temp){
        $sql = "SELECT T1.idrequest_items_temp, T1.detalle, T2.nombre, T1.cantidad, T2.unidad, T1.precio FROM request_items_temp AS T1 LEFT JOIN items AS T2 ON T1.iditem = T2.iditems WHERE T1.idrequest_temp = $idrequest_temp";
        return Consulta($sql);
    }

    public static function dataFormato($idcalidad){
        $sql = "SELECT * FROM formatos WHERE idcalidad = $idcalidad";
        return ConsultaFila($sql);
    }

    public static function mostrarRequest($idrequest_temp){
        $sql = "SELECT T1.comentario, T2.nombre, T1.responsable, T1.supervisor, T1.fecha, T1.prioridad, T1.calidad, T1.mantenimiento, T1.servicio, T3.nombre AS dpto FROM request_temp AS T1 LEFT JOIN centro AS T2 ON T2.idcentro = T1.idcentro LEFT JOIN departamento AS T3 ON T1.iddepartamento = T3.iddepartamento  WHERE idrequest_temp = $idrequest_temp";
        return ConsultaFila($sql);
    }

    public static function numReq($idrequest_temp, $bdDepartamento){
        $sql = "SELECT codigo FROM $bdDepartamento WHERE idrequest_temp = $idrequest_temp";
        return ConsultaFila($sql);
    }

    public static function mostrarOC($idodc,$bdDepartamento,$bdReq){
        $sql = "SELECT T1.codigo, T1.cotizacion, T1.fecha, T2.nombre, T3.codigo FROM $bdDepartamento AS T1 LEFT JOIN proveedores AS T2 ON T1.idproveedor = T2.idproveedor LEFT JOIN $bdReq AS T3 ON T1.idrequest_temp = T3.idrequest_temp WHERE idodc = $idodc";
        return ConsultaFila($sql);
    }

    public static function mostrarPCS($idpcs){
        $sql = "SELECT T1.codigo, T1.fecha, T2.nombre, T2.nfiscal, T2.direccion, T2.telefono FROM pcs AS T1 LEFT JOIN proveedores AS T2 ON T1.idproveedor = T2.idproveedor WHERE idpcs = $idpcs";
        return ConsultaFila($sql);
    }

}
