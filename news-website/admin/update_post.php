<?php include "header.php" ;
if($_SESSION["role"] == 0){
  include "config.php";
  $post_id=$_GET["id"];
  $sql2="select author from post where post_id={$post_id};";
  $result2=mysqli_query($conn,$sql2) or die("Query Failed");
  $row2=mysqli_fetch_assoc($result2);
  if($row2["author"] !=  $_SESSION["user_id"]){
   header("Location: http://localhost/news-website/admin/post.php");
  }
}
 ?>
<div class="add_post">Update Post</div>
<div class="container">
    <div class="container_login">
             <div class="container_form">
             <?php
              include "config.php";
              $post_id=$_GET["id"];
              $sql="select * from post 
              left join category on post.category=category.category_id
              left join user on post.author=user.user_id 
              where post.post_id={$post_id};";
              $result=mysqli_query($conn,$sql) or die("Query Failed");
              if(mysqli_num_rows($result)>0){ 
                  while($row=mysqli_fetch_assoc($result)){
                  ?>
                 <form action="save_update_post.php?id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="post_id" class="text" value="<?php echo $row['post_id'];?>">
                        <label>Title</label><br/>
                        <input type="text" name="title" class="text" value="<?php echo $row['title'];?>"><br/>
                        <label>Description</label><br/>
                        <textarea name="description" class="text"  rows="5"> <?php echo $row['description'];?></textarea>
                        <label>Category</label>
                        <select name="category" class="text">
                        <option disabled> Select Category</option>
                              <?php
                              include "config.php";
                              $sql1="select * from category;";
                              $result1=mysqli_query($conn,$sql1) or die("Query Failed");
                           
                              if(mysqli_num_rows($result1)>0){
                                  while($row1=mysqli_fetch_assoc($result1)){
                                      if($row["category"]== $row1["category_id"]){
                                             $selected="selected";
                                      }else{
                                        $selected="";
                                      }
                                    echo "<option $selected value='".$row1['category_id']."'>".$row1['category_name']."</option>";
                                  }
                                }
                              ?>
                           
                        </select><br/>
                        <input type="hidden" name="old_category" value="<?php echo $row['category'] ?>">
                        <label>Post image</label><br/>
                        <input type="file" name="new-image" class="text"><br/>
                        <img  src="upload/<?php echo $row['post_img'];?>" height="150px" class="text"><br/>
                        <input type="hidden" name="old-image" value="<?php echo $row['post_img'];?>">
                        <input type="submit" name="submit" value="Update" class="submit">
                 </form>
                 <?php
                 }
                }?>
             </div>
    </div>
</div>
<body>
<html>