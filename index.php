<?php
$title = 'Home';
include 'template/header.php';?>
<html>
 <body style="background-color:#F9f8EF;"> </body>
 </html>
<br><br>
<br> <br>
 <h2 class= "text-center" style="font-weight:bold;color:#4C7031;">الفئات   </h2>
 <br> <br>

<?php
$result = mysqli_query($conn,"SELECT * FROM category");


// show all categories
if(mysqli_num_rows($result)){
    echo "<div class = 'row'>";
  while($row = mysqli_fetch_assoc($result)) { //loop
  
    echo "<div class = 'col'>";
    echo "<a class='btn btn-secondary btn-sm m-2  rounded-circle '  href='places.php?category=".$row['name']."&id=".$row['id']."'> ".$row['name'].file_get_contents($row['cat_image'])." </a>" ;

       echo '</div>
        ';
      }
     echo "</div>";
     echo "</div>";
}
?>
<br> <br>
<br> <br>
 <h2 class= "text-center" style="font-weight:bold;color:#4C7031;"> الأماكن الحديثة </h2>
 <?php
 echo '<br><br>';
$news = mysqli_query($conn, "SELECT * FROM places ORDER BY `id`  DESC LIMIT 5"); 
if(mysqli_num_rows($news)){
  echo '<div class="container">';
echo '<div class="row">';
  echo '<div class="card-group">';
  while($new = mysqli_fetch_assoc($news)){
      echo '<div class="card">
     <img src="'.$new['pl_image'].'" class="card-img-top">
      <div class="card-body">
        <h4 class="card-title"> '.$new['name'].'</h4>
        <p  class="card-text"> <i class="bi bi-forward"> '.$new['description'].'</i></p>
   
      <br>
        <br>
      ';

     echo' </div>
    </div>';
  }// end while
  echo '</div>';
  echo '</div>';

}


include 'template/footer.php';

/* file_get_contents
Contents of the file 
        
*/
