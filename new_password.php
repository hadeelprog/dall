<?php
$title = 'New Password';
include 'template/header.php';



if (isset($_GET["token"]) && isset($_GET["email"]) && isset($_GET["action"]) 
  && ($_GET["action"]=="reset")){
  $token = $_GET["token"];
  $email = $_GET["email"];
  # Check if token and email same as db records
  $query = mysqli_query($conn,"SELECT * FROM `password_rests` WHERE `token` ='$token' and `email`='$email'");
  #check if there is match :D
  if($query AND mysqli_num_rows($query) > 0){
      # make request
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
          if(isset($_POST["pass1"]) && isset($_POST["pass2"])){
            $error="";
            $pass1 = mysqli_real_escape_string($conn,$_POST["pass1"]);
            $pass2 = mysqli_real_escape_string($conn,$_POST["pass2"]);
            if ($pass1!=$pass2){
              $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
            }
            if($error!=""){
              echo "<div class='error'>".$error."</div><br />";
            }else{
            $pass1 = md5($pass1);
            if(mysqli_query($conn,"UPDATE user SET `password`='$pass1' WHERE `email` = '$email'")):
            # delete old records after update
            mysqli_query($conn,"DELETE FROM password_rests WHERE `email`='$email' ");
            echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
            <p><a href="http://localhost/login.php">
            Click here</a> to Login.</p></div><br />';
            else:
              echo "</div class='alert alert-danger'>error while update password?</div>";
            endif;
          }		
      }
      endif; // end of request
  }else{
    die('This link is incorrect or invalid link, please reset password again');
  }

}else{
  exit('You don\'t request this page correctly!!');
}
  ?>
<br>
<form method="post">
   
    <div class="form-group">

        <div class="col">
            <input type="password" class="form-control" name="pass1" placeholder="Enter Your Password"
                require>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col">
            <input type="password" class="form-control" name="pass2" placeholder="Re-Enter New Password">
        </div>
    </div>
    <br>
    <div class="text-center">
        <div class="form-group">
            <input class="btn btn btn-warning btn-lg" type="submit" value="Rest Password">
        </div>
</form>