<?php
require_once("conexion.php");

class Items{
    function __construct(){
        
    }
    public static function insertar($nombre,$precio_nac,$precio_usd,$unidad,$decimales,$detalle,$servicio){
        $sql = "INSERT INTO items (nombre,precio_nac,precio_usd,unidad,decimales,detalle,servicio,condicion) VALUES ('$nombre','$precio_nac','$precio_usd','$unidad','$decimales','$detalle','$servicio',1)";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
        
    }
    
    public static function editar($iditems,$nombre,$precio_nac,$precio_usd,$unidad,$decimales,$detalle,$servicio){
        $sql = "UPDATE items SET nombre='$nombre',precio_nac='$precio_nac',precio_usd='$precio_usd',unidad='$unidad',decimales='$decimales',detalle='$detalle',servicio='$servicio' WHERE iditems = '$iditems'";
        $sw = true;
        Consulta($sql) or $sw = false;
        return $sw;
    }
    
    public static function desactivar($iditems){
        $sql = "UPDATE items SET condicion='0' WHERE iditems='$iditems'";
        return Consulta($sql);
    }
    
    public static function activar($iditems){
        $sql = "UPDATE items SET condicion='1' WHERE iditems='$iditems'";
        return Consulta($sql);
    }
    
    public static function mostrar($iditems){
        $sql = "SELECT * FROM items WHERE iditems='$iditems'";
        return ConsultaFila($sql);
    }
    
    public static function listar(){
        $sql = "SELECT * FROM items";
        return Consulta($sql);
    }
    
     public static function listarc(){
        $sql = "SELECT iditems, nombre FROM items WHERE condicion=1";
        return Consulta($sql);
    }

    public static function eliminar($iditems){
        $sql = "DELETE FROM items WHERE iditems='$iditems'";
        return Consulta($sql);
    }
    
}
