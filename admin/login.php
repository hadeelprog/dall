<?php
include 'template/header.php';?>
<?php

if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn']=== TRUE){
  header('Location:index.php');
}
if($_SERVER['REQUEST_METHOD']=='POST'){
// INSERT INTO user set user
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = md5($_POST['password']);
  $login = mysqli_query($conn,"SELECT id FROM admin WHERE username='$username' and `password`='$password'");
  if(mysqli_num_rows($login)==1){
    $id = mysqli_fetch_assoc($login)['id'];
    $_SESSION['loggedIn']=TRUE;
    $_SESSION['user_name']=$username;
    
    header('Location:index.php');

  }else{
    echo '<div class="alert alert-danger" role="alert"> User Name Or Password Is Wrong!</div>';
  }
}



?>
<br><br>
<div class = "text-center">
    <img src="images/logo2.svg"width="150px">
</div>
<form method="get" >
    <div class="form-group">

    <div class="col">
        <input type="text" class="form-control" id="username" name="username" placeholder="username" require
            value="<?=isset($username) ? $username : '' ?>">
        <div class="text-danger"><?= isset($error['usernameErr']) ? $error['usernameErr'] : '' ?></div>
    </div></div>
    <br>
    <div class="form-group">
    <div class="col">
        <input type="password" class="form-control" id="password" name="password" placeholder="password">
        <div class="text-danger"><?= isset($error['passwordErr']) ? $error['passwordErr'] : '' ?></div>
    </div></div>
    <br>
    <div class="text-center">
    <div class="form-group">
        <input class="btn btn btn-warning btn-lg" type="submit" value="LOGIN">
        </div>
      <a href = "forget_password.php"> Forget Password</a>
    </div>


</form>
