<?php
$this->layout('layout');
include($_SERVER['DOCUMENT_ROOT'].'/app/example/config.php');
$id = $_GET['id'];
if($id != ''){
$post->DeletePost($id);
header('location:home.php');
}else{
echo "no post found";
}

?>
