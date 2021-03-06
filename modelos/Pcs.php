<?php
require_once("conexion.php");

class Pcs{
    function __construct(){
        
    }
    public static function insertar($nombre){
        $sql = "INSERT INTO centro (nombre,condicion) VALUES ('$nombre',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idpcs,$idproveedor){
        $sql = "UPDATE pcs SET idproveedor='$idproveedor' WHERE idpcs = '$idpcs'";
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
    
    public static function mostrar($idpcs){
        $sql = "SELECT * FROM pcs WHERE idpcs='$idpcs'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM pcs";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcentro, nombre FROM centro WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idpcs){
        $sql = "DELETE FROM pcs WHERE idpcs = '$idpcs' ";
        return Consulta($sql);
    }

    public static function updateOC($idrequest_temp,$idproveedor,$cotizacion,$dpto){
        $sql = "UPDATE $dpto SET idproveedor='$idproveedor', cotizacion ='$cotizacion' WHERE idrequest_temp = '$idrequest_temp'";
        return Consulta($sql);
    }

}
