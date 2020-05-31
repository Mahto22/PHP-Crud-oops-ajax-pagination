<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
	<title>TechSpawn Test</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- dataTable pagignation CSS -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
 
</head>
<body>

<!-- navbar start -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><i class="fas fa-pen"></i>&nbsp;TechSpawn</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Service</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
</nav>
<!-- navbar end -->

<!-- main section start -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h4 class="text-center text-uppercase text-danger font-weight-normal my-3">Employee Details</h4>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<h5 class="mt-2 text-primary">Records display in salary range 1000 to 50000</h5>
		</div>
			<div class="col-lg-6">
				<button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal"><li class="fas fa-user-plus fa-lg"></li>&nbsp; Add New User</button>
				<a href="action.php?export=excel" class="btn btn-success m-1 float-right"><li class="fas fa-table fa-lg"></li>&nbsp; Export to Excel</a>
			</div>
	</div>
	<hr class="my-1">

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive" id="showUser">
						
			</div>
		</div>
	</div>
</div>
<!-- main section end -->

<!--Add new Employee Modal  start-->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">
          <form action="" method="post" id="form-data">
          	<div class="form-group">
          		<input type="text" class="form-control" name="user_name" placeholder="Full Name" pattern="[A-Za-z]{3,20}" minlength="3" maxlength="20" title="Must be 3 character" required>
          	</div>
          	<div class="form-group">
          		<textarea class="form-control" name="address" placeholder="Address" required></textarea>
          	</div>
          	<div class="form-group">
          		<input type="number" class="form-control" name="salary" placeholder="Salary" required>
          	</div>
          	<div class="form-group">
          		<input type="tel" class="form-control" name="phone" placeholder="Contact" pattern="^\d{10}$" title="allow 10 digit only" 
           required="required">
          	</div>
          	<div class="form-group">
          		<input type="submit" name="insert" id="insert" value="Add User" class="btn btn-primary btn-block">
          	</div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <!--Add new Employee Modal  end-->


<!--Edit the Employee Modal  start-->
  <div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">
          <form action="" method="post" id="edit-form-data">

          	<input type="hidden" name="id" id="id">

          	<div class="form-group">
          		<input type="text" class="form-control" name="user_name" id="user_name" required>
          	</div>
          	<div class="form-group">
          		<textarea class="form-control" name="address" id="address" required></textarea>
          	</div>
          	<div class="form-group">
          		<input type="number" class="form-control" name="salary" id="salary" required>
          	</div>
          	<div class="form-group">
          		<input type="number" class="form-control" name="phone" id="phone" required>
          	</div>
          	<div class="form-group">
          		<input type="submit" name="update" id="update" value="Update" class="btn btn-success btn-block">
          	</div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <!--Edit the Employee Modal  end-->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- fontawesome file -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- dataTable pagignation javascript -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>

<!-- sweetAlert2 javascript file -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- dataTable js,ajax call script start-->
<script type="text/javascript">
	$(document).ready(function(){
     

     showAllUsers();

     function showAllUsers(){
     	$.ajax({
     		url: 'action.php',
     		type: 'post',
     		data: {action:"view"},
     		success:function(response){
     			//console.log(response);
     			$('#showUser').html(response);
     			// dataTable js script
     			$('table').DataTable({
     				order: [0, 'asc'] //show current recond on top
     			});
     		}
     	});
     }

//      //insert ajax request
      $('#insert').click(function(e){
       if($('#form-data')[0].checkValidity()){
       	e.preventDefault();
       	$.ajax({
       		url:'action.php',
       		type: 'post',
       		data: $('#form-data').serialize()+"&action=insert",
       		success: function(response){
       			//console.log(response);
       			Swal.fire({ //sweet alert modal
       				title: 'User added successfully!',
       				icon: 'success'
      			})
       			$('#addModal').modal('hide');
       			$('#form-data')[0].reset();
       			showAllUsers();
     		}
      	});
       }
      });

       //edit ajax request
       $('body').on('click','.editBtn',function(e){
       	//console.log("working");
       	e.preventDefault();
       	edit_id = $(this).attr('id');
       	$.ajax({
       		url:'action.php',
       		title: 'post',
       		data:{edit_id:edit_id},
            success:function(response){
       			
       			data = JSON.parse(response); //data convert from json into js object
       			//console.log(data);
       			$("#id").val(data.id);
       			$("#user_name").val(data.user_name);
       			$("#address").val(data.address);
       			$("#salary").val(data.salary);
       			$("#phone").val(data.phone);
       		}
       	});
       });

	//update ajax request
	$('#update').click(function(e){
      if($('#edit-form-data')[0].checkValidity()){
      	e.preventDefault();
      	$.ajax({
      		url:'action.php',
      		type: 'post',
      		data: $('#edit-form-data').serialize()+"&action = update",
      		success: function(response){
      			//console.log(response);
      			Swal.fire({ //sweet alert modal
      				title: 'Edit successfully !',
      				icon: 'success'
      			})
      			$('#editModal').modal('hide');
      			$('#edit-form-data')[0].reset();
      			showAllUsers();
      		}
      	});
      }
      }); 


//       //delete ajax request
       $('body').on('click','.delBtn',function(e){
           e.preventDefault(); //stop refreshing the hole page
           var tr = $(this).closest('tr');
           del_id = $(this).attr('id');

           //sweet2 alert
           Swal.fire({
   title: 'Are you sure?',
   text: "You won't be able to revert this!",
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete it!'
 }).then((result) => {
   if (result.value) {
   	$.ajax({
   		url:'action.php',
   		type:'post',
   		data:{del_id:del_id},
   		success:function(response){
   		//console.log(response);
   		tr.css('background-color','#ff6666');
   		Swal.fire('Deleted !',
   			'User deleted successfully',
   			'success')
   		showAllUsers();
   	}
   	});
   }
    });
 });

// view details ajax request 
$('body').on('click','infoBtn',function(e){
	e.preventDefault();
	info_id = $(this).attr('id');
	$.ajax({
		url:'action.php',
		type:'post',
		data:{info_id:info_id},
		success:function(response){
			//console.log(response);
			data = JSON.parse(response);

			Swal.fire({
				title:'<strong>User Info : ID('+data.id+')</strong>',
				icon:'info',
				html:'<b>User Name :</b>'+data.user_name+'<br><b>Address :</b>'+data.address+'<br><b>Salary :</b>'+data.salary+'<br><b>Phone :</b>'+data.phone,
				showCancelButton:true,
			});
		}
	});
});
});
</script>
<!-- dataTable js,ajax call script end-->

</body>
</html>