<?php 
session_start();
$dbhost = 'localhost';
$db = 'test';
$name = 'root';
$pass = '';

try{
$dbconn = new PDO ("mysql:host={$dbhost};dbname={$db}",$name,$pass);
}
catch(PDOException $e){
echo $e->getMessage();
}
include_once'class/class.user.php';
include_once'class/class.post.php';
include_once'class/class.cart.php';
include_once'template.php';

$user = new User($dbconn);
$post = new Post($dbconn);
$cart = new Cart($dbconn);
$template = new Template($dbconn);

if(isset($_POST['logout'])){
$user->logout();
}

if(isset($_POST['emptycart'])){
$cart->delete();
}

?>

