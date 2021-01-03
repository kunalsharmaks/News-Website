<?php
if(empty($_FILES["new-image"]["name"])){
   $filename=$_POST["old-image"];
}
else{
    $errors=array();
    $filename=$_FILES['new-image']['name'];
    $filesize=$_FILES['new-image']['size'];
    $file_tmp=$_FILES['new-image']['tmp_name'];
    $file_type=$_FILES['new-image']['type'];
    $exp=explode('.',$filename);
    $file_ext=end($exp);
    $extensions=array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions)==false){
        $errors[]="This extension file not allowed, Please choose a JPG or PNG file.";
    }
    if($filesize > 2097152){
        $errors[]="File size must be 2MB or lower";
    }
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"images/".$filename);
    }else{
        print_r($errors);
        die();
    }
}
include "config.php";
$websitename=mysqli_real_escape_string($conn,$_POST["websitename"]);
$sql="update settings set websitename='{$websitename}', logo='{$filename}';";
$result=mysqli_query($conn,$sql)or die("die");
if($result){
    header("Location: http://localhost/news-website/admin/settings.php");
}
?>
