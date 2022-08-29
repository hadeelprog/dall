<?php
// delete Errors in website
ini_set('display_errors',1);
error_reporting(E_ALL);

// Connect Databae
$conn = mysqli_connect('localhost','root','','dal');
if (!$conn){
    die ("connction Failed:" .mysqli_connect_error());
}

// Function Add favorite And Delete Favorite 
function IsUserLikeThis($place_id,$user_id){
    global $conn;
    $check = mysqli_query($conn,"SELECT * FROM favorite WHERE places_id='$place_id' AND user_id = '$user_id'");
    if ($check AND mysqli_num_rows($check) > 0) {
        echo '<a href="myFavorite.php?action=cancel&id='.$place_id.'" class="btn btn-danger btn-sm">حذف </a>';
        // return true; // Place Liked 
    }else{
        echo '<a href="addtoFavourite.php?pid='.$place_id.'" class="btn btn-primary">اضافة للمفضله</a>';
        // return false; // Place Unliked
    }
}

function success(){
    if (count($error) == 0) {
        echo '<div class= " text-center alert alert-success">The massage success</div>';
    }else{
        echo'<div class= "  text-center alert alert-danger">error </div>'; 
}}

?>