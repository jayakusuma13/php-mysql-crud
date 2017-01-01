<?php 

class User{
private $db;

function __construct($dbconn){
$this->db = $dbconn;
}

public function register($name,$pass){
$stmt = $this->db->prepare("insert into users (username,password) values ($name,$pass)");
$stmt->bindparam(":name",$name);
$stmt->bindparam(":pass",$pass);
$stmt->execute();
return $stmt;
}

public function login($name,$pass){
$stmt = $this->db->prepare("select * from users where username = :name limit 1");
$stmt->execute(array(':name'=>$name));
$stmt->bindparam(":pass",$pass);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
if($userRow > 0){
if($pass == $userRow['password']){
$_SESSION['activeuser']=$userRow['username'];
}else{
	echo "wrong password or username ";
}
	}
}

public function is_loggedin(){
if(isset($_SESSION['activeuser'])){
return True;
}
}

public function logout(){
session_destroy();
unset($_SESSION['activeuser']);
return True;
}

public function redirect($url){
header('location:$url');
}

}

?>
