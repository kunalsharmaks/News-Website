<?php include "header.php" ;
if($_SESSION["role"]== '0'){
    header("Location: http://localhost/news-web/admin/post.php");
  }
  if(isset($_POST["submit"])){
    include "config.php";
    $category_id=mysqli_real_escape_string($conn,$_POST["category_id"]);
    $category=mysqli_real_escape_string($conn,$_POST["category"]);
    
 
    $sql="update category set category_name='{$category}';";
     if(mysqli_query($conn,$sql)){
       header("Location: http://localhost/news-website/admin/category.php");
    }
 }
 ?>
<div class="add_post">Update Category</div>
<div class="container">
    <div class="container_login">
             <div class="container_form">
             <?php
              include "config.php";
              $category_id=$_GET["id"];
              $sql="select * from category where category_id='{$category_id}';";
              $result=mysqli_query($conn,$sql) or die("Query Failed");
              if(mysqli_num_rows($result)>0){ 
                  while($row=mysqli_fetch_assoc($result)){
                  ?>
                 <form action="#" method="post">
                        <input type="hidden" name="category_id" class="text" value="<?php echo $row['category_id'];?>">
                        <label>Category Name</label><br/>
                        <input type="text" name="category" class="text" value="<?php echo $row['category_name'];?>" required ><br/>
                        <input type="submit" name="submit" value="Update" class="submit">
                 </form>
                 <?php
                 }
                }?>
             </div>
    </div>
</div>
</body>
</html>