<?php
require_once("conexion.php");

class Reportes{
    function __construct(){
        
    }

    public static function mostrarItems($idrequest_temp){
        $sql = "SELECT T1.idrequest_items_temp, T1.detalle, T2.nombre, T1.cantidad, T2.unidad FROM request_items_temp AS T1 LEFT JOIN items AS T2 ON T1.iditem = T2.iditems WHERE T1.idrequest_temp = $idrequest_temp";
        return Consulta($sql);
    }

}
