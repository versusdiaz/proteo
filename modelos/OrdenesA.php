<?php
require_once("conexion.php");

class OrdenesA{
    function __construct(){
        
    }
     
    public static function listar(){
        $sql = "SELECT * FROM odc_al";
        return Consulta($sql);
    }
     
}
