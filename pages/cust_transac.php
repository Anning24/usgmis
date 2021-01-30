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
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              //personal information
              $first_name = $_POST['first_name'];
              $middle_name = $_POST['middle_name'];
              $last_name = $_POST['last_name'];
              $birth_date = $_POST['birth_date'];
              $sex = $_POST['sex'];
              $status = $_POST['status'];
              $street = $_POST['street'];
              $city = $_POST['city'];
              $province = $_POST['province'];
              $phone_number = $_POST['phone_number'];
              // emergency contact
              $full_name = $_POST['full_name'];
              $relationship = $_POST['relationship'];
              $emergency_contact_address = $_POST['emergency_contact_address'];
              $emergency_contact_phone_number = $_POST['emergency_contact_phone_number'];
              $last_id;
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO customer (first_name, middle_name, last_name, birth_date, sex, `status`, street, city, province, phone_number, `type`) VALUES ('$first_name', '$middle_name', '$last_name', '$birth_date', '$sex', '$status', '$street', '$city', '$province', '$phone_number', 'Regular')";
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                    if($result)
                    {
                      $query = "SELECT MAX(cust_id) AS last_id FROM customer";
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
                      while ($row = mysqli_fetch_array($result)) {
                        $last_id = $row["last_id"];
                      };

                      $query2 = "INSERT INTO emergency_contact (cust_id, full_name, relationship, phone_number, `address`) VALUES ('$last_id', '$full_name', '$relationship', '$emergency_contact_phone_number', '$emergency_contact_address')";
                      mysqli_query($db, $query2) or die (mysqli_error($db));
                    }
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "customer.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>