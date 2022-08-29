<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php
$title = 'LogIn';
include 'template/header.php';?>
<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php

if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn']=== TRUE){
  header('Location:index.php');
}
if($_SERVER['REQUEST_METHOD']=='POST'){
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = md5($_POST['password']);
  $login = mysqli_query($conn,"SELECT id FROM user WHERE username='$username' and `password`='$password'");
  if(mysqli_num_rows($login)==1){
    $id = mysqli_fetch_assoc($login)['id'];
    $_SESSION['loggedIn']=TRUE;
    $_SESSION['user_id']=$id;
    $_SESSION['user_name']=$username;
    
    header('Location:index.php');

  }else{
    echo '<div class="alert alert-danger" role="alert"> User Name Or Password Is Wrong!</div>';
  }
}



?>

<div class = "text-center">
    <img src="images/DALL.svg"width="150px">
</div>
<form method="post">
    <div class="form-group">

    <div class="col">
    <input type="text" class="form-control" id="username" name="username" placeholder="username" require>
       
    </div></div>
    <br>
    <div class="form-group">
    <div class="col">
        <input type="password" class="form-control" id="password" name="password" placeholder="password">
    </div></div>
    <br>
    <div class="text-center">
    <div class="form-group">
        <input class="btn btn btn-warning btn-lg" type="submit" value="تسجيل الدخول">
        </div>
      <a href = "forget_password.php"> نسيت كلمة المرور</a>
      
    </div>
</form>
<br> <br>
<?php

include 'template/footer.php';?>