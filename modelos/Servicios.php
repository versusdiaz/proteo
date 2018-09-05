<?php
require_once("conexion.php");

class Servicios{
    function __construct(){
        
    }
    public static function insertar($nombre,$precio_nac,$precio_usd){
        $sql = "INSERT INTO servicios (nombre,precio_nac,precio_usd,condicion) VALUES ('$nombre','$precio_nac','$precio_usd',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idservicios,$nombre,$precio_nac,$precio_usd){
        $sql = "UPDATE servicios SET nombre='$nombre',precio_nac='$precio_nac',precio_usd='$precio_usd' WHERE idservicios = '$idservicios'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idservicios){
        $sql = "UPDATE servicios SET condicion='0' WHERE idservicios='$idservicios'";
        return Consulta($sql);
    }
    
    public static function activar($idservicios){
        $sql = "UPDATE servicios SET condicion='1' WHERE idservicios='$idservicios'";
        return Consulta($sql);
    }
    
    public static function mostrar($idservicios){
        $sql = "SELECT * FROM servicios WHERE idservicios='$idservicios'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM servicios";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idservicios, nombre FROM servicios WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idservicios){
        $sql = "DELETE FROM servicios WHERE idservicios='$idservicios'";
        return Consulta($sql);
    }
    
}
