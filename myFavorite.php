<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<?php
$title = 'View My favorite';
include  'template/header.php';
?>
<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<h2 class= "text-center" style="font-weight:bold;color:#4c7031;"> مفضلتي  </h2>

<br><br>
<?php
if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] === true){

    //delelation
    if(isset($_GET['action']) and $_GET['action'] === 'cancel' and isset($_GET['id'])){ 
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $user_id = $_SESSION['user_id'];
        

        $delete = mysqli_query($conn,"DELETE FROM favorite WHERE places_id ='$id' AND user_id='$user_id'");
        if($delete){
            echo '<div class="alert alert-danger" role="alert">Your item has been canceled</div>';
                header('Location:myFavorite.php');
                exit;  
        }
    }
   
    $user_id = $_SESSION['user_id'];
    $listOrders = mysqli_query($conn, "SELECT * FROM `favorite` WHERE user_id='$user_id'");
    if(mysqli_num_rows($listOrders) > 0){
        echo '<div class="row">';
 
        while($row = mysqli_fetch_assoc($listOrders)): // looping 
            $pid =$row['places_id'];
          
            $products = mysqli_query($conn, "SELECT * FROM `places` WHERE id='$pid'");
            if(mysqli_num_rows($products) >0 ){
                while($p = mysqli_fetch_assoc($products)):
                    echo '<div class="card" style="width: 18rem;">
                    <img src="'.$p['pl_image'].'" class="card-img-top">
                    <div class="card-body">
                      <h5 class="card-title"> '.$p['name'].'  </h5>
                      <p  class="card-text"> <i class="bi bi-forward"> '.$p['description'].'</i></p>
                      <p  class = "card-text"> Openning hours: <br>'.$p['work_time'].'</p>
                      <p  class = "card-text"> Phone :<br>'.$p['phone'].'</p>
                      <a class ="btn btn-info" href = '.$p['menu'].'>Menu</a>
                      <a class= "btn btn-warning"  href='.$p['location'].'>Location</a>
                      <br><br>
                    <a href="myFavorite.php?action=cancel&id='.$p['id'].'" class="btn btn-danger btn-sm">Delete </a>
                    </div>
                  </div>';         
               
                 endwhile;
            }
        endwhile;
        echo '</div>';
        

    }else{
    echo '<div class="alert alert-warning"> you have an empty Favorite</div>';
    }
}
