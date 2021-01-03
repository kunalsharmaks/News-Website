<div class="recent_post">
           <h4 class="title">RECENT POSTS</h4>
           <div class="recent_post_box">
                                     <?php
                                     include "config.php";
                                     $limit=5;
                                     $sql1="select * from post 
                                     left join category on post.category=category.category_id
                                     order by post.post_id desc limit {$limit};";
                                     $result1=mysqli_query($conn,$sql1);
                                     if(mysqli_num_rows($result1)>0){
                                       while($row=mysqli_fetch_assoc($result1))
                                       {
                                     ?>
                        <div class="early_post">
                            <div class="image"><img src="admin/upload/<?php echo $row["post_img"];?>" width="100px" height="85px"></div>
                            <div class="info">
                                   <div class="heading"><a href="single.php?id=<?php echo $row['post_id'];?>"><?php echo $row["title"];?></a></div>
                                   <div class="icons">
                                     <i class="fa fa-tags" aria-hidden="true"></i>
                                     <a href='category.php?cid=<?php echo $row["category"];?>'><?php echo $row["category_name"];?></a>
                                     <i class="fa fa-calendar" aria-hidden="true"></i>
                                     <span><?php echo $row["post_date"];?></span>
                                  </div>
                                  <div class="button"><a href="single.php?id=<?php echo $row['post_id'];?>">Read More</a></div>
                            </div>
                        </div>
                        <hr />
                             <?php
                             }
                             }
                             ?>   
             </div>
</div>   
    