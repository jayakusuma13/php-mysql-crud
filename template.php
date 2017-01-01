<?php 
include_once'config.php';

class Template{

private $db;

function __construct($dbconn){
$this->db = $dbconn;
}

public function menu(){
global $cart;
?>
<div>
<ul class="nav navbar-nav">
<li><a href="home.php">Home</a></li>
<li><a href="users.php">Login/Register</a></li>
<li><a href="posts.php">Add Post</a></li>
</ul>
</div>

<div class="navbar-right">
<ul class="nav navbar-nav navbar-right"><li>
<li><?php if(isset($_SESSION['activeuser'])){echo $_SESSION['activeuser'];  ?></li><br>
<li><form method="post">
<button type="submit" name="logout">Logout</button>
</form></li>
<?php } ?>
<li><?php if(isset($_SESSION['items'])){ 
$cart->showitems();  ?></li><br>
<li><form method="post">
<button type="submit" name="emptycart">Empty Cart</button>
</form></li>
<?php } ?>

</ul>

</div>
<?php
} 

public function Pagination(){
$post_limit = 3;

$sql = $this->db->prepare("select * from posts");
$sql->execute();
$fetch = $sql->fetchAll();
$numRows = $sql->rowCount();
$pages = ceil($numRows/$post_limit);

if(isset($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}


$start_from = $post_limit*($page-1);
$end_at = $pages;
$stmt = $this->db->prepare("select * from posts limit $start_from,$post_limit");
$stmt->execute();
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination">';
if($page>2){
echo "<li><a href=home.php?page=1>1</a></li>";
echo "<li><span>...</span></li>";
}

if($page<3){
for($i=1; $i<=($page+2); $i++){
$active = $i == $page ? 'class="active"' : '';
echo "<li $active><a href=home.php?page=".$i.">".$i."</a></li>";
}
}elseif($page>=($pages-2)){
for($i=($page-2); $i<=$pages; $i++){
$active = $i == $page ? 'class="active"' : '';
echo "<li $active><a href=home.php?page=".$i.">".$i."</a></li>";
}
}else{
for($i=($page-2); $i<=($page+2); $i++){
$active = $i == $page ? 'class="active"' : '';
echo "<li $active><a href=home.php?page=".$i.">".$i."</a></li>";
}
}

if($page < ($end_at-1)){
echo "<li><span>...</span></li>";
echo "<li><a href=home.php?page=".$pages.">".$pages."</a></li>";
}
echo "</ul>";
echo '</nav>';
}

public function bootstrap(){
echo '<meta charset="utf-8">
    <title>Basic Bootstrap Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
}

public function bootstrap_footer(){
echo '<meta charset="utf-8">
    <title>Basic Bootstrap Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
}

}
?>
