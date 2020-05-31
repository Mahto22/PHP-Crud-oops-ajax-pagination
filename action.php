<?php 

require_once 'db.php';

$db = new Database();

if(isset($_POST['action']) && $_POST['action'] == "view"){
 $output = '';
 $data = $db->read();

 //print_r($data);

 if($db->totalRowCount() > 0){
 	$output .= '<table class="table table-striped table-sm table-bordered">
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>Name</th>
							<th>Address</th>
							<th>Salary</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';

					foreach($data as $row){
						$output .= '<tr class="text-center text-secondary">
						<td>'.$row['id'].'</td>
						<td>'.$row['user_name'].'</td>
						<td>'.$row['address'].'</td>
						<td>'.$row['salary'].'</td>
						<td>'.$row['phone'].'</td>
						<td>
						<a href="#" title="view details" class="text-primary infoBtn" id=" '.$row['id'].' "><li class="fas fa-info-circle fa-lg" arial-hidden="true"></li></a> &nbsp; &nbsp;
						<a href="#" title="Edit User" class="text-success editBtn" data-toggle="modal" data-target="#editModal" id=" '.$row['id'].' "><li class="fas fa-edit fa-lg"></li></a> &nbsp; &nbsp;
								<a href="#" title="Delete" class="text-danger delBtn" id=" '.$row['id'].' "><li class="fas fa-trash-alt fa-lg"></li></a>
							</td>
							</tr>';
					}
					$output .= '</tbody>
					            </table>';
					            echo $output;
 }
 else{
 	echo '<h3 class="text-center text-secondary mt-5">:( No data found</h3>';
 }
}

//insert data
if(isset($_POST['action']) && $_POST['action'] == "insert"){

	$user_name = $_POST['user_name'];
	$address = $_POST['address'];
	$salary = $_POST['salary'];
	$phone = $_POST['phone'];

	$db->insert($user_name,$address,$salary,$phone);
}

//edit data
 if(isset($_POST['edit_id'])){
  $id = $_POST['edit_id'];

  $row = $db->getUserById($id);
  echo json_encode($row); 
  //array to json formate and send to the client
 }
 if(isset($_POST['action']) && $_POST['action'] == "update"){

 	$id = $_POST['id'];
     $user_name = $_POST['user_name'];
 	$address = $_POST['address'];
 	$salary = $_POST['salary'];
 	$phone = $_POST['phone'];

 	$db->update($id,$user_name,$address,$salary,$phone);
 }

 //delete data
 if(isset($_POST['del_id'])){
 	$id = $_POST['del_id'];

 	$db->delete($id);
 }

 // view details 
 if(isset($_POST['info_id'])){
 	$id = $_POST['info_id'];
 	$row = $db->getUserById($id);
 	echo json_encode($row);
 }

 //export data in excel
 if(isset($_GET['export']) && $_GET['export'] == 'excel'){
 	header('Content-Type: application/xls');
 	header('Content-Disposition:attachment; filename=emp_tbl.xls');
 	header('Pragma: no-cache');
 	header('Expires:0');

 	$data = $db->read();
 	echo '<table border="1">';
 	echo '<tr><th>ID</th><th>User Name</th><th>Address</th><th>Salary</th><th>Phone</th></tr>';

 	foreach($data as $row){
 		echo '<tr>
 		      <td>'.$row['id'].'</td>
 		      <td>'.$row['user_name'].'</td>
 		      <td>'.$row['address'].'</td>
 		      <td>'.$row['salary'].'</td>
 		      <td>'.$row['phone'].'</td>
 		      </tr>';
 	}
 	echo '</table>';
 }
?>