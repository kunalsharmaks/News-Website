<?php include 'header.php';?>
<div class="news">
      <div class="recent">
                        <div class="single_post">
                        <div class="single_info">
                         <?php
                      include "config.php";
                      $post_id=$_GET["id"];
                      $sql1="select * from post 
                      left join category on post.category=category.category_id
                      left join user on post.author=user.user_id 
                      where post_id={$post_id};";
                      $result1=mysqli_query($conn,$sql1);
                      if(mysqli_num_rows($result1)>0){
                        while($row=mysqli_fetch_assoc($result1))
                        {
                      ?>
                                         <div class="single_heading"><?php echo $row['title'];?></div>
                                         <div class="single_icons">
                                             <i class="fa fa-tags" aria-hidden="true"></i>
                                             <a href='category.php?cid=<?php echo $row["category"];?>'><?php echo $row["category_name"];?></a>
                                             <i class="fa fa-user" aria-hidden="true"></i>
                                             <a href='author.php?aid=<?php echo $row["author"];?>'><?php echo $row["username"];?></a>
                                             <i class="fa fa-calendar" aria-hidden="true"></i>
                                             <span><?php echo $row["post_date"];?></span>
                                          </div>
                                 </div>
                         </div>
                         <div class="single_image"><img src="admin/upload/<?php echo $row["post_img"]?>"></div>

                         <div class="single_description"><?php echo $row["description"];?></div>
                         <?php
                         }
                        }else{
                                echo "<h2>No Record Found</h2>";
                        }   ?>
      </div>
      <div class="sidebar">
            <?php include 'search.php';?>
            <?php include 'sidebar.php';?>
      </div>
</div>
</body>
</html>