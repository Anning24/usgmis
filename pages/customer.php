<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?><?php 

                $query = 'SELECT ID, t.TYPE
                          FROM users u
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['TYPE'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                         
           
}   
            ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <h4 class="m-2 font-weight-bold text-center">Customers List</h4>
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                  <a  href="#" data-toggle="modal" data-target="#customerModal" type="button" class="btn btn-danger btn-block" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i>Add New Customer</a>
                </div>
              </div>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Type</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM customer';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      $first_name = $row['first_name'];
                      $middle_name = $row['middle_name'];
                      $last_name = $row['last_name'];
                      $street = $row['street'];
                      $city = $row['city'];
                      $province = $row['province'];
                      $type = $row['type'];
                      $phone_number = $row['phone_number'];
                      echo '<tr>';
                      echo '<td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>';
                      echo '<td>'.$street.' '.$city.', '.$province.'</td>';
                      echo '<td>'.$phone_number.'</td>';
                      echo '<td>'.$type.'</td>';
                      echo '<td align="right">
                              <div class="btn-group">
                                <a type="button" class="btn btn-danger" href="cust_searchfrm.php?action=edit & id='.$row['cust_id'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                                <div class="btn-group">
                                  <a type="button" class="btn btn-danger dropdown no-arrow" data-toggle="dropdown" style="color:white;"><span class="caret"></span>...</a>
                                    <ul class="dropdown-menu text-center" role="menu">
                                      <li>
                                        <a type="button" class="btn btn-success btn-block" style="border-radius: 0px;" href="cust_edit.php?action=edit & id='.$row['cust_id']. '"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                      </li>
                                    </ul>
                                </div>
                              </div>
                            </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php
include'../includes/footer.php';
?>