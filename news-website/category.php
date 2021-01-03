<?php include 'header.php';
include "config.php";
$cat_id=$_GET["cid"];?>
<div class="news">
              <div class="recent">
              <?php
               $sql="select * from category where category_id={$cat_id};";
               $result=mysqli_query($conn,$sql) or die("Query Failed");
               $row1=mysqli_fetch_assoc($result);
               ?>
                         <h2><?php echo strtoupper($row1["category_name"]);?></h2>
                         <hr />
                         <?php
                      include "config.php";
                      $limit=3;
                      if(isset($_GET["page"])){
                        $page_no=$_GET["page"];
                      }else{
                        $page_no=1;
                      }
                      $offset=($page_no-1) * $limit;
                      $cat_id=$_GET["cid"];
                      $sql1="select * from post 
                      left join category on post.category=category.category_id
                      left join user on post.author=user.user_id 
                      where category={$cat_id}
                      order by post.post_id desc limit {$offset},{$limit};";
                      $result1=mysqli_query($conn,$sql1);
                      if(mysqli_num_rows($result1)>0){
                        while($row=mysqli_fetch_assoc($result1))
                        {
                      ?>
                         <div class="post">
                                 <div class="image"><img src="admin/upload/<?php echo $row['post_img']?>" width="250px" height="180px" class="img"></div>
                                 <div class="info">
                                         <div class="heading"><a href="single.php?id=<?php echo $row['post_id'];?>"><?php echo $row['title'];?></a></div>
                                         <div class="icons">
                                             <i class="fa fa-tags" aria-hidden="true"></i>
                                             <a href='category.php?cid=<?php echo $row["category"];?>'><?php echo $row["category_name"];?></a>
                                             <i class="fa fa-user" aria-hidden="true"></i>
                                             <a href='author.php?aid=<?php echo $row["author"];?>'><?php echo $row["username"];?></a>
                                             <i class="fa fa-calendar" aria-hidden="true"></i>
                                             <span><?php echo $row["post_date"];?></span>
                                          </div>
                                          <div class="description"><?php echo substr($row["description"],0,200)."...";?></div>
                                          <div class="button"><a href="single.php?id=<?php echo $row['post_id'];?>">Read More</a></div>
                                 </div>
                         </div>
                         <hr />
                         <?php } 
                         }
                        
                         if(mysqli_num_rows($result)>0){       
                         $total_records=$row1["post"];
                         $total_page=ceil($total_records/$limit);
                         echo '<div class="pagination">';
                         echo '<ul>';
                         if($page_no>1){
                         echo '<li><a href="category.php?cid='.$cat_id.'&page='.($page_no-1).'">Prev</a></li>';
                         }
                         for($i=1;$i<=$total_page;$i++){
                         if($i==$page_no){
                             $active="active";
                        }
                        else{
                             $active="";
                         }
                          echo '<li class="'.$active.'"><a href="category.php?cid='.$cat_id.'&page='.$i.'">'.$i.'</a></li>';
                         }
                         if($total_page > $page_no){
                         echo '<li><a href="category.php?cid='.$cat_id.'&page='.($page_no + 1).'">Next</a></li>';
                         }
                         echo '</ul>';
                         echo '</div>';
                        }

                         ?>
                        

                         
                        
             </div>
              
             <div class="sidebar">
                 <?php include 'search.php';?>
                 <?php include 'sidebar.php';?>
             </div>
</div>               
</body>
</html>
