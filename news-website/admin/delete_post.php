<?php
include "config.php";
 $post_id=$_GET["id"];
 $cat_id=$_GET["catid"];
 $sql1="select * from post where post_id='{$post_id}';";
 $result1=mysqli_query($conn,$sql1);
 $row=mysqli_fetch_assoc($result1);
 unlink('upload/'.$row["post_img"]);
 $sql="delete from post where post_id='{$post_id}';";
 $sql .= "update category set post=post-1 where category_id={$cat_id};";
 if(mysqli_multi_query($conn,$sql)){
    header("Location: http://localhost/news-website/admin/post.php");
 }else{
     echo "<p style='color:red; width:80%;margin:auto;padding:5px 0px;'>Can\'t Delete User Record.</p>";
 }
?>