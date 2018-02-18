<?php
include_once 'config.php';

if(isset($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}

if(isset($_POST['btn-postadd'])){
$title = trim($_POST['title']);
$text = trim($_POST['text']);
$author = $_SESSION['activeuser'];
$image = $_FILES['image']['name'];
$image = "/images/$image";
move_uploaded_file($_FILES['image']['tmp_name'],$image);
$invoice->AddPost($title,$text,$author,$image);
header('location:home.php');
}

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

<h3>Add Post</h3>
<div class="form">
<form method="post" enctype="multipart/form-data">
Image: <input type="file" name="image"><br>
Title: <input type="text" name="title"><br>
Text: <input type="text" name="text"><br>
<button type="submit" name="btn-postadd">Submit</button>
</form>
</div>

<div class="container">

<div class="post-list">
<?php
$list = $invoice->ViewPosts($page);
while($postRow = $list->fetch(PDO::FETCH_ASSOC)){
?>
<h3><a href="invoice.php?id=<?php echo $postRow['id']; ?>"><?php echo $postRow['title']; ?></a></h3></br>
<img src='<?php echo $postRow['image']; ?>'>
<h3><?php echo $postRow['text']; ?></h3></br>
<?php } ?>
</div>

<?php $template->SpecialPagination("invoice"); ?>

</div>

</body>
<?php $template->bootstrap_footer(); ?>
</html>
