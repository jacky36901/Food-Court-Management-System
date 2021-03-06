<?php
include('top.php');

if(isset($_GET['type']) && $_GET['type']!='' && isset($_GET['Item_id'])&& $_GET['Item_id']>0){
   $type=get_safe_value($_GET['type']); 
   if($type=='status'){
      $operation=get_safe_value($_GET['operation']);
      $Item_id=get_safe_value($_GET['Item_id']);
      if($operation=='active'){
         $status='1';
      }else{
         $status='0';
      }
      $update_status_sql="update tbl_item set Status='$status' where Item_id='$Item_id'";
      mysqli_query($con,$update_status_sql);
   }  
   if($type=='delete'){
      $Item_id=get_safe_value($_GET['Item_id']);
      $delete_sql="delete from tbl_item where Item_id='$Item_id'";
      mysqli_query($con,$delete_sql);
   }
}

$sql="select tbl_item.*,tbl_cat.Cat_name,tbl_subcat.Subcat_name, tbl_stall.Stall_name from tbl_item,tbl_cat,tbl_subcat,tbl_stall where tbl_item.Cat_id=tbl_cat.Cat_id and tbl_item.Subcat_id=tbl_subcat.Subcat_id and tbl_item.Stall_id=tbl_stall.Stall_id order by tbl_item.Item_id ";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Item </h1>
                <a href="manage_item.php" class="add_link">Add Item</a>
               
            </div>
            <div class="card-body--">
               <div class="table-stats order-table ov-h">
                 <table class="table ">
                   <thead>
                     <tr>
                        <th>#id</th>
                        <th>Name</th>
                        <th>Stall Name</th>
                        <th>Categories</th>
                        <th>Subcategories</th>
                        <th>Price</th>
                        
                        <th>Descroption</th>
                        <th width="15%">Image</th>
                        <th width="20%">Action</th>
                      
                     </tr>
                   </thead>
                   <tbody>
                     <?php if(mysqli_num_rows($res)){
                     $i=1;
                     while($row=mysqli_fetch_assoc($res)){?>
                     <tr>
                        <td><?php echo $row['Item_id']?></td>
                        <td><?php echo $row['Item_name']?></td>
                        <td><?php echo $row['Stall_name']?></td>
                        <td><?php echo $row['Cat_name']?></td>
                        <td><?php echo $row['Subcat_name']?></td>                         
                        <td><?php echo $row['Item_price']?></td>
                        <td><?php echo $row['Desc']?></td>
                        <td><?php echo '<img src="upload/'.$row['Item_image'].'" width="15%" height="15%" alt="image">'?></td>
                        <td>
                          <?php
                        if($row['Status']==1){
                           echo "<a href='?type=status&operation=deactive&Item_id=".$row['Item_id']."'><label class='badge badge-success'>Available</label></a>&nbsp;";
                        }else{
                           echo "<a href='?type=status&operation=active&Item_id=".$row['Item_id']."'><label class='badge badge-danger delete_red'>Unavailable</label></a>&nbsp;";
                        }?>
                            <a href="manage_item.php?Item_id=<?php echo $row['Item_id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
              
                             &nbsp;
                            <a href="?Item_id=<?php echo $row['Item_id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>
                        </td>
                     </tr>
                     <?php 
                    $i++;
                       } } else { ?>
                    <tr>
                      <td colspan="5">No data found</td>
                    </tr>

                     <?php } ?>
                   </tbody>
                 </table>
               </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>
<?php include('footer.php');?>