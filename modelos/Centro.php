<?php
require_once("conexion.php");

class Centro{
    function __construct(){
        
    }
    public static function insertar($nombre){
        $sql = "INSERT INTO centro (nombre,condicion) VALUES ('$nombre',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idcentro,$nombre){
        $sql = "UPDATE centro SET nombre='$nombre' WHERE idcentro = '$idcentro'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idcentro){
        $sql = "UPDATE centro SET condicion='0' WHERE idcentro='$idcentro'";
        return Consulta($sql);
    }
    
    public static function activar($idcentro){
        $sql = "UPDATE centro SET condicion='1' WHERE idcentro='$idcentro'";
        return Consulta($sql);
    }
    
    public static function mostrar($idcentro){
        $sql = "SELECT * FROM centro WHERE idcentro='$idcentro'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM centro";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcentro, nombre FROM centro WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idcentro){
        $sql = "DELETE FROM centro WHERE idcentro='$idcentro'";
        return Consulta($sql);
    }
    
}
