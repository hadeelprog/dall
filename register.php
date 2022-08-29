<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php
$title = "Register";
include 'template/header.php';?>
<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php

$username = $email = $password ='';
$error = [];
?>
<?php
if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] === TRUE){
    header('Location:index.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$username = $_POST['username'];
$email    = $_POST['email'];
$password = $_POST['password'];


if(empty($username)){
    $error['usernameErr'] = '<div class = "alert alert-danger">User Name Required</div>';
}

if(empty($password)){
    $error['passwordErr'] = '<div class = "alert alert-danger"> Password Required</div>';
}


if(empty($email)){
    $error['emailErr'] = '<div class = "alert alert-danger">email Required</div>';
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $error['emailErr'] = '<div class = "alert alert-danger">your email invalid</div>';
}
    if (count($error) == 0) {
        $username = mysqli_real_escape_string($conn, $username);
        $password = md5($password);
        $email = mysqli_real_escape_string($conn, $email);
        $insert = mysqli_query($conn, "INSERT INTO user SET username = '$username' , email = '$email' , password = '$password'");
        if($insert){
            $last_id = mysqli_insert_id($conn);
            $_SESSION['loggedIn'] =true;
            $_SESSION['user_id'] = $last_id;
           header('Location:index.php');
        }else{
            echo '<div class="alert alert-warning"> Register error</div>';

        }
    }
}
?>


<div class = "text-center">
    <img src="images/DALL.svg"width="150px">
</div>
<form method="post" >
    <div class="form-group">

    <div class="col">
        <input type="text" class="form-control" id="username" name="username" placeholder=" Your User Name" require
            value="<?=isset($username) ? $username : '' ?>">
        <div class="text-danger"><?= isset($error['usernameErr']) ? $error['usernameErr'] : '' ?></div>
    </div></div>
    <br>
    <div class="form-group">

<div class="col">
    <input type="text" class="form-control" id="email" name="email" placeholder="Your Email" require
        value="<?=isset($email) ? $email : '' ?>">
    <div class="text-danger"><?= isset($error['emailErr']) ? $error['emailErr'] : '' ?></div>
</div></div>
    <br>
    <div class="form-group">
    <div class="col">
        <input type="password" class="form-control" id="password" name="password" placeholder=" Your password">
        <div class="text-danger"><?= isset($error['passwordErr']) ? $error['passwordErr'] : '' ?></div>
    </div></div>
    <br>
    <div class="text-center">
    <div class="form-group">
        <input class="btn btn btn-warning btn-lg" style="font-weight:bold;color:#4C7031;" type="submit" value="التسجيل">
        </div> 
    </div>

<br>
</form>

<?php 
echo '<br>';
include 'template/footer.php';?>