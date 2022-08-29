<?php 
$title = 'show products';
include 'template/header.php'; 
$sql ="SELECT places.id,places.name,places.pl_image,places.location, places.phone,places.Social_media,places.work_time,places.description,places.menu,category.name as categoryName
 FROM places
 INNER JOIN category ON places.category_id=category.id";
$orders = mysqli_query($conn, $sql);
if(mysqli_num_rows($orders) > 0){
    echo '
    <div class="container">
    <table class="table table-striped  table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead class="thead-light">
      <tr>
        <th scope="col">#places ID</th>
        <th scope="col">placesName </th>
        <th scope="col">places Image</th>
        
        <th scope="col">places phone</th>
        <th scope="col">places Social_media</th>
        <th scope="col">places work_time</th>
        <th scope="col">places description</th>
  
        <th scope = "col"> Category name</th>
        <th scope = "col">Action</th>
      </tr>
    </thead>
    <tbody>';
    while($row = mysqli_fetch_assoc($orders)){
            echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['name'].'</td>
            <td><img src="../'.$row['pl_image'].'" witdh="100px" height="100px"></td>
           
            <td>'.$row['phone'].'</td>
            <td>'.$row['Social_media'].'</td>
            <td>'.$row['work_time'].'</td>
            <td>'.$row['description'].'</td>
          
            <td>'.$row['categoryName'].'</td>';
            ?>

<td>
    <a href="editplaces.php?action=edit&id=<?= $row['id']?>" class="btn btn-sm btn-info">Edit</a>
    <a onclick="if(!confirm('Are you sure you want to delete?')) return false;"
        href="deletePlaces.php?action=delete&id=<?= $row['id']?>" class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>
<?php
}//endwhile
    echo "</tbody>
    </table></div>";
} else{
  echo "<div class='container'><div class='alert alert-warning'> Not found places for now!</div></div>";

}
?>

