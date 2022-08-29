<?php
$title = 'Add new category';
include 'template/header.php';
// var_dump(is_dir(dirname(__FILE__).DIRECTORY_SEPARATOR.'images'));
$categoryName =  $category_images = '';

$error = [];
?>

<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
$categoryName = $_POST['name'];


if(empty($categoryName)){
    $error['categoryNameErr'] = 'category name required';
}

// check if there is a file ?
if(isset($_FILES['fileToUpload']) and $_FILES['fileToUpload']['error'] == 0):
    
    // set allowd files extensions and their MIME types
    $allowedFiles = [
    
        'svg' => 'image/svg+xml',
      
      ];
  
    // get MIME of the uploaded file
    $fileMIMEType = mime_content_type($_FILES['fileToUpload']['tmp_name']);
        if(!in_array($fileMIMEType,$allowedFiles)):
            $error['category_imageErr'] = 'this is not allowed extension!';
        endif;
        // set max file size
        $maxSize  = 5 * 1048576;// 1MB = 1048576
        $fileSize = $_FILES['fileToUpload']['size'];
        if($fileSize > $maxSize ):
            $error['category_imageErr'] = 'Only files under 5MB';
        endif;
    
endif; // end $_FILES

if (count($error) == 0) {
    
   
    // upload
    $path = dirname(__FILE__).'/../images/';// folder for svg
    if (is_dir($path)) {
        $fileName = time().'_'.$_FILES['fileToUpload']['name'];
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path . '/' . $fileName);
    }else{
        echo '<div class="alert alert-danger">There is no directory with this name !!!</div>';
    }
    $category_images = 'images/'.$fileName;// for databnases



    if (count($error) == 0) {
        $categoryName = mysqli_real_escape_string($conn, $categoryName);

       $insert = mysqli_query($conn, "INSERT INTO category SET   name= '$categoryName',cat_image='$category_images'");
        if($insert){
            $last_id = mysqli_insert_id($conn);
                echo '<div class = "alert alert-success"> You add a new category</div> ';
         //  header('Location:index.php');
           
        }else{
            echo '<div class="alert alert-warning"> failed adding category</div>';

        }
    }
}
}
?>


<div class="container">
    <h1 class= "text_center"> Add New category page</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categoryName">category Name : </label>
            <input type="text" class="form-control" id="categoryName" name="name" placeholder="categoryName"
                value="<?=isset($categoryName) ? $categoryName : '' ?>">
                
            <div class="text-danger"><?= isset($error['categoryNameErr']) ? $error['categoryNameErr'] : '' ?></div>
        </div>
        <div class="form-group">
            <label for="Cat_Image"> Plases image : </label>
            <input type="file" class="form-control" id="Cat_Image" name="fileToUpload" required>
        </div>

        <div class="form-group">
        <div class="text-danger"><?= isset($error['category_imageErr']) ? $error['category_imageErr'] : '' ?></div>

            <input class="btn btn-block btn-success" type="submit" value="Add category">
        </div>

    </form>
</div>