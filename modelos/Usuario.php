<?php
require_once("conexion.php");

class Usuario{
    function __construct(){
        
    }
    public static function insertar(){

    }
    
    public static function editar(){
    
    }
    
    public static function desactivar(){

    }
    
    public static function activar(){

    }
    
    public static function mostrar(){

    }
    public static function listar(){

    }
    public static function listarmarcados(){

    }
    public static function verificar($login,$clave){
        $sql = "SELECT * FROM usuarios WHERE login='$login' AND clave='$clave' AND condicion='1'";
        return Consulta($sql);
    }
    public static function contador(){

    }
    
}
