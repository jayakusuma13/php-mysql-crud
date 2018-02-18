
<?php
include($_SERVER['DOCUMENT_ROOT'].'/config.php');
$query = mysql_real_escape_string($_GET['query']);
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
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

<div class="row">


    <?php
    $list = $post->SearchPost($query,$page);
    $count = $list->rowCount();
    if($count == 0){
      echo "no results";
    }
    while($postRow = $list->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
    <h3>
      <a href="detail?id=<?php echo $postRow['id']; ?>">
        <?php echo $postRow['title']; ?>
      </a>
    </h3></br>
    <img src='<?php echo $postRow['image']; ?>'>
    <div class="caption">
    <p>
        <?php
        //show excrept
        $text = $postRow['text'];
        $post->truncate($text, 150);
        ?>
      </p></br>
    <p>
      <a href="detail?id=<?php echo $postRow['id']; ?>"
        class="btn btn-primary" role="button">Read More..
      </a>
    </p>
    </div>
    </div>
    </div>
    <?php }
    ?>
</div>

<?php $template->SearchPagination($query); ?>

</body>
<?php $template->bootstrap(); ?>
</html>
