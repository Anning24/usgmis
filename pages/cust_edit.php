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
  $query = 'SELECT a.*, b.full_name AS full_name, b.relationship AS relationship, b.address AS `address`, b.phone_number AS ecphone_number FROM customer a LEFT JOIN emergency_contact b ON a.cust_id = b.cust_id WHERE a.cust_id ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    { 
      $cust_id = $row['cust_id'];
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
              <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
                <div class="card-header py-3">
                  <h4 class="m-2 font-weight-bold">Edit Customer</h4>
                </div><a  type="button" class="btn btn-danger btn-block" href="customer.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
                <div class="card-body">
         
                  <form role="form" method="post" action="cust_edit1.php">
                    <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>" />
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      First Name:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="First Name" name="first_name" value="<?php echo $first_name; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Middle Name:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Middle Name" name="middle_name" value="<?php echo $middle_name; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Last Name:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $last_name; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Birthday:
                      </div>
                      <div class="col-sm-9">
                        <input placeholder="Birthday" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="birth_date" value="<?php echo $birth_date; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Sex:
                      </div>
                      <div class="col-sm-9">
                        <select class="form-control" name="sex" value="<?php echo $sex; ?>" required>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Status:
                      </div>
                      <div class="col-sm-9">
                        <select class="form-control" name="status" value="<?php echo $status; ?>" required>
                          <option value="Single">Single</option>
                          <option value="Married">Married</option>
                          <option value="Separated">Divorced</option>
                          <option value="Widowed">Widowed</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Street:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Street" name="street" value="<?php echo $street; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      City:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="City" name="city" value="<?php echo $city; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Province:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Province" name="province" value="<?php echo $province; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Contact #:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Phone Number" name="phone_number" value="<?php echo $phone_number; ?>" required>
                      </div>
                    </div>
                    <h5 class="m-2 font-weight-bold">Emergency Contact Information</h5>
                    <hr>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Full Name:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Full Name" name="full_name" value="<?php echo $full_name; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Relationship:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Relationship" name="relationship" value="<?php echo $relationship; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Address:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Address" name="emergency_contact_address" value="<?php echo $address; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3" style="padding-top: 5px;">
                      Phone Number:
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Phone Number" name="emergency_contact_phone_number" value="<?php echo $ecphone_number; ?>" required>
                      </div>
                    </div>

                    <hr>
                      <button type="submit" class="btn btn-success btn-block"><i class="fa fa-edit fa-fw"></i>Update</button> 
                  </form>  
                </div>
              </div>

<?php
include'../includes/footer.php';
?>