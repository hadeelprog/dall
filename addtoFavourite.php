<?php
$title = 'Add to my Favoite';
include 'template/header.php';

if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] === true){
    if(isset($_GET['pid']) and !empty($_GET['pid'])){
        $places_id = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT);
        $user_id =$_SESSION['user_id'];
        // check if place exists
        $check = mysqli_query($conn,"SELECT * FROM favorite WHERE places_id='$places_id' AND user_id = '$user_id'");
        if ($check AND mysqli_num_rows($check) > 0) {
            die('<div class="alert alert-primary" role="alert">this place already in ur favorite!</div>');
            
        }
        
        // add new place to fav
        $orders = mysqli_query($conn, "INSERT INTO `favorite` SET user_id = '$user_id', `places_id` = '$places_id'");
        if($orders){
            echo '<div class="alert alert-success" role="alert">The Item has Been add</div>';
   
        }
    }

}


