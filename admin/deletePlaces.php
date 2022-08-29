<?php

$title = 'Delete places';
include 'template/header.php';

if (isset($_GET['action']) and $_GET['action'] === 'delete' and isset($_GET['id']) and !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $del = mysqli_query($conn, "DELETE FROM places WHERE id='$id'");
    if($del){
        echo "<div class='alert alert-success'> places has been Deleted successfully</div></div>";

    }else{
        // echo mysqli_error($conn);
        echo "<div class='container'><div class='alert alert-warning'>failed delete places</div></div>";
    }
}else{
    header('Location:showProduct.php');
}
