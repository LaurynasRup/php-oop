<?php
/*
  * App Core Class
  * Creates URL & loads core controller
  * URL Format - /controller/method/params
  */

class Core {
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = []; 

  public function __construct(){

    $urlArr = $this->getUrl();


    // Check if possts are in the url
    if (isset($urlArr['controller'])) {

      $controller = $urlArr['controller'];
      
      if (file_exists('../app/controllers/'. ucwords($controller) . '.php')) {
        // if exists - set as current controller
        $this->currentController = ucwords($controller);
        // unset posts
        unset($urlArr['controller']);
      }
    }

    // Require Controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // Instantiate controller class
    $this->currentController = new $this->currentController;

    // Check if second part of url is set
    if (isset($urlArr['method'])) {
      $method = $urlArr['method'];

      if (method_exists($this->currentController, $method)) {
        $this->currentMethod = $method;
        // unset method
        unset($urlArr['method']);
      }
    }

    $this->params = $urlArr ? array_values($urlArr) : [];

    // Call a callback with array values
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl(){
    $url_string = $_SERVER['QUERY_STRING'];
    parse_str($url_string, $arr);
    return $arr;
  }
}