<?php
$title = 'Edit Places';
include 'template/header.php';
$placesName = $location = $places_image = $phone = $Social_media= $work_time=$description=$menu = $category_id ='';

$error = [];
?>
<?php


if (isset($_GET['action']) and $_GET['action'] === 'edit' and isset($_GET['id']) and !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql ="SELECT  places.id,places.name,places.pl_image,places.location, places.phone,places.Social_media,places.work_time,places.description,places.menu,category.name as category
    FROM places
    INNER JOIN category ON places.category_id=category.id WHERE places.id =$id";
   
    $productItem = mysqli_query($conn, $sql);
    $productFetch = mysqli_fetch_assoc($productItem);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $placesName = $_POST['placesName'];
        $location = $_POST['location'];
        $phone = $_POST['phone'];
        $Social_media = $_POST['Social_media'];
        $work_time = $_POST['work_time'];
        $description    = $_POST['description'];
        $menu = $_POST['menu'];
        $category_id = $_POST['category_id'];
            

        if(empty($placesName)){
            $error['placesNameErr'] = 'placesName required';
        }

        if(empty($location)){
            $error['locationErr'] = 'Location required';
        }
        if(empty($phone)){
            $error['phoneErr'] = 'Phone required';
        }
        if(empty($Social_media)){
            $error['Social_mediaErr'] = 'Social_media required';
        }
        if(empty($work_time)){
            $error['work_timeErr'] = 'work_time required';
        }

        if(empty($description)){
            $error['descriptionErr'] = 'description required';
        }
        if(empty($menu)){
            $error['menuErr'] = 'Menu required';
        }
        if(empty($category_id)){
            $error['category_idErr'] = 'category required';
        }


        // check if there is a file ?
        if (isset($_FILES['fileToUpload']) and $_FILES['fileToUpload']['error'] == 0):
    
        // set allowd files extensions and their MIME types
        $allowedFiles = [
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
          ];
      
        // get MIME of the uploaded file
        $fileMIMEType = mime_content_type($_FILES['fileToUpload']['tmp_name']);
        if (!in_array($fileMIMEType, $allowedFiles)):
                $error['product_imageErr'] = 'this is not allowed extension!';
        endif;
        // set max file size
        //5.242.880
        // 5 MB Max
            $maxSize  = 5 * 1048576;// 1MB = 1048576
            $fileSize = $_FILES['fileToUpload']['size'];
        if ($fileSize > $maxSize):
                $error['product_imageErr'] = 'Only files under 5MB';
        endif;
        
        endif; // end $_FILES
  
        if (count($error) == 0) {
            $placesName = mysqli_real_escape_string($conn, $placesName);
            $location = mysqli_real_escape_string($conn,$location);
            $phone = mysqli_real_escape_string($conn,$phone);
            $Social_media = mysqli_real_escape_string($conn,$Social_media);
            $work_time = mysqli_real_escape_string($conn,$work_time);
            $description =mysqli_real_escape_string($conn,$description);
            $menu = mysqli_real_escape_string($conn, $menu);
            $category_id = mysqli_real_escape_string($conn,$category_id);

            // upload
            $path = dirname(__FILE__).'/../images/places/';
            if (is_dir($path)) {
                $fileName = time().'_'.md5($_FILES['fileToUpload']['name']);
                move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path . '/' . $fileName);
            } else {
                echo '<div class="alert alert-danger">There is no directory with this name !!!</div>';
            }
            $product_image = 'images/places/'.$fileName;
 $sql = "UPDATE  places SET `name` ='$placesName',  `location` ='$location',`phone` ='$phone', `Social_media` ='$Social_media',
 `work_time`='$work_time',`description` ='$description',`menu` ='$menu', `category_id` ='$category_id'";

            if(isset($_FILES['fileToUpload']) and $_FILES['fileToUpload']['error'] == 0){
                $sql .= ",pl_image='$product_image' WHERE id='$id' ";
            }   else{
                $sql .= " WHERE id='$id'  ";
            

            } 
                    
            
            
            $insert = mysqli_query($conn, $sql);
            if ($insert) {
                echo '<div class="alert alert-success">Places has been updated </div>';
                
            
            } else {
                echo mysqli_error($conn);
                echo '<div class="alert alert-warning"> failed update places </div>';
            }// end if insert
        }// end no error if
    }// end submit if
