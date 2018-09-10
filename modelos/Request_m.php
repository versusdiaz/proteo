<?php
require_once("conexion.php");

class Request_m{
    function __construct(){
        
    }
    public static function insertar($idusuario,$iddepartamento,$idcentro,$comentario,$responsable,$supervisor,$prioridad,$calidad,$mantenimiento,$fecha){
        $sql = "INSERT INTO request_temp (idusuario,iddepartamento,idcentro,comentario,responsable,supervisor,prioridad,calidad,mantenimiento,fecha,condicion) VALUES ('$idusuario','$iddepartamento','$idcentro','$comentario','$responsable','$supervisor','$prioridad','$calidad','$mantenimiento','$fecha',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idrequest_temp,$idusuario,$iddepartamento,$idcentro,$comentario,$responsable,$supervisor,$prioridad,$calidad,$mantenimiento,$fecha){
        $sql = "UPDATE request_temp SET idusuario='$idusuario',iddepartamento='$iddepartamento',idcentro='$idcentro',comentario='$comentario',responsable='$responsable',supervisor='$supervisor',prioridad='$prioridad',calidad='$calidad',mantenimiento='$mantenimiento',fecha='$fecha' WHERE idrequest_temp = '$idrequest_temp'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idrequest_temp){
        $sql = "UPDATE request_temp SET condicion='0' WHERE idrequest_temp='$idrequest_temp'";
        return Consulta($sql);
    }
    
    public static function activar($idrequest_temp){
        $sql = "UPDATE request_temp SET condicion='1' WHERE idrequest_temp='$idrequest_temp'";
        return Consulta($sql);
    }
    
    public static function mostrar($idrequest_temp){
        $sql = "SELECT * FROM request_temp WHERE idrequest_temp='$idrequest_temp'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idrequest_temp, T2.nombre AS usuario, T3.nombre AS depto, T4.nombre AS buque, T1.fecha, T1.condicion FROM request_temp as T1 LEFT JOIN usuarios as T2 ON T1.idusuario = T2.idusuario LEFT JOIN departamento as T3 ON T1.iddepartamento = T3.iddepartamento LEFT JOIN centro AS T4 ON T1.idcentro = T4.idcentro";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idrequest_temp, nombre FROM request_temp WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idrequest_temp){
        $sql = "DELETE FROM request_temp WHERE idrequest_temp='$idrequest_temp'";
        return Consulta($sql);
    }
    
}
