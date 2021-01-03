<?php include "header.php";
if($_SESSION["role"]== '0'){
  header("Location: http://localhost/news-web/admin/post.php");
}
?>
<div class="post_content">
    <div class="all_posts">
      <p>All Categories</p>
      <div class="button"><a href="add-category.php">ADD CATEGORY</a></div>
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
    $sql1="select * from category order by category_id asc limit {$offset},{$limit};";
    $result1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($result1) >0){ ?>
      <table class="post_table">
          <thead>
              <th class="table_heading">S.No.</th>
              <th class="table_heading">Category Name</th>
              <th class="table_heading">No. of Posts</th>
              <th class="table_heading">Edit</th>
              <th class="table_heading">Delete</th>
              
          </thead>
          <tbody>
          <?php  while($row=mysqli_fetch_assoc($result1))
                    {
          ?>
          
              <tr>
              <td class='id table_data'><?php echo $row["category_id"];?></td>
              <td class="table_data"><?php echo $row["category_name"];?></td>
              <td class="table_data"><?php echo $row["post"];?></td>
              <td class='edit table_data'><a href='update_category.php?id=<?php echo $row["category_id"];?>'><i class='fa fa-edit'></i></a></td>
              <td class='delete table_data'><a href='delete_category.php?id=<?php echo $row["category_id"];?>'><i class='fa fa-trash-o'></i></a></td>
              </tr>
             
              <?php } ?> 
          </tbody>
      </table>
      <?php }  
           $sql="select * from category;";
           $result=mysqli_query($conn,$sql) or die("Query Failed");
           if(mysqli_num_rows($result)>0){ 
               $tota_records=mysqli_num_rows($result);
               $total_page=ceil($tota_records/$limit);
               echo '<div class="pagination">';
               echo '<ul>';
               if($page_no>1){
               echo '<li><a href="category.php?page='.($page_no-1).'">Prev</a></li>';
               }
               for($i=1;$i<=$total_page;$i++){
                 if($i==$page_no){
                   $active="active";
                 }
                 else{
                   $active="";
                 }
                echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
               }
               if($total_page > $page_no){
               echo '<li><a href="category.php?page='.($page_no + 1).'">Next</a></li>';
               }
               echo '</ul>';
            echo '</div>';
           }
        ?>
</div>

</body>
</html>