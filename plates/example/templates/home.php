<?php
include_once 'config.php';
if(isset($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
?>

<div class="container">

<div class="post-list">
<?php
$list = $post->ViewPosts($page);
while($postRow = $list->fetch(PDO::FETCH_ASSOC)){
?>
<h3><a href="detail.php?id=<?php echo $postRow['id']; ?>"><?php echo $postRow['title']; ?></a></h3></br>
<img src='<?php echo $postRow['image']; ?>'>
<h3><?php echo $postRow['text']; ?></h3></br>
<?php } ?>
</div>

<?php $template->pagination(); ?>
