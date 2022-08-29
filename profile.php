<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php
$title = 'ProFile';
include 'template/header.php';


if(!isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] !== TRUE){
    header('Location:index.php');
}


 if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] === TRUE){?>


  
    <h3 style="color:#4c7031;" class= "text-center">مرحبًا  <?=$_SESSION ['user_name']?></h3>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php }
    
    include 'template/footer.php';
    ?>
    
  