?>
<div class="container">
    <h1> update product page</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="placesName"> PlacesName : </label>
            <input type="text" class="form-control" id="placesName" name="placesName" placeholder="placesName"
                value="<?=isset($productFetch['name']) ? $productFetch['name'] : $placesName ?>">
            <div class="text-danger"><?= isset($error['placesNameErr']) ? $error['placesNameErr'] : '' ?></div>
        </div>


            
        <div class="form-group">
            <?php if(isset($productFetch['product_image'])){
             echo "<img src='../".$productFetch['pl_imageimage']."' width='100px' height='100'>";
            }?>
            <label for="pImage"> Places image : </label>
            <input type="file" class="form-control" id="pImage" name="fileToUpload">
            <div class="text-danger"><?= isset($error['product_imageErr']) ? $error['product_imageErr'] : '' ?></div>
        </div>

      
   
        <div class="form-group">
            <label for="location"> Location : </label>
            <input type="text" class="form-control" id="location" name="location" placeholder="location"   
             value="<?=isset($productFetch['location']) ? $productFetch['location'] : $location ?>"> 

            <div class="text-danger"><?= isset($error['locationErr']) ? $error['locationErr'] : '' ?></div>

        </div>
        <div class="form-group">
            <label for="phone"> phone : </label>
            <input type="text" class="form-control" id="phone" name="phone"
                placeholder="phone"
                value="<?=isset($productFetch['phone']) ? $productFetch['phone'] : $phone ?>"> 

                <div class="text-danger"><?= isset($error['phoneErr']) ? $error['phoneErr'] : '' ?></div>

        </div>
        <div class="form-group">
            <label for="Social_media"> Social_media : </label>
            <input type="text" class="form-control" id="Social_media" name="Social_media"
                placeholder="Social_media" 
                 value="<?=isset($productFetch['Social_media']) ? $productFetch['Social_media'] : $Social_media ?>"> 

                <div class="text-danger"><?= isset($error['Social_mediaErr']) ? $error['Social_mediaErr'] : '' ?></div>

        </div>

        <div class="form-group">
            <label for="work_time">work_time : </label>
            <input type="text" class="form-control" id="work_time" name="work_time"
                placeholder="work_time"
                value="<?=isset($productFetch['work_time']) ? $productFetch['work_time'] : $work_time ?>"> 

                <div class="text-danger"><?= isset($error['work_timeErr']) ? $error['work_timeErr'] : '' ?></div>

        </div>


        <div class="form-group">
            <label for="description">description : </label>
            <input type="text" class="form-control" id="description" name="description"
                placeholder="description"
                 value="<?=isset($productFetch['description']) ? $productFetch['description'] : $description ?>"> 

                <div class="text-danger"><?= isset($error['descriptionErr']) ? $error['descriptionErr'] : '' ?></div>

          
        </div>
        <div class="form-group">
            <label for="menu"> menu : </label>
            <input type="text" class="form-control" id="menu" name="menu"
                placeholder="menu"
                value="<?=isset($productFetch['menu']) ? $productFetch['menu'] : $menu ?>"> 

                <div class="text-danger"><?= isset($error['menuErr']) ? $error['menuErr'] : '' ?></div>

        </div>

        <div class="form-group">
            <label for="category"> category : </label>
            <select name="category_id" class="form-control">
                <?php
            $cate = mysqli_query($conn,"SELECT * FROM category");
            if(mysqli_num_rows($cate)>0){
                while($row = mysqli_fetch_assoc($cate)):

            ?>
                <option value="<?= $row['id']?>"><?= $row['name']?></option>
                <?php
               endwhile;
             }
            ?>
            </select>

        </div>

    

        <div class="form-group">
            <input class="btn btn-block btn-success" type="submit" value="Edit Places">
        </div>

    </form>


</div>


<?php 
}// end if get paramters 
else{
header('Location:showplaces.php');
}?>