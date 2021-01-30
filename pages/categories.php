<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['TYPE'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Restricted Page! You will be redirected to POS");
    window.location = "pos.php";
  </script>
<?php
  }           
} 
            ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <h4 class="m-2 font-weight-bold text-center">Categories List</h4>
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <a  href="#" data-toggle="modal" data-target="#categories" type="button" class="btn btn-danger btn-block" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i>Add New Category</a>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                       <th>Category Name</th>
                       <th>Option</th>
                   </tr>
               </thead>
          <tbody>
<?php                  
    $query = "SELECT * FROM category";
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['CATEGORY_ID'];
                $category_name = $row['CNAME'];
                echo "<tr>";
                echo "<td>$category_name</td>";
                      echo "<td align='right'> <div class='btn-group'>
                              <a type='button' class='btn btn-danger' href='sup_searchfrm.php?action=edit & id=$category_id><i class='fas fa-fw fa-list-alt'></i> Edit</a>
                            <div class='btn-group'>
                              <a type='button' class='btn btn-danger dropdown no-arrow' data-toggle='dropdown' style='color:white;'>
                              ... <span class='caret'></span></a>
                            <ul class='dropdown-menu text-center' role='menu'>
                                <li>
                                  <a type='button' class='btn btn-success btn-block' style='border-radius: 0px;' href='sup_edit.php?action=edit & id=$category_id'>
                                    <i class='fas fa-fw fa-edit'></i> Edit
                                  </a>
                                </li> 
                            </ul>
                            </div>
                          </div> </td>";
                      echo '</tr> ';
                        }
?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

  <!-- Customer Modal-->
  <div class="modal fade" id="categories" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="sup_transac.php?action=add">
              
              <div class="form-group">
                <input class="form-control" placeholder="Company Name" name="companyname" required>
              </div>
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
<?php
include'../includes/footer.php';
?>