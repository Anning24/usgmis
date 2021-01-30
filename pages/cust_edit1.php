<?php
include('../includes/connection.php');
			$cust_id = $_POST['cust_id'];

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
		
	 			$query = "UPDATE customer a JOIN emergency_contact b on a.cust_id = b.cust_id
				 SET
				 a.first_name = '$first_name',
				 a.middle_name = '$middle_name',
				 a.last_name = '$last_name',
				 a.birth_date = '$birth_date',
				 a.sex = '$sex',
				 a.status = '$status',
				 a.street = '$street',
				 a.city = '$city',
				 a.province = '$province',
				 a.phone_number = '$phone_number',
				 b.full_name = '$full_name',
				 b.relationship = '$relationship',
				 b.phone_number = '$emergency_contact_phone_number',
				 b.address = '$emergency_contact_address'
				 WHERE
				 a.cust_id = '$cust_id'
				 ";
				$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
		alert("Customer Update Successful!");
		window.location = "customer.php";
	</script>