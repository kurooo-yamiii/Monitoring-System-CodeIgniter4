<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("StudentController/logout"));
    exit();
}
?>
<form id="profile">
	<div class="dashboard">
		<p class="announce-para">User <span> Profile</span></p>
		<div class="logos">
			<div class="logo">
				<img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50" />
			</div>
			<div class="logo">
				<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50" />
			</div>
		</div>
	</div>
    <input type="number" id="UserId" value="<?php echo $_SESSION['ID']?>" hidden>

    <div class="divider"></div>
		<div class="space"></div>
			<div id="FetchUser">
	
			</div>
	
	<!-- UPDATE PROFILE MODAL -->
	<div class="modal fade" id="UpdateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 38%;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								EDIT USER PROFILE
							</div>	
						</h5>
					<button type="button" onclick="ClearInformation()" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				
					<div class="col-md-12">
						<div class="prof-center">
							  <img id="updatePicPrev" style="display:none; max-width: 250px; max-height: 250px;" />
						</div>
						 <div class="space"></div>
						 <div class="choose-post form-control" style="display: flex; flex-direction: row; justify-content: space-between; height: auto !important;">
							  <label>PROFILE PICTURE: </label>
							  <input type="file" name="img" id="updatePic" />
						 </div>
					</div>	
					 <div class="space"></div>
					   
					<input type="id" class="form-control" id="ID" name="id" value="<?php echo $_SESSION['ID']; ?>" hidden>
						  
					<div class="col-md-12">
						  <label>NAME</label>
						  <input type="text" class="form-control" id="NameUser">
					</div>
                    <div class="space"></div>
                    <div class="row" style="padding: 0px 15px;">
                    <div class="col-md-6">
						  <label>SECTION</label>
						  <input type="text" class="form-control" id="SectionUser">
					</div>
                    <div class="col-md-6">
						  <label>PROGRAM</label>
						  <input type="text" class="form-control" id="ProgramUser">
					</div>
                    </div>
                    <div class="space"></div>
                    <div class="row" style="padding: 0px 15px;">
                    <div class="col-md-6">
						  <label>CONTACT</label>
						  <input type="text" class="form-control" id="ContactUser">
					</div>
					<div class="col-md-6">
						  <label>PASSWORD</label>
						  <input type="text" class="form-control" id="PassUser">
					</div>
                    </div>
				</div>
				<div class="modal-footer" style="margin-top: 5%;">
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="ClearInformation()">Close</button>
					<button type="button" class="btn btn-primary" id="SaveUser" onclick="UpdateUserProfile(event)">Save</button>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	
	  $(function () {
		GetProfileUser();
	  });

		function GetProfileUser() {
			var userID = $('#UserId').val().trim(); 
			$.ajax({
				type: 'POST',
				url: '<?php echo site_url('StudentController/GetStudentProfile'); ?>',
				data: { ID: userID },
				success: function(response) {
					var userDiv = $('#FetchUser'); 
					var profileImage = $('#profileHandler');
					response.forEach(function (user) {
						var profileImageSrc = user.Profile ? `<?= base_url('assets/uploads/') ?>${user.Profile}` : '<?= base_url('assets/img/default.jpeg') ?>';
						
						profileImage.empty();
						
						var newProfile = $(`<img src="${profileImageSrc}" alt="Profile Image">`);
						var modifyUser = $(`
                        <div class="prof-center">
								<img class="profile-image" src="${profileImageSrc}">
							</div>
							<div class="indent-left">
								<p class="prof-title">I. Profile</p>
								<table class="prof-table">
									<tr>
										<th class="profile-th" style="text-align: left !important;">Name:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Name}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Section:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Section}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Program:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Program}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Contact:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Contact}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Email:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Username}</td>
									</tr>
								</table>
							</div>
							<div class="indent-left">
								<p class="prof-title">II. Deployment Info</p>
								<table class="prof-table">
									<tr>
										<th class="profile-th" style="text-align: left !important;">Supervisor:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Supervisor ? user.Supervisor : ''}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Coordinator:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Coordinator ? user.Coordinator  : ''}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">School:</th>
										<td class="profile-td" style="text-align: left !important;">${user.School ? user.School : ''}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Resource:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Resource ? user.Resource : ''}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Division:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Division ? user.Division : ''}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Grade Level:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Grade ? user.Grade  : ''}</td>
									</tr>
								</table>
							</div>
							</div>
							<div class="space"></div>
							<div class="divider"></div>
							<div class="button-container">
								<a class="btn btn-primary" data-toggle="modal" data-target="#UpdateProfile" onclick="constructUpdate('${user.Name}', '${user.Password}', '${user.Program}', '${user.Section}', '${user.Contact}', '${profileImageSrc}')">Update Profile</a>
							</div>
						`);
						userDiv.append(modifyUser);
						profileImage.append(newProfile);
					});              
				},
				error: function(error) {
					console.error("Error fetching user profile:", error);
				}
			});
		}

        function UpdateUserProfile(e) {
			var formData = new FormData();
			
			formData.append('name', document.getElementById('NameUser').value);
			formData.append('password', document.getElementById('PassUser').value);
            formData.append('section', document.getElementById('SectionUser').value);
            formData.append('program', document.getElementById('ProgramUser').value);
            formData.append('contact', document.getElementById('ContactUser').value);
			formData.append('ID', document.getElementById('ID').value);

			var imgInput = document.getElementById('updatePic');
			if (imgInput.files.length > 0) {
				formData.append('img', imgInput.files[0]);
			}
			
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?php echo site_url('StudentController/UpdateUserProfile'); ?>',
				data: formData,
				contentType: false, 
				processData: false, 
				success: function(response) {
						$('#FetchUser').empty();
					    GetProfileUser(); 
						$('#UpdateProfile').modal('hide'); 
                        ClearInformation();
						message('success', 'Profile Updated Successfully', 2000); 
				},
				error: function(xhr) {
					try {
						var errorResponse = JSON.parse(xhr.responseText);
						if (errorResponse.message) {
							message('error', errorResponse.message, 2000);
						} else {
							message('error', 'An unexpected error occurred. Please try again.', 2000);
						}
					} catch (e) {
						message('error', 'An unexpected error occurred. Please try again.', 2000);
					}
				}
			});
		}

        function ClearInformation() {
			$('#updatePicPrev').attr('src', '').hide();
		}

		function constructUpdate(name, password, program, section, contact, imgUrl) {
			if(imgUrl !== ''){
                const imagePreview = document.getElementById('updatePicPrev');
                imagePreview.src = imgUrl;
                imagePreview.style.display = 'block'; 
            }
			$('#NameUser').val(name);
			$('#PassUser').val(password);
            $('#ProgramUser').val(program);
            $('#SectionUser').val(section);
            $('#ContactUser').val(contact);
		}

		document.getElementById('updatePic').addEventListener('change', function(event) {
			const file = event.target.files[0];
			const preview = document.getElementById('updatePicPrev');
			
			if (file) {
				const reader = new FileReader();
				
				reader.onload = function(e) {
					preview.src = e.target.result;
					preview.style.display = 'block';
				};
				
				reader.readAsDataURL(file);
			} else {
				preview.src = '';
				preview.style.display = 'none';
			}
		});

        function message(icon,message,duration){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: duration,
                timerProgressBar: true
            })

            Toast.fire({
                icon: icon,
                title: message
            })
            return false;		
        }
    
</script>