<?php
include_once'../config.php';
$id = $_GET['id'];
if($id != ''){
$post->DeletePost($id);
header('location:posts.php');
}else{
echo "no post found";
}

?>
