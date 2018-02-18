<?php
include_once'../config.php';
$id = $_GET['id'];
if($id != ''){
$invoice->DeletePost($id);
header('location:invoice.php');
}else{
echo "no post found";
}

?>
