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

    public static function mostrarObj($idrequest_temp){
        $sql = "SELECT * FROM request_temp WHERE idrequest_temp='$idrequest_temp'";
        return Consulta($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idrequest_temp, T2.nombre AS usuario, T3.nombre AS depto, T4.nombre AS buque, T1.fecha, T1.condicion FROM request_temp as T1 LEFT JOIN usuarios as T2 ON T1.idusuario = T2.idusuario LEFT JOIN departamento as T3 ON T1.iddepartamento = T3.iddepartamento LEFT JOIN centro AS T4 ON T1.idcentro = T4.idcentro";
        return Consulta($sql);
    }

    public static function listarP($idrequest_temp){
        $sql = "SELECT T1.idrequest_items_temp, T2.nombre, T1.cantidad FROM request_items_temp AS T1 LEFT JOIN items AS T2 ON T1.iditem = T2.iditems WHERE T1.idrequest_temp = $idrequest_temp";
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

    public static function eliminarItem($idrequest_item){
        $sql = "DELETE FROM request_items_temp WHERE idrequest_items_temp='$idrequest_item'";
        return Consulta($sql);
    }

    public static function insertarItem($idrequest_tempP,$nombreItem,$cantidad){
        $sql = "INSERT INTO request_items_temp (idrequest_temp,iditem,cantidad) VALUES ('$idrequest_tempP','$nombreItem','$cantidad')";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function insertR($idrequest_temp,$dpto,$fecha){
        $sql = "INSERT INTO $dpto (idrequest_temp,fecha) VALUES ('$idrequest_temp','$fecha')";
        return Consulta_retornarID($sql);
    }
    
    public static function updateR($idrequest_temp,$dpto,$codigo){
        $sql = "UPDATE $dpto SET codigo = '$codigo' WHERE idrequest_temp = '$idrequest_temp'";
        echo $sql;
    }
}
