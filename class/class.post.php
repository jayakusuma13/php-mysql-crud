<?php
include_once __DIR__.'/../config.php';

class Post{

private $db;

function __construct($dbconn){
$this->db = $dbconn;
}

public function truncate($text, $vars){
  if(strlen($text) > $vars){
    $text = substr($text, 0, $vars);
    $text = substr($text, 0, strrpos($text," "));
    $etc = "...";
    $text = $text.$etc;
  }
  echo $text;
}

public function ViewPosts($page){
$post_limit = 3;

$sql = $this->db->prepare("select * from posts");
$sql->execute();
$fetch = $sql->fetchAll();
$numRows = $sql->rowCount();
$pages = ceil($numRows/$post_limit);

if(isset($page)){
$page = $page;
}else{
$page = 1;
}

$start_from = ($page-1)*$post_limit;
$stmt = $this->db->prepare("select * from posts limit $start_from,$post_limit");
$stmt->execute();
return $stmt;

}

public function ViewPostsDetail($id){
$stmt = $this->db->prepare("select * from posts WHERE id = :id");
$stmt->bindparam(":id",$id);
$stmt->execute();
return $stmt;
}

public function SearchPost($query,$page){
  $post_limit = 6;

  $stmt = $this->db->prepare("SELECT * FROM `posts`
    WHERE `title` LIKE concat('%', :query, '%') ");
  $stmt->bindValue(':query','%'.$query.'%');
  $stmt->execute();
  $fetch = $stmt->fetchAll();
  $numRows = $stmt->rowCount();
  $pages = ceil($numRows/$post_limit);

  if(isset($page)){
    $page = $page;
  }else{
    $page = 1;
  }

  $start_from = ($page-1)*$post_limit;
  $sql = $this->db->prepare("SELECT * FROM `posts`
    WHERE `title` LIKE concat('%', :query, '%')
  limit $start_from,$post_limit");
  $sql->bindValue(':query','%'.$query.'%');
  $sql->execute();
  return $sql;
}

public function AddPost($title,$text,$author,$image){
$stmt = $this->db->prepare("INSERT INTO posts (title,text,user,image) VALUES ('$title','$text','$author','$image')");
$stmt->execute();
return $stmt;
}

public function EditPost($id,$title,$text,$image){
$stmt = $this->db->prepare("UPDATE posts SET title='$title',text='$text',image='$image' WHERE id='$id'");
$stmt->execute();
return $stmt;
}

public function DeletePost($id){
$stmt = $this->db->prepare("DELETE FROM posts WHERE id=:id");
$stmt->bindparam(":id",$id);
$stmt->execute();
return $stmt;
}
}
?>
