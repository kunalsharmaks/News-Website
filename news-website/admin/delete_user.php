<?php
if($_SESSION["role"]== '0'){
    header("Location: http://localhost/news-website/admin/post.php");
  }
 include "config.php";
 $user_id=$_GET["id"];
 $sql="delete from user where user_id='{$user_id}';";
 if(mysqli_query($conn,$sql)){
    header("Location: http://localhost/news-website/admin/users.php");
 }else{
     echo "<p style='color:red; width:80%;margin:auto;padding:5px 0px;'>Can\'t Delete User Record.</p>";
 }
?>