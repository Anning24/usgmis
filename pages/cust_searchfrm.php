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
  $query = 'SELECT a.*, b.full_name AS full_name, b.relationship AS relationship, b.address AS `address`, b.phone_number AS ecphone_number FROM customer a LEFT JOIN emergency_contact b ON a.cust_id = b.cust_id WHERE a.cust_id ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $first_name = $row['first_name'];
      $middle_name = $row['middle_name'];
      $last_name = $row['last_name'];
      $birth_date = $row['birth_date'];
      $sex = $row['sex'];
      $status = $row['status'];
      $street = $row['street'];
      $city = $row['city'];
      $province = $row['province'];
      $type = $row['type'];
      $phone_number = $row['phone_number'];
      $date_added = $row['date_added'];
      //emergency contact
      $full_name = $row['full_name'];
      $relationship = $row['relationship'];
      $address = $row['address'];
      $ecphone_number = $row['ecphone_number'];
    }
    $id = $_GET['id'];
?>
            
            <center>
          <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-danger">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold">Customer's Detail</h4>
            </div>
            <a href="customer.php" type="button" class="btn btn-danger btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
                
                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Full Name<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $last_name.', '.$first_name.' '.$middle_name; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Birthday<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $birth_date; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Sex<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $sex; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Status<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $status; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Address<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $street.' '.$city.', '.$province; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Contact #<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $phone_number; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <h5 class="m-2 font-weight-bold">Emergency Contact Information</h5>
                    <hr>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Full Name<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $full_name; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Relationship<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $relationship; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Address<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $address; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3">
                        <h5>
                          Contact #<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $ecphone_number; ?> <br>
                        </h5>
                      </div>
                    </div>
            </div>
          </div>

<?php
include'../includes/footer.php';
?>