<?php 
$title = 'show categories';
include 'template/header.php'; 
$sql ="SELECT * FROM category";
$category = mysqli_query($conn, $sql);
if(mysqli_num_rows($category) > 0){
    echo '
    <div class="container">
    <table class="table display" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-light">
      <tr>
        <th scope="col">#Category ID</th>
        <th scope="col">Category Name </th>
       
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>';
    while($row = mysqli_fetch_assoc($category)){
            echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['name'].'</td>';
           

            ?>

<td>
    <a href="editCategory.php?action=edit&id=<?= $row['id']?>" class="btn btn-sm btn-info">Edit</a>
    <a onclick="if(!confirm('Are you sure you want to delete?')) return false;"
        href="deleteCategory.php?action=delete&id=<?= $row['id']?>" class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>
<?php
}//endwhile
echo "</tbody>
</table>
</div>";
}
?>

