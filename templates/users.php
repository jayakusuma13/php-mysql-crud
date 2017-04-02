<?php
$this->layout('layout');
include($_SERVER['DOCUMENT_ROOT'].'/app/example/config.php');

if(isset($_POST['btn-register'])){
$name = trim($_POST['name']);
$pass = trim($_POST['pass']);
$user->register($name,$pass);
}

if(isset($_POST['btn-login'])){
$name = trim($_POST['name']);
$pass = trim($_POST['pass']);
$user->login($name,$pass);
}


?>

<h3>Register</h3>
<div class="form">
<form method="post" >
Name: <input type="text" name="name"><br>
Pass: <input type="text" name="pass"><br>
<button type="submit" name="btn-register">Submit</button>
</form>
</div>

<h3>Login</h3>
<div class="form">
<form method="post" >
Name: <input type="text" name="name"><br>
Pass: <input type="text" name="pass"><br>
<button type="submit" name="btn-login">Submit</button>
</form>
</div>
