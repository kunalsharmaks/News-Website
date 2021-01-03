<?php include "header.php" ?>
<div class="add_post">Add New Post</div>
<div class="container">
    <div class="container_login">
             <div class="container_form">
                 <form action="save_post.php" method="post" enctype="multipart/form-data">
                        <label>Title</label><br/>
                        <input type="text" name="title" class="text"><br/>
                        <label>Description</label><br/>
                        <textarea name="description" class="text"  rows="5"></textarea>
                        <label>Category</label>
                        <select name="category" class="text">
                              <option disabled> Select Category</option>
                              <?php
                              include "config.php";
                              $sql="select * from category;";
                              $result=mysqli_query($conn,$sql) or die("Query Failed");
                           
                              if(mysqli_num_rows($result)>0){
                                  while($row=mysqli_fetch_assoc($result)){
                                    echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
                                  }
                                }
                              ?>
                        </select><br/>
                        <label>Post image</label><br/>
                        <input type="file" name="fileToUpload" required class="text"><br/>
                        <input type="submit" name="Submit" value="Save" class="submit">
                 </form>
             </div>
    </div>
</div>
<body>
<html>