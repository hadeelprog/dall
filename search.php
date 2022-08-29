<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php
$title = 'Search';
include 'template/header.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'):
    $search = mysqli_real_escape_string($conn,$_POST["search"]);
    $result = mysqli_query($conn,"SELECT * FROM places WHERE name LIKE '%$search%'");
    if($_POST['search'] != '' AND $result AND mysqli_num_rows($result) > 0){
      echo '<br><br>';
        echo '<div class="row">';
        echo '<div class="card-group">';
        
        while($place = mysqli_fetch_assoc($result)){
            echo '<div class="card">
            <img src="'.$place['pl_image'].'" class="card-img-top">
            <div class="card-body">
              <h4 class="card-title"> '.$place['name'].'</h4>
              <p  class="card-text"> <i class="bi bi-forward"> '.$place['description'].'</i></p>
              <p  class = "card-text"> Openning hours: <br>'.$place['work_time'].'</p>
              <p  class = "card-text"> Phone :<br>'.$place['phone'].'</p>
              <a class ="btn btn-info" href = '.$place['menu'].'>Menu</a>
              <a class= "btn btn-warning"  href='.$place['location'].'>Location</a>
            ';
              if (isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] === true) {
                IsUserLikeThis($place['id'],$_SESSION['user_id']);
              }else{
                  echo '<a href="register.php" class="btn btn-primary">Register here</a>';
              }
           echo' </div>
          </div>';
        }// end while
        echo '</div>';
        echo '</div>';
    }else{
        echo "<div class='alert alert-warning'>Noting matching your search!</div>";    
    }
else:
    // Here you should redirect users to home page;
    header('location:index.php');
    exit;
endif;
?>

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
<?php 
# fix your footer before uncomment this
include 'template/footer.php';?>