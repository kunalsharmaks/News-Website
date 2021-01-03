<?php include "header.php";?>
<div class="post_content">
    <div class="all_posts">
      <p>All Posts</p>
      <div class="button"><a href="add-post.php">ADD POST</a></div>
    </div>
    <?php
    include "config.php";
    $limit=3;
   
    if(isset($_GET["page"])){
      $page_no=$_GET["page"];
    }else{
      $page_no=1;
    }
    $offset=($page_no-1) * $limit;
    if($_SESSION["role"] == 1){
    $sql1="select * from post 
    left join category on post.category=category.category_id
    left join user on post.author=user.user_id 
    order by post.post_id desc limit {$offset},{$limit};";
    }
    else{
      $sql1="select * from post 
    left join category on post.category=category.category_id
    left join user on post.author=user.user_id 
    where post.author={$_SESSION['user_id']}
    order by post.post_id desc limit {$offset},{$limit};";
    }
    $result1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($result1)>0){ ?>
      <table class="post_table">
          <thead>
              <th class="table_heading">S.NO</th>
              <th class="table_heading">TITLE</th>
              <th class="table_heading">CATEGORY</th>
              <th class="table_heading">DATE</th>
              <th class="table_heading">AUTHOR</th>
              <th class="table_heading">EDIT</th>
              <th class="table_heading">DELETE</th>
          </thead>
          <tbody>
          <?php
          $serial=$offset+1;
          while($row=mysqli_fetch_assoc($result1))
                    {
          ?>
              <tr>
              <td class='id table_data'><?php echo $serial;?></td>
              <td  class="table_data"><?php echo $row["title"];?></td>
              <td  class="table_data"><?php echo $row["category_name"];?></td>
              <td  class="table_data"><?php echo $row["post_date"];?></td>
              <td  class="table_data"><?php echo $row["username"];?></td>
              <td  class='edit table_data'><a href='update_post.php?id=<?php echo $row["post_id"];?>'><i class='fa fa-edit'></i></a></td>
              <td  class='delete table_data '><a href='delete_post.php?id=<?php echo $row["post_id"];?>&catid=<?php echo $row["category"];?>'><i class='fa fa-trash-o'></i></a></td>
              </tr>
              <?php 
            $serial++;
            } ?>     
          </tbody>
      </table>
      <?php }  
           if($_SESSION["role"] == 1){
           $sql="select * from post;";
           }
           else{
            $sql="select * from post where post.author={$_SESSION['user_id']};"; 
           }
           $result=mysqli_query($conn,$sql) or die("Query Failed");
           if(mysqli_num_rows($result)>0){ 
               $tota_records=mysqli_num_rows($result);
               $total_page=ceil($tota_records/$limit);
               echo '<div class="pagination">';
               echo '<ul>';
               if($page_no>1){
               echo '<li><a href="post.php?page='.($page_no-1).'">Prev</a></li>';
               }
               for($i=1;$i<=$total_page;$i++){
                 if($i==$page_no){
                   $active="active";
                 }
                 else{
                   $active="";
                 }
                echo '<li class="'.$active.'"><a href="post.php?page='.$i.'">'.$i.'</a></li>';
               }
               if($total_page > $page_no){
               echo '<li><a href="post.php?page='.($page_no + 1).'">Next</a></li>';
               }
               echo '</ul>';
            echo '</div>';
           }
        ?>
</div>
</body>
</html>
