<div class="alert" id="alertBox" style="display:none;">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
	<div id="alertContent" style="text-align:center;"></div>
</div>


<h4>
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Create New User</a></li>
  <li><a href="#update" data-toggle="tab">Update User</a></li>
  <li><a href="#delete" data-toggle="tab">Delete User</a></li>
  <li><a href="#listall" data-toggle="tab">List Users</a></li>
 </ul>
</h4>
<div id="myTabContent" class="tab-content">
  		
  <div class="tab-pane fade active in" id="home">
  	<form class="form-horizontal container" id="signUpForm">
		<fieldset>
			<div class="form-group">
				<label for="inputUsername" class="col-lg-2 control-label">Username</label>
				<div class="col-lg-10">
					<input class="form-control" id="inputUserName" placeholder="username" type="text">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10">
					<input class="form-control" id="inputEmail" placeholder="sachin_tendulkar@gmail.com" type="email">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail" class="col-lg-2 control-label">Father Name</label>
				<div class="col-lg-10">
					<input class="form-control" id="inputFatherName" placeholder="Father Name" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Gender</label>
				<div class="col-lg-10">
					<select class="form-control" id="inputGender">
						<option value="-1">Select one</option>
						<option value="1">Male</option>
						<option value="2">Female</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-default" id="resetForm">Cancel</button>
					<button type="button" class="btn btn-primary" id="submitForm">Submit</button>
				</div>
			</div>
		</fieldset>
	</form>
  </div>
  <div class="tab-pane fade" id="update">
  <form class="form-horizontal container" id="signUpForm">
		<fieldset>
			<div class="form-group">
				<label for="queryUsername" class="col-lg-2 control-label"> Username</label>
				<div class="col-lg-10">
					<input class="form-control" id="queryUserName" placeholder="username" type="text">
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="button" class="btn btn-primary" id="getUserDetails">Get UserDetails</button>
				</div>
			</div>
		</fieldset>
	</form>
	<form class="form-horizontal container" id="retrievedBox" style="display:none;" >
		<div class="form-group">
				<label for="retrievedEmail" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10">
					<input class="form-control" id="retrievedEmail" placeholder="retrievedEmail" type="email">
				</div>
		</div>
		<div class="form-group">
				<label for="retrievedFatherName" class="col-lg-2 control-label">Father Name</label>
				<div class="col-lg-10">
					<input class="form-control" id="retrievedFatherName" placeholder="Father Name" type="text">
				</div>
		</div>
		<div class="form-group">
				<label for="retrievedGender" class="col-lg-2 control-label">Gender</label>
				<div class="col-lg-10">
					<select class="form-control" id="retrievedGender">
						<option value="-1">Select one</option>
						<option value="1">Male</option>
						<option value="2">Female</option>
					</select>
				</div>
		</div>
		<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="button" class="btn btn-primary" id="updateUserDetails">Update UserDetails</button>
				</div>
		</div>
	</form>
  </div>
  
  <div class="tab-pane fade" id="delete">
  	<form class="form-horizontal container" id="deleteForm">
  		<fieldset>
  		<div class="form-group">
				<label for="queryUsername" class="col-lg-2 control-label"> Username</label>
				<div class="col-lg-10">
					<input class="form-control" id="queryDelUserName" placeholder="username" type="text">
				</div>
			</div>
  		<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="button" class="btn btn-primary" id="deleteUser">Delete User</button>
				</div>
		</fieldset>
		</form>
  	</div>
  	<div class="tab-pane fade" id="listall">
  	
  		<table class="table table-bordered table-hover table-condensed" id="listAllUsers">
  			<thead>
  				<tr>
  					<td>ID#</td>
  					<td>Username</td>
  					<td>Email</td>
  					<td>FatherName</td>
  					<td>Date of SignUp</td>
  				</tr>
  			</thead>
  			<tbody>
  				<?php if($users){
  				 foreach ($users as $key => $value) {
  					echo "<tr>";
  					foreach ($value as $key => $val) {
  							echo "<td>".$val."</td>";
  						}	
  					echo "</tr>";
  				}
  			}
  				?>
  			</tbody>
  		</table>

  	</div>
  </div>
</div>
</div>
<script>

$('#deleteUser').on('click',function(){
	var username=$('#queryDelUserName').val();
	var request = $.ajax({
			url: "<?=base_url()?>/index.php/registration/delete_user",
			method: "POST",
			data: { username : username},
			dataType: "html"
		});
	request.done(function(msg){
		console.log(msg);
		var jsonMsg=JSON.parse(msg);
		$('#alertBox').show();
		$( "#alertContent" ).html( jsonMsg.text );
		$('#alertBox').addClass('alert-'+jsonMsg.type);
	});
	request.fail(function( jqXHR, textStatus ) {
			var jsonMsg=JSON.parse(jqXHR.responseText);
			
			$('#alertBox').show();
			$( "#alertContent" ).html( jsonMsg.text);
			$('#alertBox').addClass('alert-danger');
			$('#queryUserName').val("");
		});
});

$('#getUserDetails').on('click',function(){
	var userName=$('#queryUserName').val();
	var request = $.ajax({
			url: "<?=base_url()?>/index.php/registration/get_user_details",
			method: "POST",
			data: { username : userName},
			dataType: "html"
		});

		request.done(function( msg ) {
			console.log(msg);
			var jsonMsg=JSON.parse(msg);
			$('#alertBox').show();
			$( "#alertContent" ).html( "User details for "+jsonMsg[0].username +" retrieved");
			$('#alertBox').addClass('alert-info');
			$('#retrievedBox').show();
			$('#retrievedEmail').val(jsonMsg[0].email);
			$('#retrievedFatherName').val(jsonMsg[0].fathername);
			$('#retrievedGender').val(jsonMsg[0].gender);
		});

		request.fail(function( jqXHR, textStatus ) {
			
			var jsonMsg=JSON.parse(jqXHR.responseText);
			
			$('#alertBox').show();
			$( "#alertContent" ).html( jsonMsg.text);
			$('#alertBox').addClass('alert-danger');
			$('#queryUserName').val("");
		});
});

	$('#updateUserDetails').on('click',function(){
		var userName=$('#queryUserName').val();
		var email=$('#retrievedEmail').val();
		var fathername=$('#retrievedFatherName').val();
		var gender=$('#retrievedGender').val();
		var request = $.ajax({
			url: "<?=base_url()?>/index.php/registration/update_user_details",
			method: "POST",
			data: { username : userName, email:email, fathername:fathername, gender:gender},
			dataType: "html"
		});

		request.done(function( msg ) {
			
			var jsonMsg=JSON.parse(msg);
			$('#alertBox').show();
			$( "#alertContent" ).html( jsonMsg.text );
			$('#alertBox').addClass('alert-'+jsonMsg.type);
		});

		request.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		});
	});

	$('#submitForm').on("click",function(){
		var userName=$('#inputUserName').val();
		var email=$('#inputEmail').val();
		var fatherName=$('#inputFatherName').val();
		var gender=$('#inputGender').val();
		var request = $.ajax({
			url: "<?=base_url()?>/index.php/registration/register_new_user",
			method: "POST",
			data: { username : userName, email: email, fathername: fatherName, gender: gender },
			dataType: "html"
		});

		request.done(function( msg ) {
			
			var jsonMsg=JSON.parse(msg);
			$('#alertBox').show();
			$( "#alertContent" ).html( jsonMsg.text );
			$('#alertBox').addClass('alert-'+jsonMsg.type);
		});

		request.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		});
	});

</script>