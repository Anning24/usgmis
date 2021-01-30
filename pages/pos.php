<?php
  include'../includes/connection.php';
  include'../includes/topp.php';
    // session_start();
    $product_ids = array();
    //session_destroy();

    //check if Add to Cart button has been submitted
    if(filter_input(INPUT_POST, 'addpos'))
    {
      if(isset($_SESSION['pointofsale']))
      {

        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['pointofsale']);

        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['pointofsale'], 'id');

        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids))
        {
          $_SESSION['pointofsale'][$count] = array
          (
          'id' => filter_input(INPUT_GET, 'id'),
          'name' => filter_input(INPUT_POST, 'name'),
          'price' => filter_input(INPUT_POST, 'price'),
          'quantity' => filter_input(INPUT_POST, 'quantity')
          );   
        }
        else 
        { //product already exists, increase quantity
          //match array key to id of the product being added to the cart
          for ($i = 0; $i < count($product_ids); $i++)
          {
            if ($product_ids[$i] == filter_input(INPUT_GET, 'id'))
            {
              //add item quantity to the existing product in the array
              $_SESSION['pointofsale'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
            }
          }
        }
      }
      else 
      { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['pointofsale'][0] = array
        (
        'id' => filter_input(INPUT_GET, 'id'),
        'name' => filter_input(INPUT_POST, 'name'),
        'price' => filter_input(INPUT_POST, 'price'),
        'quantity' => filter_input(INPUT_POST, 'quantity')
        );
      }
    }

    if(filter_input(INPUT_GET, 'action') == 'delete')
    {
      //loop through all products in the shopping cart until it matches with GET id variable
      foreach($_SESSION['pointofsale'] as $key => $product)
      {
        if ($product['id'] == filter_input(INPUT_GET, 'id'))
        {
        //remove product from the shopping cart when it matches with the GET id
        unset($_SESSION['pointofsale'][$key]);
        }
      }
      //reset session array keys so they match with $product_ids numeric array
      $_SESSION['pointofsale'] = array_values($_SESSION['pointofsale']);
    }

  //pre_r($_SESSION);

    function pre_r($array)
    {
      echo '<pre>';
      print_r($array);
      echo '</pre>';
    }
?>
<!-- TAB PANE -->
<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-0">
      <div class="card-header py-2">
        <h4 class="m-1 text-lg text-primary">Product category</h4>
      </div> <!-- /.panel-heading -->
      <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
        <?php 
            $query = "SELECT * FROM category";
            $result = mysqli_query($db, $query) or die (mysqli_error($db));

            while ($row = mysqli_fetch_assoc($result)) {
              $cname = $row["CNAME"];
              $cname_tolower = strtolower($cname);
              echo "<li class='nav-item'>
                    <a class='nav-link' href='#$cname_tolower' data-target='#$cname_tolower' data-toggle='tab'>$cname</a>
                    </li>
              ";
            }
        ?>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
        <?php
            // select category id
            $query = "SELECT * FROM category";
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            //print items per category
            while ($row = mysqli_fetch_assoc($result)) 
            {
              $category_id = $row["CATEGORY_ID"];
              $cname = $row["CNAME"];
              $cname_tolower = strtolower($cname);

              echo "<div class='tab-pane fade in mt-2' id='$cname_tolower'>
                    <div class='row'>";
              
              $query1 = "SELECT * FROM product WHERE CATEGORY_ID=$category_id GROUP BY PRODUCT_CODE ORDER by PRODUCT_CODE ASC";
              $result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
              while($product = mysqli_fetch_assoc($result1)):
              {
                $product_id = $product['PRODUCT_ID'];
                $product_name = $product['NAME'];
                $product_price = $product['PRICE'];
                echo"
                  <div class='col-sm-4 col-md-2'>
                    <form method='post' action='pos.php?action=add&id=$product_id'>
                      <div class='products'>
                        <h6 class='text-info'>$product_name</h6>
                        <h6>₱ $product_price</h6>
                        <input type='text' name='quantity' class='form-control' value='1'/>
                        <input type='hidden' name='name' value='$product_name'/>
                        <input type='hidden' name='price' value='$product_price'/>
                        <input type='submit' name='addpos' style='margin-top:5px;' class='btn btn-info' value='Add'/>
                      </div>
                    </form>
                  </div>
                ";
              }
              endwhile;
              echo "</div>
                    </div>
              ";
            }
        ?>
        </div>
      </div> <!-- /.panel-body -->
    </div>
  </div>
</div>
<!-- END TAB PANE AREA-->

