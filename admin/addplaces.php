<?php
$title = 'Add new products';
include 'template/header.php';
$placesName = $location = $places_image = $phone = $Social_media= $work_time=$description=$menu = $category_id ='';
$error = [];
?>
<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$placesName = $_POST['productName'];

$location = $_POST['location'];
$phone = $_POST['phone'];
$Social_media = $_POST['Social_media'];
$work_time = $_POST['work_time'];
$description =$_POST['description'];
$menu = $_POST['menu'];
$category_id    = $_POST['category_id'];


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
if(isset($_FILES['fileToUpload']) and $_FILES['fileToUpload']['error'] == 0):
 
        // set allowd files extensions and their MIME types
        $allowedFiles = [
            'jpg' => 'image/jpeg',
            'png' => 'image/png',

          ];
      
        // get MIME of the uploaded file
        $fileMIMEType = mime_content_type($_FILES['fileToUpload']['tmp_name']);
            if(!in_array($fileMIMEType,$allowedFiles)):
                $error['places_imageErr'] = 'this is not allowed extension!';
            endif;
            // set max file size
            
            $maxSize  = 5 * 1048576;// 1MB = 1048576
            $fileSize = $_FILES['fileToUpload']['size'];
            if($fileSize > $maxSize ):
                $error['places_imageErr'] = 'Only files under 5MB';
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
        
        // upload
        $path = dirname(__FILE__).'/../images/places/'; 
        if (is_dir($path)) {
            $fileName = time().'_'.$_FILES['fileToUpload']['name'];
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path . '/' . $fileName); // Move File (Image) $path
        }else{
            echo '<div class="alert alert-danger">There is no directory with this name !!!</div>';
        }
        $places_image = 'images/places/'.$fileName; // database 
        $sql = "INSERT INTO places SET `name` ='$placesName',pl_image='$places_image', `location` ='$location',`phone` ='$phone', `Social_media` ='$Social_media',`work_time`='$work_time',`description` ='$description',`menu` ='$menu', `category_id` ='$category_id'";
        $insert = mysqli_query($conn, $sql);
        if($insert){
            echo '<div class = "alert alert-success">places has been Add </div>';
           
           
        }else{
            // echo mysqli_error($conn);
            echo '<div class="alert alert-warning"> failed adding product  </div>';

      }// end if insert
  
    }

    // end no error if
   
}
// end submit if


?>
    <br><br>
<div class="container">
    <br><br>
    <h1 class="text-center"> add new Places page</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="productName"> Places Name : </label>
     <input type="text" class="form-control" id="productName" name="productName" placeholder="placeName">
            <div class="text-danger"><?= isset($error['placesNameErr']) ? $error['placesNameErr'] : '' ?></div>
        </div>
        
        <div class="form-group">
            <label for="pImage"> place image : </label>
            <input type="file" class="form-control" id="pImage" name="fileToUpload" required>
            <div class="text-danger"><?= isset($error['places_imageErr']) ? $error['places_imageErr'] : '' ?></div>

           </div>
        </div>
        <div class="form-group">
            <label for="location"> Location : </label>
            <input type="text" class="form-control" id="location" name="location" placeholder="location" >
            <div class="text-danger"><?= isset($error['locationErr']) ? $error['locationErr'] : '' ?></div>

        </div>
        <div class="form-group">
            <label for="phone"> phone : </label>
            <input type="text" class="form-control" id="phone" name="phone"
                placeholder="phone" >
                <div class="text-danger"><?= isset($error['phoneErr']) ? $error['phoneErr'] : '' ?></div>

        </div>
        <div class="form-group">
            <label for="Social_media"> Social_media : </label>
            <input type="text" class="form-control" id="Social_media" name="Social_media"
                placeholder="Social_media">
                <div class="text-danger"><?= isset($error['Social_mediaErr']) ? $error['Social_mediaErr'] : '' ?></div>

        </div>

        <div class="form-group">
            <label for="work_time">work_time : </label>
            <input type="text" class="form-control" id="work_time" name="work_time"
                placeholder="work_time">
                <div class="text-danger"><?= isset($error['work_timeErr']) ? $error['work_timeErr'] : '' ?></div>

        </div>


        <div class="form-group">
            <label for="description">description : </label>
            <input type="text" class="form-control" id="description" name="description"
                placeholder="description">
                <div class="text-danger"><?= isset($error['descriptionErr']) ? $error['descriptionErr'] : '' ?></div>

          
        </div>
        <div class="form-group">
            <label for="menu"> menu : </label>
            <input type="text" class="form-control" id="menu" name="menu"
                placeholder="menu">
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
            <input class="btn btn-block btn-success" type="submit" value="add Places">
        </div>

    </form>


</div>


