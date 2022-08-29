<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php
$title= "Places";
include 'template/header.php';

echo '<br><br>';

if(isset($_GET['category']) and !empty($_GET['category']) and isset($_GET['id']) and !empty($_GET['id'])){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $products = mysqli_query($conn, "SELECT * FROM places WHERE category_id='$id'");
    if(mysqli_num_rows($products)){

        echo '<div class="row">';
    
        echo '<div class="card-group">';
        while($product = mysqli_fetch_assoc($products)){
         
         echo '<div class= "col-lg-4  col-md-4 col-sm-12">';
          echo '<div class="card">
            <img src="'.$product['pl_image'].'" class= "card-img-top" >
            <div class="card-body">
              <h4 class="card-title"> '.$product['name'].'</h4>
              <p  class="card-text"> <i class="bi bi-forward"> '.$product['description'].'</i></p>
              <p  class = "card-text"> ساعات العمل: <br>'.$product['work_time'].'</p>
              <p  class = "card-text"> رقم التواصل :<br>'.$product['phone'].'</p>
              <a class ="btn btn-info" href = '.$product['Social_media'].'>وسائل التواصل </a>
              <a class ="btn btn-info" href = '.$product['menu'].'>القائمة</a>
              <a class= "btn btn-info"  href='.$product['location'].'>الموقع</a>
         
            <br>
              <br>
            ';
              if (isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] === true) {
                IsUserLikeThis($product['id'],$_SESSION['user_id']);
              }else{
                  echo '<a href="register.php" class="btn btn-warning"> التسجيل </a>';
              }
           echo'
      </div></div>
          </div>'; 
        }// end while
        echo '</div>';
     echo '</div>';
  
  
    
     include 'template/footer.php';
    }
    die();
   
}

