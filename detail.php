<?php 
include_once'config.php';
$id = $_GET['id'];

if(isset($_POST['addtocart'])){
$cart->additem($id);

}

//$cart->showitems();

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

<div class="container">

<div class="post-list">
<?php 
$list = $post->ViewPostsDetail($id);
while($postRow = $list->fetch(PDO::FETCH_ASSOC)){
?>
<h3><a href="detail.php?id=<?php echo $postRow['id']; ?>"><?php echo $postRow['title']; ?></a></h3></br>
<img src='<?php echo $postRow['image']; ?>'>
<h3><?php echo $postRow['text']; ?></h3></br>
<form method="post">
<button type="submit" name="edit"><a href="edit.php?id=<?php echo $postRow['id']; ?>">Edit</a></button>

<button type="submit" name="delete"><a href="delete.php?id=<?php echo $postRow['id']; ?>">Delete</a></button>

<button type="submit" name="addtocart">AddtoCart</button>
<a href="edit.php?id=<?php echo $postRow['id']; ?>">Edit</a>

</form>
<?php } ?>


</div>

</div>

</body>
<?php $template->bootstrap_footer(); ?>
</html>
