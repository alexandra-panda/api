<?php
	// Include config.php file
	include_once('config.php');

	$dbObj = new Database();

	// Insert Record	
	if (isset($_POST['action']) && $_POST['action'] == "insert") {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$dob = $_POST['dob'];
		$dbObj->insertRecond($name, $email, $username, $dob);
	}

	// View record
	if (isset($_POST['action']) && $_POST['action'] == "view") {
		$output = "";

		$customers = $dbObj->displayRecord();

		if ($dbObj->totalRowCount() > 0) {
			$output .="<table class='table table-striped table-hover'>
			        <thead>
			          <tr>
			            <th>Id</th>
			            <th>Name</th>
			            <th>Email</th>
			            <th>Username</th>
			            <th>Date of birth</th>
			            <th>Action</th>
			          </tr>
			        </thead>
			        <tbody>";
			foreach ($customers as $customer) {
			$output.="<tr>
			            <td>".$customer['id']."</td>
			            <td>".$customer['name']."</td>
			            <td>".$customer['email']."</td>
			            <td>".$customer['username']."</td>
			            <td>".date('d-M-Y', strtotime($customer['dob']))."</td>
			            <td>
			              <a href='#editModal' style='color:green' data-toggle='modal' 
			              class='editBtn' id='".$customer['id']."'><i class='fa fa-pencil'></i></a>&nbsp;
			              <a href='' style='color:red' class='deleteBtn' id='".$customer['id']."'>
			              <i class='fa fa-trash' ></i></a>
			            </td>
			        </tr>";
				}
			$output .= "</tbody>
      		</table>";
      		echo $output;	
		}else{
			echo '<h3 class="text-center mt-5">No records found</h3>';
		}
	}

	// Edit Record	
	if (isset($_POST['editId'])) {
		$editId = $_POST['editId'];
		$row = $dbObj->getRecordById($editId);
		echo json_encode($row);
	}

?>