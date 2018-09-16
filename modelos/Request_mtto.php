<?php
require_once("conexion.php");

class Request_mtto{
    function __construct(){
        
    }
     
    public static function activar($idcliente){
        $sql = "UPDATE clientes SET condicion='1' WHERE idcliente='$idcliente'";
        return Consulta($sql);
    }
    
    public static function mostrar($idrequest_mtto){
        $sql = "SELECT * FROM request_mtto WHERE idrequest_mtto='$idrequest_mtto'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idrequest_mtto, T1.codigo, T1.fecha, T4.nombre, T3.nombre AS lancha FROM request_mtto AS T1 LEFT JOIN request_temp AS T2 ON T2.idrequest_temp = T1.idrequest_temp LEFT JOIN centro AS T3 ON T3.idcentro = T2.idcentro LEFT JOIN usuarios AS T4 ON T2.idusuario = T4.idusuario";
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
