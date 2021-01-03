<?php
if(empty($_FILES["new-image"]["name"])){
    $image_name=$_POST["old-image"];
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
    $new_name=time()."-".basename($filename);
    $target= "upload/".$new_name;
    $image_name=$new_name;
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,$target);
    }
    else{
        print_r($errors);
        die();
    }
}
include "config.php";
$post_id=$_GET["id"];
$title=mysqli_real_escape_string($conn,$_POST["title"]);
$description=mysqli_real_escape_string($conn,$_POST["description"]);
$category=mysqli_real_escape_string($conn,$_POST["category"]);
$sql="update post set title='{$title}', description='{$description}', category='{$category}',post_img='{$image_name}' where post_id={$post_id};";
if($_POST["old_category"] != $_POST["category"]){
$sql .= "update category set post=post-1 where category_id={$_POST['old_category']};";
$sql .= "update category set post=post+1 where category_id={$_POST['category']};";
}
$result=mysqli_multi_query($conn,$sql)or die("die");
if($result){
    header("Location: http://localhost/news-website/admin/post.php");
}
?>
