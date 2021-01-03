<?php
include "config.php";
$page=basename($_SERVER["PHP_SELF"]);
switch($page){
    case "single.php":
        if(isset($_GET["id"])){
           $sql_title="select * from post where post_id={$_GET["id"]};";
           $result_title=mysqli_query($conn,$sql_title);
           $row_title=mysqli_fetch_assoc($result_title);
           $page_title=$row_title["title"];
        }else{
           $page_title="No Post Found";
        }
        break;
    case "category.php":
        if(isset($_GET["cid"])){
            $sql_title="select * from category where category_id={$_GET["cid"]};";
            $result_title=mysqli_query($conn,$sql_title);
            $row_title=mysqli_fetch_assoc($result_title);
            $page_title=$row_title["category_name"]." News";
         }else{
            $page_title="No Category Found";
         }
         break; 
    case "author.php":
        if(isset($_GET["aid"])){
            $sql_title="select * from user where user_id={$_GET["aid"]};";
            $result_title=mysqli_query($conn,$sql_title);
            $row_title=mysqli_fetch_assoc($result_title);
            $page_title="News By ".$row_title["first_name"]." ".$row_title["last_name"];
         }else{
            $page_title="No Author Found";
         }
         break;
    case "result.php":
        if(isset($_GET["search"])){
          $page_title= $_GET["search"];
         }else{
            $page_title="No Result Found";
         }
         break;
    default :
        $page_title="News Site";
        break;         
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title;?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
<?php
              include "config.php";
              $sql="select * from settings";
              $result=mysqli_query($conn,$sql) or die("Query Failed");
              if(mysqli_num_rows($result)>0){ 
                  while($row=mysqli_fetch_assoc($result)){
                       if($row["logo"]==" "){
                           echo  $row['websitename'];
                       }else{
                  ?>
                      <div class="logo"><img src="admin/images/<?php echo $row['logo'];?>"></div>
                      <?php 
                      }
                    }    
              } 
              ?>
         
         <div class="menu">
             <?php
             include "config.php";
             if(isset($_GET["cid"])){
             $cat_id=$_GET["cid"];}
             $sql="select * from category where post>0;";
             $result=mysqli_query($conn,$sql);
             if(mysqli_num_rows($result)>0){
                $active="";
             ?>
            <ul class="nav_link">
            <li><a class= "nav_links" href="http://localhost/news-website">HOME</a></li>
                <?php
                 while($row=mysqli_fetch_assoc($result))
                 {   if(isset($_GET["cid"])){
                     if($row["category_id"]==$cat_id){
                         $active="active";
                    }
                    else{
                         $active="";
                    }
                }
                ?>
                <li class= "<?php echo $active;?>"><a class= "nav_links" href="category.php?cid=<?php echo $row['category_id'];?>"><?php echo strtoupper($row["category_name"]);?></a></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
 </div>
