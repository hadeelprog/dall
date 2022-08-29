<?php

$title = 'Delete category';;
include 'template/header.php';

if (isset($_GET['action']) and $_GET['action'] === 'delete' and isset($_GET['id']) and !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $del = mysqli_query($conn, "DELETE FROM category WHERE id='$id'");
    if($del){
        echo '<div class = "alert alert-success">Category has been Deleted successfully</div>';
       header('Location:index.php');
        
    }else{
        // echo mysqli_error($conn);
        echo "<div class='container'><div class='alert alert-warning'> you cannot delete this category , because you have uncompeleted order contain this category, remove the order to remove it.</div></div>";
    }
}else{
    header('Location:showCategory.php');

}

include 'template/footer.php';