<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php
$title = 'Forget Password';
include 'template/header.php';
include 'PHPmailer.php';
$error =[];
?>


<?php
if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] === TRUE){
    header('Location:index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT email FROM user WHERE email='$email'";
    $results = mysqli_query($conn, $sql);
    if (empty($_POST['email'])) {
        $error['emailErr'] = "email is required";
    }elseif(mysqli_num_rows($results) <= 0) {
        $error['emailErr'] = "wrong email address";
    }
    // generate a unique random token of length 100
    $token = bin2hex(random_bytes(50));
  
    if (count($error) == 0) {
        //password_rests
      // store token in the password-reset database table against the user's email
      $query = "INSERT INTO password_rests(email, token) VALUES ('$email', '$token')";
      $results = mysqli_query($conn, $query);
  if($results){
    $msg  = "Reset your password <br>";
    $msg .= "Your username is : $username<br>";
    $msg .= "Your Email is : $email<br>";
    $msg .= "Please update your information <br>";
    $msg .="Hi there, click on this <a href='http://localhost/dal/new_password.php?action=reset&token=". $token . "&email=".$email."'>link</a> to reset your password on our site";
    $msg .= "DAL Project";
    
    SendMailUsingPHPMailer("Dal  New Password",$email,$msg);
      echo "<div class='alert alert-primary'> All Good, Check your email address</div>";
     
      header('Location:login.php');
  }
    
    }
    
}
  ?>
  <br><br>

  
<form method="post" name = "reset">
    <h2 class= "text-center" style="font-weight:bold;color:#4C7031;">  إعادة تعيين كلمة المرور </h2>
    <div class="form-group">
    <div class="text-danger"><?= isset($error['emailErr']) ? $error['emailErr'] : '' ?></div>
        <label class= "text-center">Your email address</label>
        <input class="form-control" type="email" name="email" name="email">
       
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-md btn-warning" style="font-weight:bold;color:#4C7031;" >إعادة تعيين كلمة المرور</button>
    </div>
</form>


