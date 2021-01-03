<?php
include "config.php";
if(isset($_FILES["fileToUpload"])){
    $errors=array();
    $filename=$_FILES['fileToUpload']['name'];
    $filesize=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
    $exp=explode('.',$filename);
    $file_ext=end($exp);
    $extensions=array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions)==false){
        $errors[]="This extension file not allowed, Please choose a JPG or PNG file.";
    }
    if($filesize > 2097152){
        $errors[]="File size must be 2MB or lower";
    }
    $new_name=time()."-".basename($filename);
    $target= "upload/".$new_name;
    $image_name=$new_name;
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,$target);
    }else{
        print_r($errors);
        die();
    }

}
session_start();
$title=mysqli_real_escape_string($conn,$_POST["title"]);
$description=mysqli_real_escape_string($conn,$_POST["description"]);
$category=mysqli_real_escape_string($conn,$_POST["category"]);
$date=date("d M, Y");
$author=$_SESSION["user_id"];
   $sql="insert into post(title,description,category,post_date,author,post_img) 
   values('{$title}','{$description}','{$category}','{$date}','{$author}','{$image_name}');";
   $sql .= "update category set post=post+1 where category_id={$category};";
   if(mysqli_multi_query($conn,$sql)){
    header("Location: http://localhost/news-website/admin/post.php");
   }else{
       echo "<div>Query Failed</div>";
   }
?>
