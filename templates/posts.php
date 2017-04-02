<?php
$this->layout('layout');
include('config.php');

if(isset($_POST['btn-postadd'])){
$title = trim($_POST['title']);
$text = trim($_POST['text']);
$author = $_SESSION['activeuser'];
$image = $_FILES['image']['name'];
$image = "/images/$image";
move_uploaded_file($_FILES['image']['tmp_name'],$image);
$post->AddPost($title,$text,$author,$image);
header('location:home.php');
}

?>

<h3>Add Post</h3>
<div class="form">
<form method="post" enctype="multipart/form-data">
Image: <input type="file" name="image"><br>
Title: <input type="text" name="title"><br>
Text: <input type="text" name="text"><br>
<button type="submit" name="btn-postadd">Submit</button>
</form>
</div>
