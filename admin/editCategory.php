<?php
$title = 'Edit category';
include 'template/header.php';
$categoryName = '';
$error = [];
?>
<?php

if (isset($_GET['action']) and $_GET['action'] === 'edit' and isset($_GET['id']) and !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $catInfo = mysqli_query($conn, "SELECT * FROM category WHERE id='$id'");
    $catFetch = mysqli_fetch_assoc($catInfo);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryName = $_POST['categoryName'];


        if (empty($categoryName)) {
            $error['categoryNameErr'] = 'category name required';
        }

        if (count($error) == 0) {
            $categoryName = mysqli_real_escape_string($conn, $categoryName);
            $upadte = mysqli_query($conn, "UPDATE category SET name = '$categoryName' WHERE id='$id'");
            if ($upadte) {
                echo '<div class = "alert alert-success">You updated category </div>';
            
                header('Location:index.php');
            } else {
                echo '<div class="alert alert-warning"> failed updating category</div>';
            }
        }
    } ?>
<div class="container">
    <h1> Update category page</h1>
    <form method="post">
        <div class="form-group">
            <label for="categoryName">category Name : </label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="categoryName"
                value="<?=isset($catFetch['name']) ? $catFetch['name'] : $categoryName ?>">
            <div class="text-danger"><?= isset($error['categoryNameErr']) ? $error['categoryNameErr'] : '' ?></div>
        </div>

        <div class="form-group">
            <input class="btn btn-block btn-success" type="submit" value="update category">
        </div>

    </form>
</div>


<?php
}else{
header('Location:showCategory.php');
}?>