<?php include "header.php" ;
if($_SESSION["role"]== '0'){
   header("Location: http://localhost/news-website/admin/post.php");
 }
if(isset($_POST["submit"])){
    include "config.php";
    $category=mysqli_real_escape_string($conn,$_POST["category"]);
    $sql="select category_name from category where category_name='{$category}';";
    $result=mysqli_query($conn,$sql) or die("Query Failed");
 
    if(mysqli_num_rows($result)>0){
       echo "<p style='color:red; width:80%;margin:auto;padding:5px 0px;'>Category already Exists.</p>" ;
    }
    else{
       $sql1="insert into category (category_name) values('{$category}');" ;
       if(mysqli_query($conn,$sql1)){
          header("Location: http://localhost/news-web/admin/category.php");
       }
    }
 }
 
 ?>
<div class="add_post">Add New Category</div>
<div class="container">
    <div class="container_login">
             <div class="container_form">
                 <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                        <label>Category Name</label><br/>
                        <input type="text" name="category" class="text"><br/>
                        <input type="submit" name="submit" value="Save" class="submit">
                 </form>
             </div>
    </div>
</div>
</body>
</html>