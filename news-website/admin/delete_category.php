<?php
if($_SESSION["role"]== '0'){
    header("Location: http://localhost/news-website/admin/post.php");
  }
 include "config.php";
 $category_id=$_GET["id"];
 $sql="delete from category where category_id='{$category_id}';";
 if(mysqli_query($conn,$sql)){
    header("Location: http://localhost/news-website/admin/category.php");
 }else{
     echo "<p style='color:red; width:80%;margin:auto;padding:5px 0px;'>Can\'t Delete Category.</p>";
 }
?>