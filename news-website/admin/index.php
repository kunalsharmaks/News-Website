<?php
session_start();
if(isset($_SESSION["username"])){
   header("Location: http://localhost/news-website/admin/post.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="login_container">
    <div class="login">
              <div class="admin_logo">
                      <img src="images/logo.jpg" class="logo_image">
              </div>
             <p>Admin</p>
             <div class="login_form">
                 <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                        <label>Username</label><br/>
                        <input type="text" name="username" class="text"><br/>
                        <label>Password</label><br/>
                        <input type="password" name="password" class="text"><br/>
                        <input type="submit" name="login" value="login" class="submit">
                 </form>

                <?php
                if(isset($_POST["login"])){
                    include "config.php";
                    if(empty($_POST["username"]) || empty($_POST["password"])){
                        echo "<div style='color:red; width:80%;margin:auto;padding:5px 0px;'> Enter All Fields</div>";
                    }
                    else{
                    $username=mysqli_real_escape_string($conn,$_POST["username"]);
                    $password=md5($_POST["password"]);

                    $sql="select user_id ,username,role from user where username='{$username}' and password='{$password}';";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                            session_start();
                            $_SESSION["username"]=$row["username"];
                            $_SESSION["user_id"]=$row["user_id"];
                            $_SESSION["role"]=$row["role"];
                            header("Location: http://localhost/news-website/admin/post.php");

                        }
                    }
                    else{
                        echo "<div style='color:red; width:80%;margin:auto;padding:5px 0px;'> Username and Password not matched</div>";
                    }
                }
                }
                ?>
             </div>
    </div>
</div>
</body>
</html>
