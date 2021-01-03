<?php include "header.php" ;
if($_SESSION["role"]== '0'){
   header("Location: http://localhost/news-website/admin/post.php");
 }
if(isset($_POST["save"])){
   include "config.php";
   $firstname=mysqli_real_escape_string($conn,$_POST["firstname"]);
   $lastname=mysqli_real_escape_string($conn,$_POST["lastname"]);
   $username=mysqli_real_escape_string($conn,$_POST["username"]);
   $password=mysqli_real_escape_string($conn,md5($_POST["password"]));
   $role=mysqli_real_escape_string($conn,$_POST["role"]);

   $sql="select username from user where username='{$username}';";
   $result=mysqli_query($conn,$sql) or die("Query Failed");

   if(mysqli_num_rows($result)>0){
      echo "<p style='color:red; width:80%;margin:auto;padding:5px 0px;'>Username already Exists.</p>" ;
   }
   else{
      $sql1="insert into user (first_name,last_name,username,password,role)
            values('{$firstname}','{$lastname}','{$username}','{$password}','{$role}');" ;
      if(mysqli_query($conn,$sql1)){
         header("Location: http://localhost/news-web/admin/users.php");
      }
   }
}

?>
<div class="add_post">Add New Post</div>
<div class="container">
    <div class="container_login">
             <div class="container_form">
                 <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                        <label>First Name</label><br/>
                        <input type="text" name="firstname" class="text"><br/>
                        <label>Last Name</label><br/>
                        <input type="text" name="lastname" class="text"><br/>
                        <label>Username</label><br/>
                        <input type="text" name="username" class="text"><br/>
                        <label>Password</label><br/>
                        <input type="password" name="password" class="text"><br/>
                        <label>User Role</label><br/>
                        <select class="text" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select><br/>
                        <input type="submit" name="save" value="Save" class="submit">
                 </form>
             </div>
    </div>
</div>

</body>
</html>