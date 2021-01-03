<?php include "header.php" ;
if($_SESSION["role"]== '0'){
   header("Location: http://localhost/news-web/admin/post.php");
 }

if(isset($_POST["submit"])){
   include "config.php";
   $user_id=mysqli_real_escape_string($conn,$_POST["user_id"]);
   $firstname=mysqli_real_escape_string($conn,$_POST["firstname"]);
   $lastname=mysqli_real_escape_string($conn,$_POST["lastname"]);
   $username=mysqli_real_escape_string($conn,$_POST["username"]);
   $role=mysqli_real_escape_string($conn,$_POST["role"]);

   $sql="update user set first_name='{$firstname}',last_name='{$lastname}',username='{$username}',role='{$role}' where user_id={$user_id};";
    if(mysqli_query($conn,$sql)){
      header("Location: http://localhost/news-website/admin/users.php");
   }
}

?>
<div class="add_post">Add New Post</div>
<div class="container">
    <div class="container_login">
             <div class="container_form">
             <?php
              include "config.php";
              $user_id=$_GET["id"];
              $sql="select * from user where user_id='{$user_id}';";
              $result=mysqli_query($conn,$sql) or die("Query Failed");
              if(mysqli_num_rows($result)>0){ 
                  while($row=mysqli_fetch_assoc($result)){
                  ?>
                 <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                        <input type="hidden" name="user_id" class="text" value="<?php echo $row['user_id'];?>">
                        <label>First Name</label><br/>
                        <input type="text" name="firstname" class="text" value="<?php echo $row['first_name'];?>" required><br/>
                        <label>Last Name</label><br/>
                        <input type="text" name="lastname" class="text" value="<?php echo $row['last_name'];?>" required><br/>
                        <label>Username</label><br/>
                        <input type="text" name="username" class="text" value="<?php echo $row['username'];?>" required><br/>
                        <label>User Role</label><br/>
                        <select class="text" name="role" value="<?php echo $row['role'];?>" >
                             <?php if($row['role']== 1){
                                echo "<option value='0'>Normal User</option>
                                      <option value='1' selected>Admin</option>";
                             }
                             else{
                                echo "<option value='0' selected>Normal User</option>
                                      <option value='1'>Admin</option>";
                             }
                            ?>
                          </select><br/>
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