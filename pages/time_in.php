<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

date_default_timezone_set("Asia/Manila");
$date_today = date("Y-m-d");

?>
<?php 

                $query = 'SELECT ID, t.TYPE
                          FROM users u
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['TYPE'];
                   
if ($Aa=='User')
{
           
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

<style>
.clockdate-wrapper {
    background-color: #333;
    padding:25px;
    max-width:350px;
    width:100%;
    text-align:center;
    margin:0 auto;
}
#clock{
    background-color:#333;
    font-family: sans-serif;
    font-size:60px;
    text-shadow:0px 0px 1px #fff;
    color:#fff;
}
#clock span {
    color:#888;
    text-shadow:0px 0px 1px #333;
    font-size:30px;
    position:relative;
    top:-27px;
    left:-10px;
}
#date {
    letter-spacing:10px;
    font-size:14px;
    font-family:arial,sans-serif;
    color:#fff;
}
</style>

<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="clockdate">
                    <div class="clockdate-wrapper">
                        <div id="clock"></div>
                        <div id="date"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-xs-12">
                    <h4 class="m-2 font-weight-bold">Customers List</h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden>id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Type</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                  
                                $query = 'SELECT * FROM customer';
                                $result = mysqli_query($db, $query) or die (mysqli_error($db));

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $cust_id = $row['cust_id'];
                                    $first_name = $row['first_name'];
                                    $middle_name = $row['middle_name'];
                                    $last_name = $row['last_name'];
                                    $street = $row['street'];
                                    $city = $row['city'];
                                    $province = $row['province'];
                                    $type = $row['type'];
                                    $phone_number = $row['phone_number'];
                                    echo "<tr id=$cust_id>";
                                    echo '<td hidden>'.$cust_id.'</td>';
                                    echo '<td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>';
                                    echo '<td>'.$street.' '.$city.', '.$province.'</td>';
                                    echo '<td>'.$phone_number.'</td>';
                                    echo '<td>'.$type.'</td>';
                                    echo "<td align='center'>
                                            <a  href='#' data-toggle='modal' data-target='#timeinModal' type='button' class='btn btn-success timein' id='timein-$cust_id' style='border-radius: 0px;'><i class='fas fa-fw fa-list-alt'></i>Time-In</a>
                                        </td>";
                                    echo "<td align='center'>
                                            <a  href='#' data-toggle='modal' data-target='#timeoutModal' type='button' class='btn btn-danger timeout' id='timein-$cust_id' style='border-radius: 0px;'><i class='fas fa-fw fa-list-alt'></i>Time-Out</a>
                                        </td>";
                                    echo '</tr> ';
                                };
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-xs-12">
                    <h4 class="m-2 font-weight-bold">Session Logs - <?php echo $date_today ?></h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Time-In</th>
                                <th>Time-Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                  
                                $query = "SELECT a.*, b.first_name, b.middle_name, b.last_name, b.type FROM session_logs a LEFT JOIN customer b ON a.cust_id = b.cust_id WHERE time_in LIKE '%$date_today%' ORDER BY time_in DESC";
                                $result = mysqli_query($db, $query) or die (mysqli_error($db));

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $first_name_session = $row['first_name'];
                                    $middle_name_session = $row['middle_name'];
                                    $last_name_session = $row['last_name'];
                                    $type = $row['type'];
                                    $time_in = $row['time_in'];
                                    $time_out = $row['time_out'];
                                    echo '<tr>';
                                    echo '<td>'.$first_name_session.' '.$middle_name_session.' '.$last_name_session.'</td>';
                                    echo '<td>'.$type.'</td>';
                                    echo '<td>'.$time_in.'</td>';
                                    echo '<td>'.$time_out.'</td>';
                                    echo '</tr> ';
                                };
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include'../includes/footer.php';
?>

<script>
    window.onload = startTime();
    $("#dataTable").on("click", ".timein", function(){
        var id = (this.id).slice(7);
        $("#cust_id").val(id);
        $("#name").html($("#" + id + " td:nth-child(2)").text());
        $("#type").html($("#" + id + " td:nth-child(5)").text());
    });

    $("#dataTable").on("click", ".timeout", function(){
        var id = (this.id).slice(7);
        $("#cust_id_time_out").val(id);
        $("#name_time_out").html($("#" + id + " td:nth-child(2)").text());
        $("#type_time_out").html($("#" + id + " td:nth-child(5)").text());
    });
</script>