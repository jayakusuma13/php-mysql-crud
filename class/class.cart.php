<?php

class Cart{
public $items;
private $db;

public function __construct($dbconn){
$this->db = $dbconn;
}

public function showitems(){
foreach($_SESSION['items'] as $x){
echo $x."</br>";
}
}

public function additem($id){
$stmt = $this->db->prepare("select * from posts where id = :id");
$stmt->bindparam(":id",$id);
$stmt->execute();
$postRow = $stmt->fetch(PDO::FETCH_ASSOC);
if($postRow != 0){
$_SESSION['items'][] = $postRow['title'];
}else{
echo "this product does not exist";
}
}

public function delete(){
session_destroy();
unset($_SESSION['items']);
return True;
}

}

?>
