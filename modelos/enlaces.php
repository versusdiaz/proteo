<?php
class EnlacesModels{

  public function __construct() { }

  public static function enlacesModels($enlaces){
    if($enlaces == "escritorio" ||
       $enlaces == "clientes" ||
       $enlaces == "proveedores" ||
       $enlaces == "items" ||
       $enlaces == "servicios" ||
       $enlaces == "request_m" ||
       $enlaces == "centro" ||
       $enlaces == "imprimirc"){
       /*MODULO A CARGAR SERA*/
       $module = "vistas/modulos/".$enlaces.".php";
  } else if($enlaces == "index"){
      $module = "vistas/modulos/escritorio.php";
  } else if($enlaces == "admin"){
      $module = "admin/";
  } else {
    $module = "vistas/modulos/inicio.php";
  }
  return $module;
  }
}
