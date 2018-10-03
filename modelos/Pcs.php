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
        $sql = "DELETE T1,T2 FROM pcs_items AS T1 LEFT JOIN pcs AS T2 ON T1.idpcs = T2.idpcs WHERE T1.idpcs = '$idpcs' ";
        return Consulta($sql);
    }

}
