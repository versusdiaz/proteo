<?php
require_once("conexion.php");

class Proveedores{
    function __construct(){
        
    }
    public static function insertar($nombre,$nfiscal,$direccion,$telefono){
        $sql = "INSERT INTO proveedores (nombre,nfiscal,direccion,telefono,condicion) VALUES ('$nombre','$nfiscal','$direccion','$telefono',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idproveedor,$nombre,$nfiscal,$direccion,$telefono){
        $sql = "UPDATE proveedores SET nombre='$nombre',nfiscal='$nfiscal',direccion='$direccion',telefono='$telefono' WHERE idproveedor = '$idproveedor'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idproveedor){
        $sql = "UPDATE proveedores SET condicion='0' WHERE idproveedor='$idproveedor'";
        return Consulta($sql);
    }
    
    public static function activar($idproveedor){
        $sql = "UPDATE proveedores SET condicion='1' WHERE idproveedor='$idproveedor'";
        return Consulta($sql);
    }
    
    public static function mostrar($idproveedor){
        $sql = "SELECT * FROM proveedores WHERE idproveedor='$idproveedor'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM proveedores";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idproveedor, nombre FROM proveedores WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idproveedor){
        $sql = "DELETE FROM proveedores WHERE idproveedor='$idproveedor'";
        return Consulta($sql);
    }
    
}
