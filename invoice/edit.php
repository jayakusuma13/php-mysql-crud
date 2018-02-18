<?php
include_once'../config.php';
$id = $_GET['id'];

if(isset($_POST['btn-edit'])){
$id = $_GET['id'];
$title = trim($_POST['title']);
$text = trim($_POST['text']);
$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],$image);
$invoice->EditPost($id,$title,$text,$image);
header('location:detail.php?id='.$id);
}

$sql = $invoice->ViewPostsDetail($id);
$post = $sql->fetch(PDO::FETCH_ASSOC);
?>

<html>
<head>
<?php $template->bootstrap(); ?>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
<div class="container-fluid">
<?php $template->menu(); ?>
</div>
</nav>

<h3>Edit</h3>
<div class="form">
<form method="post" enctype="multipart/form-data">
Image: <input type="file" name="image" value="<?php echo $post['image']; ?>"><br>
Title: <input type="text" name="title" value="<?php echo $post['title']; ?>"><br>
Text: <input type="text" name="text" value="<?php echo $post['text']; ?>"><br>
<button type="submit" name="btn-edit">Finish</button>
</form>
</div>

</body>
<?php $template->bootstrap(); ?>
</html>
