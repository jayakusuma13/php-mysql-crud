<?php
include_once'config.php';

class Post{

private $db;

function __construct($dbconn){
$this->db = $dbconn;
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

public function AddPost($title,$text,$author,$image){
$stmt = $this->db->prepare("INSERT INTO posts (title,text,user,image) VALUES (:title,:text,:author,:image)");
$stmt->bindparam(":title",$title);
$stmt->bindparam(":text",$text);
$stmt->bindparam(":author",$author);
$stmt->bindparam(":image",$image);
$stmt->execute();
return $stmt;
}

public function EditPost($id,$title,$text,$image){
$stmt = $this->db->prepare("UPDATE posts SET title=:title,text=:text,image=:image WHERE id=:id");
$stmt->bindparam(":title",$title);
$stmt->bindparam(":text",$text);
$stmt->bindparam(":id",$id);
$stmt->bindparam(":image",$image);
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
