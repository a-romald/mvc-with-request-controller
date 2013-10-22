<?php
defined('SYSPATH') or die('No direct script access.');

/**
 * Routes are used to determine the controller and action for a requested URI.
 * Routes may also contain keys which can be used to set the
 * controller, action, and parameters.
 * 
 */
  class Routes {
    
  /**
   * Retrive GET parameters and dispathes the routes.
   * @param <array> $get
   * 
   */
  public static function dispatch(){
    
    $address = $_SERVER['REQUEST_URI'];
    $path = explode("/", $address);
    $controller = !empty($path[1]) ? $path[1] : 'main';
    $action = !empty($path[2]) ? $path[2] : 'index';
    if (!empty($path[3])) $id = $path[3];
    
    //for controllers
    if (is_file(ROOT_DIR.'/application/controllers/'.$controller.'_controller.php')) {
    require_once ROOT_DIR.'/application/controllers/'.$controller.'_controller.php';
    }     
    else {
        header("HTTP/1.0 404 Not Found");
        readfile(ROOT_DIR.'/system/404.php');
        exit();
    }
    
    
    $r_controller = ucfirst($controller).'Controller';
    $controller = new $r_controller();
        
     
    //for methods: $controller->request($action);
    if (method_exists($r_controller, $action))  { 
        if (!empty($id)) {
            $controller->request($action, $id);
        }
        else {
            $controller->request($action);
        }
    }
    else {
        header("HTTP/1.0 404 Not Found");
        readfile(ROOT_DIR.'/system/404.php');
        exit();
    }
    
    
  }
  

  
    
}

?>