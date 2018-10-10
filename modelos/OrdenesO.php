<?php
require_once("conexion.php");

class OrdenesO{
    function __construct(){
        
    }
     
    public static function listar(){
        $sql = "SELECT * FROM odc_op";
        return Consulta($sql);
    }
     
}