<div style="clear:both"></div>  
<br/>  
  <div class="card shadow mb-4 col-md-12">
    <div class="card-header py-3 bg-white">
      <h4 class="m-2 font-weight-bold text-primary">Point of Sale</h4>
    </div>

    <div class="row">    
      <div class="card-body col-md-9">
        <div class="table-responsive">
          <!-- trial form lang   -->
          <form role="form" method="post" action="pos_transac.php?action=add">
            <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
            <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">

            <table class="table">    
              <tr>  
                <th width="55%">Product Name</th>  
                <th width="10%">Quantity</th>  
                <th width="15%">Price</th>  
                <th width="15%">Total</th>  
                <th width="5%">Action</th>
              </tr>  
              <?php
                if(!empty($_SESSION['pointofsale'])):  
                $total = 0;  
                foreach($_SESSION['pointofsale'] as $key => $product): 
              ?>
              <tr>  
                <td>
                  <input type="hidden" name="name[]" value="<?php echo $product['name']; ?>">
                  <?php echo $product['name']; ?>
                </td>  
                <td>
                  <input type="hidden" name="quantity[]" value="<?php echo $product['quantity']; ?>">
                  <?php echo $product['quantity']; ?>
                </td>  
                <td>
                  <input type="hidden" name="price[]" value="<?php echo $product['price']; ?>">
                  ₱ <?php echo number_format($product['price']); ?>
                </td>  
                <td>
                  <input type="hidden" name="total" value="<?php echo $product['quantity'] * $product['price']; ?>">
                  ₱ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
                <td>
                  <a href="pos.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn bg-gradient-danger btn-danger"><i class="fas fa-fw fa-trash"></i></div>
                  </a>
                </td>  
              </tr>
              <?php  
                $total = $total + ($product['quantity'] * $product['price']);
                endforeach;
                endif;
              ?>
            </table> 
          </div>
        </div> 

<!-- SIDE PART NA SUMMARY -->
<div class="card-body col-md-3">
<?php   
if(!empty($_SESSION['pointofsale'])):  

$total = 0;  

foreach($_SESSION['pointofsale'] as $key => $product): 
?>  
<?php  
$total = $total + ($product['quantity'] * $product['price']);
$lessvat = ($total / 1.12) * 0.12;
$netvat = ($total / 1.12);
$addvat = ($total / 1.12) * 0.12;

endforeach;

//DROPDOWN FOR CUSTOMER
$sql = "SELECT CUST_ID, FIRST_NAME, LAST_NAME
FROM customer
order by FIRST_NAME asc";
$res = mysqli_query($db, $sql) or die ("Error SQL: $sql");

$opt = "<select class='form-control'  style='border-radius: 0px;' name='customer' required>
<option value='' disabled selected hidden>Select Customer</option>";
while ($row = mysqli_fetch_assoc($res)) {
$opt .= "<option value='".$row['CUST_ID']."'>".$row['FIRST_NAME'].' '.$row['LAST_NAME']."</option>";
}
$opt .= "</select>";
// END OF DROP DOWN
?>  
<?php 
echo "Today's date is : "; 
$today = date("Y-m-d H:i a");
echo $today; 
?> 
<input type="hidden" name="date" value="<?php echo $today; ?>">
<div class="form-group row text-left mb-3">
<div class="col-sm-12 text-primary btn-group">
<?php echo $opt; ?>
<a  href="#" data-toggle="modal" data-target="#poscustomerModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a>
</div>

</div>
<div class="form-group row mb-2">

<div class="col-sm-5 text-left text-primary py-2">
<h6>
Subtotal
</h6>
</div>
<div class="col-sm-7">
<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">₱</span>
</div>
<input type="text" class="form-control text-right " value="<?php echo number_format($total, 2); ?>" readonly name="subtotal">
</div>
</div>

</div>
<div class="form-group row mb-2">

<div class="col-sm-5 text-left text-primary py-2">
<h6>
Less VAT
</h6>
</div>

<div class="col-sm-7">
<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">₱</span>
</div>
<input type="text" class="form-control text-right " value="<?php echo number_format($lessvat, 2); ?>" readonly name="lessvat">
</div>
</div>

</div>
<div class="form-group row mb-2">

<div class="col-sm-5 text-left text-primary py-2">
<h6>
Net of VAT
</h6>
</div>

<div class="col-sm-7">
<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">₱</span>
</div>
<input type="text" class="form-control text-right " value="<?php echo number_format($netvat, 2); ?>" readonly name="netvat">
</div>
</div>

</div> 
<div class="form-group row mb-2">

<div class="col-sm-5 text-left text-primary py-2">
<h6>
Add VAT
</h6>
</div>

<div class="col-sm-7">
<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">₱</span>
</div>
<input type="text" class="form-control text-right " value="<?php echo number_format($addvat, 2); ?>" readonly name="addvat">
</div>
</div>

</div>
<div class="form-group row text-left mb-2">

<div class="col-sm-5 text-primary">
<h6 class="font-weight-bold py-2">
Total
</h6>
</div>

<div class="col-sm-7">
<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">₱</span>
</div>
<input type="text" class="form-control text-right " value="<?php echo number_format($total, 2); ?>" readonly name="total">
</div>
</div>

</div>
<?php endif; ?>       
<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#posMODAL">SUBMIT</button>

<!-- Modal -->
<div class="modal fade" id="posMODAL" tabindex="-1" role="dialog" aria-labelledby="POS" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalCenterTitle">SUMMARY</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="form-group row text-left mb-2">

<div class="col-sm-12 text-center">
<h3 class="py-0">
GRAND TOTAL
</h3>
<h3 class="font-weight-bold py-3 bg-light">
₱ <?php echo number_format($total, 2); ?>
</h3>
</div>

</div>

<div class="col-sm-12 mb-2">
<div class="input-group mb-2">
<div class="input-group-prepend">
<span class="input-group-text">₱</span>
</div>
<input class="form-control text-right" id="txtNumber" onkeypress="return isNumberKey(event)" type="text" name="cash" placeholder="ENTER CASH" name="cash" required>
</div>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary btn-block">PROCEED TO PAYMENT</button>
</div>
</div>
</div>
</div>
<!-- END OF Modal -->

</form>
</div> <!-- END OF CARD BODY -->

</div>
</div>


<?php
include '../includes/footer.php';
?>