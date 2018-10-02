<?php
require_once("conexion.php");

class OrdenesM{
    function __construct(){
        
    }
     
    public static function listar(){
        $sql = "SELECT * FROM odc_mtto";
        return Consulta($sql);
    }
     
}
