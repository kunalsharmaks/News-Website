<?php include "header.php" ?>
<div class="add_post">Website Settings</div>
<div class="container">
    <div class="container_login">
             <div class="container_form">
             <?php
              include "config.php";
              $sql="select * from settings";
              $result=mysqli_query($conn,$sql) or die("Query Failed");
              if(mysqli_num_rows($result)>0){ 
                  while($row=mysqli_fetch_assoc($result)){
                  ?>
                 <form action="save_settings.php" method="post" enctype="multipart/form-data">
                        <label>Website Name</label><br/>
                        <input type="text" name="websitename" class="text" value="<?php echo $row['websitename'];?>"><br/>
                        <label>Website Logo</label><br/>
                        <input type="file" name="new-image" class="text"><br/>
                        <img  src="images/<?php echo $row['logo'];?>" height="100px" class="text"><br/>
                        <input type="hidden" name="old-image" value="<?php echo $row['logo'];?>">
                        <input type="submit" name="Submit" value="Save" class="submit">
                 </form>
                 <?php
                 }
                }?>
             </div>
    </div>
</div>

<body>
<html>