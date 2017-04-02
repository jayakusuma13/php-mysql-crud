<?php

if(isset($_GET['url'])){
  echo $_GET['url'];
  $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
};

$controller = 'home';

if(file_exists($url[0].'.php')){
  $controller = $url[0];
  unset($url[0]);
}

require_once ($controller.'.php');

if(isset($url[1])){
  if(method_exists($controller, $url[1])){
    $method = $url[1];
    unset($url[1]);
  }
};

$params = array_values($url);
 ?>
