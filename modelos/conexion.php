<?php
require_once("global.php");
$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query($conn,'SET NAMES "'.DB_ENCODE.'"');
/*COMPROBAMOS ERRORES*/
if(mysqli_connect_errno()){
  printf("Error en la conexion a la base de datos: %s\n",mysqli_connect_error());
  exit();
}
if(!function_exists('Consulta')){
  function Consulta($sql){
    global $conn;
    $query = $conn->query($sql);
    return $query;
  }
  function ConsultaFila($sql){
    global $conn;
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    return $row;
  }
  function Consulta_retornarID($sql){
    global $conn;
    $query = $conn->query($sql);
    return $conn->insert_id;
  }
  function Consulta_num($sql){
    global $conn;
    $query = $conn->query($sql);
    $rows = $query->num_rows;  
    return $rows;
  }
  function limpiarCadena($str){
    global $conn;
    $str = mysqli_real_escape_string($conn,trim($str));
    return htmlspecialchars($str);
  }
}
