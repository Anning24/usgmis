<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

date_default_timezone_set("Asia/Manila");
$date_today = date("Y-m-d");

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
              switch($_GET['action']){
                case 'time_in':
                    $cust_id = $_POST["cust_id_post"];
                    $time_in = $_POST["time_in"];

                    $query = "SELECT * FROM session_logs WHERE cust_id = '$cust_id' AND time_in LIKE '%$date_today%'";
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));

                    if($result->num_rows < 1)
                    {
                        $query = "INSERT INTO session_logs (cust_id, time_in) VALUES ('$cust_id', '$time_in')";
                        mysqli_query($db, $query) or die (mysqli_error($db));
                        
                        echo "<script type='text/javascript'>";
                        echo "alert('User Time-in Successful!');";
                        echo "window.location =('time_in.php');";
                        echo "</script>";
                    }
                    else
                    {
                        $query = "SELECT * FROM session_logs WHERE cust_id = '$cust_id' AND time_in LIKE '%$date_today%' AND time_out IS NULL";
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));

                        if($result->num_rows > 0)
                        {
                            echo "<script type='text/javascript'>";
                            echo "alert('User has already time-in!');";
                            echo "window.location =('time_in.php');";
                            echo "</script>";
                        }
                        else
                        {
                            $query = "INSERT INTO session_logs (cust_id, time_in) VALUES ('$cust_id', '$time_in')";
                            mysqli_query($db, $query) or die (mysqli_error($db));

                            echo "<script type='text/javascript'>";
                            echo "alert('User Time-in Successful!');";
                            echo "window.location =('time_in.php');";
                            echo "</script>";
                        }
                    }
                case 'time_out':
                        $cust_id_post_time_out = $_POST["cust_id_post_time_out"];
                        $time_out = $_POST["time_out"];

                        $query = "SELECT * FROM session_logs WHERE cust_id = '$cust_id_post_time_out' AND time_in LIKE '%$date_today%' AND time_out IS NULL";
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));

                        if($result->num_rows < 1)
                        {
                            echo "<script type='text/javascript'>";
                            echo "alert('User has not timed-in!');";
                            echo "window.location =('time_in.php');";
                            echo "</script>";
                        }
                        else
                        {
                            $query = "UPDATE session_logs SET time_out = '$time_out' WHERE cust_id = '$cust_id_post_time_out' AND time_in LIKE '%$date_today%' AND time_out IS NULL";
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));

                            echo "<script type='text/javascript'>";
                            echo "alert('User Time-Out Successful!');";
                            echo "window.location =('time_in.php');";
                            echo "</script>";
                        }
                    
                break;
              }
            ?>
              
          </div>

<?php
include'../includes/footer.php';
?>