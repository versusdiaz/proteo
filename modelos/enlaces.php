<?php
class EnlacesModels{

  public function __construct() { }

  public static function enlacesModels($enlaces){
    if($enlaces == "escritorio" ||
       $enlaces == "clientes" ||
       $enlaces == "proveedores" ||
       $enlaces == "items" ||
       $enlaces == "request_m" ||
       $enlaces == "ordenesM" ||
       $enlaces == "ordenesO" ||
       $enlaces == "ordenesA" ||
       $enlaces == "pcs" ||
       $enlaces == "request_s" ||
       $enlaces == "request_mtto" ||
       $enlaces == "request_op" ||
       $enlaces == "request_al" ||
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
