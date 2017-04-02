<?php
include __DIR__ . '../vendor/autoload.php';
$collector = new Phroute\Phroute\RouteCollector();
$collector->get('/test', function(){
  return 'test 1';
});
$collector->get('/example', function(){
    return "fuck this";
});
$collector->get('/test2', function(){
});
$collector->get('/test3', function(){
});
$collector->get('/test1/{name}', function(){
});
$collector->get('/test2/{name2}', function(){
});
$collector->get('/test3/{name3}', function(){
});

echo PHP_EOL;
