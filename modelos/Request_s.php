<?php
require_once("conexion.php");

class Request_s {
    function __construct(){
        
    }
    public static function insertar($idusuario,$iddepartamento,$idcentro,$comentario,$responsable,$supervisor,$prioridad,$calidad,$mantenimiento,$fecha){
        $sql = "INSERT INTO requestS_temp (idusuario,iddepartamento,idcentro,comentario,responsable,supervisor,prioridad,calidad,mantenimiento,fecha,condicion) VALUES ('$idusuario','$iddepartamento','$idcentro','$comentario','$responsable','$supervisor','$prioridad','$calidad','$mantenimiento','$fecha',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function editar($idrequestS_temp,$idusuario,$iddepartamento,$idcentro,$comentario,$responsable,$supervisor,$prioridad,$calidad,$mantenimiento,$fecha){
        $sql = "UPDATE requestS_temp SET idusuario='$idusuario',iddepartamento='$iddepartamento',idcentro='$idcentro',comentario='$comentario',responsable='$responsable',supervisor='$supervisor',prioridad='$prioridad',calidad='$calidad',mantenimiento='$mantenimiento',fecha='$fecha' WHERE idrequestS_temp = '$idrequestS_temp'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($idrequestS_temp){
        $sql = "UPDATE requestS_temp SET condicion='0' WHERE idrequestS_temp='$idrequestS_temp'";
        return Consulta($sql);
    }
    
    public static function activar($idrequestS_temp){
        $sql = "UPDATE requestS_temp SET condicion='1' WHERE idrequestS_temp='$idrequestS_temp'";
        return Consulta($sql);
    }
    
    public static function mostrar($idrequestS_temp){
        $sql = "SELECT * FROM requestS_temp WHERE idrequestS_temp='$idrequestS_temp'";
        return ConsultaFila($sql);
    }

    public static function mostrarObj($idrequestS_temp){
        $sql = "SELECT * FROM requestS_temp WHERE idrequestS_temp='$idrequestS_temp'";
        return Consulta($sql);
    }
    
    public static function listar(){
        $sql = "SELECT T1.idrequestS_temp, T2.nombre AS usuario, T3.nombre AS depto, T4.nombre AS buque, T1.fecha, T1.condicion FROM requestS_temp as T1 LEFT JOIN usuarios as T2 ON T1.idusuario = T2.idusuario LEFT JOIN departamento as T3 ON T1.iddepartamento = T3.iddepartamento LEFT JOIN centro AS T4 ON T1.idcentro = T4.idcentro WHERE T1.condicion=1";
        return Consulta($sql);
    }

    public static function listarP($idrequestS_temp){
        $sql = "SELECT T1.idrequest_services_temp, T1.detalle, T2.nombre, T1.cantidad FROM request_services_temp AS T1 LEFT JOIN servicios AS T2 ON T1.idservicios = T2.idservicios WHERE T1.idrequestS_temp = $idrequestS_temp";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT idrequestS_temp, nombre FROM requestS_temp WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($idrequestS_temp){
        $sql = "DELETE FROM requestS_temp WHERE idrequestS_temp='$idrequestS_temp'";
        return Consulta($sql);
    }

    public static function eliminarItem($idrequest_services){
        $sql = "DELETE FROM request_services_temp WHERE idrequest_services_temp='$idrequest_services'";
        return Consulta($sql);
    }

    public static function insertarItem($idrequestS_tempP,$detalle,$nombreItem,$cantidad){
        $sql = "INSERT INTO request_services_temp (idrequestS_temp,detalle,idservicios,cantidad) VALUES ('$idrequestS_tempP','$detalle','$nombreItem','$cantidad')";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }

    public static function insertR($idrequestS_temp,$dpto,$fecha){
        $sql = "INSERT INTO $dpto (idrequestS_temp,fecha) VALUES ('$idrequestS_temp','$fecha')";
        return Consulta_retornarID($sql);
    }
    
    public static function updateR($idrequestS_temp,$dpto,$codigo){
        $sql = "UPDATE $dpto SET codigo = '$codigo' WHERE idrequestS_temp = '$idrequestS_temp'";
        return Consulta($sql);        
    }

    public static function vincular($idrequestS_temp){
        $sql = "UPDATE requestS_temp SET condicion='2' WHERE idrequestS_temp='$idrequestS_temp'";
        return Consulta($sql);
    }

    public static function validarAnterior($iddepartamento,$fecha){
        $sql = "SELECT idrequestS_temp FROM requestS_temp WHERE fecha < '$fecha' AND iddepartamento = '$iddepartamento' AND condicion != 2";
        return Consulta_num($sql);        
    }

    public static function validarSiguiente($iddepartamento,$fecha){
        $sql = "SELECT idrequestS_temp FROM requestS_temp WHERE fecha > '$fecha' AND iddepartamento = '$iddepartamento' AND condicion = 2";
        return Consulta_num($sql);        
    }

}
