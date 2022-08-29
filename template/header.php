<?php
session_start();
include 'inc/db.php';

  ?>

<!doctype html>
<html lang="en">
  
 <head>
  <title>DALL <?= " ".$title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel ="icon" href="images/logo2.svg">
    <link rel="stylesheet" href="template/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

</head>
  
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-beige">
    <img src="images/DALL.svg"  width="100px" alt="">
   
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto topnav">
          
            <li class="nav-item active">
   <a class="nav-link" href="index.php" style="font-weight:bold;color:#4C7031;"> <i class="bi bi-house-door">الرئيسية  </i> </a>
                </li>
<?php if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn']===TRUE):?>
           
  
  <li class="nav-item active">
   <a class="nav-link" href="profile.php" style="font-weight:bold; color:#4C7031;"><i class="bi bi-person-fill"> الملف </i> </a>
                </li>
               
              
  <li class="nav-item active">
   <a class="nav-link" href="myFavorite.php" style="font-weight:bold; color:#4C7031;"> المفضلة </a>
                </li>
               
              
                <li class="nav-item">
                    <a class="btn btn-warning text-white" id="btn" type="button" href="logout.php" style="font-weight:bold;color:#4C7031;" >تسجيل الخروج </a>
                </li>
                <?php else: ?>
               
                <li class="nav-item">
       <a class=" btn btn-warning mr-2 "type="button" href="login.php"style="font-weight:bold;color:#4C7031;" >تسجيل الدخول</a>                  
                </li> 
                 
                <li class="nav-item">
                    <a class="btn btn-warning mr-2 " id="btn" type="button" href="register.php" style="font-weight:bold;color:#4C7031;" >التسجيل</a>
                </li>
               <?php endif;?>
            </ul>
        </div>

            </div>
        </div>
    </div>
            

    </nav>
<br>

<div class="container">

 <form class="form-inline my-2 my-lg-0" method="POST" action="search.php"> 
     
 <input class="form-control mr-sm-2" type="search" name = "search"    placeholder="Search" aria-label="Search">
      <button class="btn btn-warning  my-2 my-sm-0"style="font-weight:bold;color:#4C7031;" type="submit">  <i class="bi bi-search"></i>البحث </button>
    </form> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>