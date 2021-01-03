<?php
session_start();
if(!isset($_SESSION["username"])){
   header("Location: http://localhost/news-website/admin/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
       <div class="menu1">
           <div class="sub_menu1">
           <?php
              include "config.php";
              $sql="select * from settings";
              $result=mysqli_query($conn,$sql) or die("Query Failed");
              if(mysqli_num_rows($result)>0){ 
                  while($row=mysqli_fetch_assoc($result)){
                       if($row["logo"]==" "){
                           echo  $row['websitename'];
                       }else{
                  ?>
                      <div class="image"><img src="images/<?php echo $row['logo'];?>"></div>
                      <?php 
                      }
                    }    
              } 
              ?>
                      <div class="logout"><a href="logout.php">HELLO&nbsp;&nbsp;<?php echo $_SESSION["username"];?>&nbsp;&nbsp;, LOGOUT</a></div>
           </div>
       </div>
       <div class="menu2">
           <div class="sub_menu2">
                     <ul class="nav_link">
                             <li><a href="post.php" class="nav_links">POST</a></li>
                             <?php 
                             if($_SESSION["role"]== '1'){
                             ?>
                             <li><a href="category.php" class="nav_links">CATEGORY</a></li>
                             <li><a href="users.php" class="nav_links">USERS</a></li>
                             <li><a href="settings.php" class="nav_links">SETTINGS</a></li>
                             <?php } ?>
                      </ul>
           </div>
       </div>
 </div>