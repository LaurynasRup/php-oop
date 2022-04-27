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
    if (isset($urlArr['posts'])) {

      $posts = $urlArr['posts'];
      
      if(file_exists('../app/controllers/'. ucwords($posts) . '.php')) {
        // if exists - set as current controller
        $this->currentController = ucwords($posts);
        // unset posts
        unset($urlArr['posts']);
      }
    }

    // Check if second part of url is set
    

    // Require Controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // Instantiate controller class
    $this->currentController = new $this->currentController;
  }

  public function getUrl(){
    $url_string = $_SERVER['QUERY_STRING'];
    parse_str($url_string, $arr);
    return $arr;
  }
}