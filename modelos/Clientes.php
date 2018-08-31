<?php
require_once("conexion.php");

class Clientes{
    function __construct(){
        
    }
    public static function insertar($nombre,$nfiscal,$direccion,$telefono){
        $sql = "INSERT INTO clientes (nombre,nfiscal,direccion,telefono,condicion) VALUES ('$nombre','$nfiscal','$direccion','$telefono',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idcliente,$nombre,$nfiscal,$direccion,$telefono){
        $sql = "UPDATE clientes SET nombre='$nombre',nfiscal='$nfiscal',direccion='$direccion',telefono='$telefono' WHERE idcliente = '$idcliente'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idcliente){
        $sql = "UPDATE clientes SET condicion='0' WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
    public static function activar($idcliente){
        $sql = "UPDATE clientes SET condicion='1' WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
    public static function mostrar($idcliente){
        $sql = "SELECT * FROM clientes WHERE idcliente='$idcliente'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM clientes";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idcliente, nombre FROM clientes WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idcliente){
        $sql = "DELETE FROM clientes WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
}
