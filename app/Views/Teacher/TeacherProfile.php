<form>
	<div class="dashboard">
		<p class="announce-para">User <span style="color: rgba(100, 50, 30);"> Profile</span></p>
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
	<input type="number" id="StudentId" value="<?php echo $_SESSION['Student']?>" hidden>

    <div class="divider"></div>
		<div class="space"></div>
			<div id="FetchUser">
	
   		 </div>
	<div class="modal fade" id="UpdateSignatory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 38%;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								UPDATE SIGNATORY
							</div>	
						</h5>
					<button type="button" onclick="ClearSignatory()" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
						<div class="col-md-12">
							<div class="prof-center">
							<img id="updateSignaturePrev" style="display:none; max-width: 250px; max-height: 250px;" />
							</div>
							<div class="space"></div>
							<div class="choose-post form-control" style="display: flex; flex-direction: row; justify-content: space-between; height: auto !important;">
							<label>UPLOAD SIGNATURE: </label>
							<input type="file" name="img" id="updateSignature" />
						</div>
					</div>	
				</div>
				<div class="modal-footer" style="margin-top: 5%;">
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="ClearSignatory()">Close</button>
					<button type="button" class="btn btn-primary" style="background-color: rgba(100, 50, 30) !important; border-color: rgba(100, 50, 30) !important;" id="SaveUser" onclick="UpdateSignatory(event)">Save</button>
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
			var studID = $('#StudentId').val().trim(); 
			$.ajax({
				type: 'POST',
				url: '<?php echo site_url('TeacherController/GetProfessorProfile'); ?>',
				data: { ID: userID, studID: studID},
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
								<p class="prof-title">I. Professor Profile</p>
								<table class="prof-table">
									<tr>
										<th class="profile-th" style="text-align: left !important; color: rgba(100, 50, 30);">Name:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Name}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important; color: rgba(100, 50, 30);">Email:</th>
										<td class="profile-td" style="text-align: left !important; ">${user.Username}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important; color: rgba(100, 50, 30);">PST:</th>
										<td class="profile-td" style="text-align: left !important;">${user.StudentName}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important; color: rgba(100, 50, 30);">School:</th>
										<td class="profile-td" style="text-align: left !important;">${user.School}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important; color: rgba(100, 50, 30);">Divsion:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Division}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important; color: rgba(100, 50, 30);">Grade:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Grade}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important; color: rgba(100, 50, 30);">Coordinator:</th>
										<td class="profile-td" style="text-align: left !important;">${user.Coordinator}</td>
									</tr>
								</table>
							</div>
							<div class="space"></div>
							<div class="divider"></div>
							<div class="button-container">
								<a class="btn btn-primary" style="background-color: rgba(100, 50, 30) !important; border-color: rgba(100, 50, 30) !important; margin-right: 8px;" data-toggle="modal" data-target="#UpdateProfile" onclick="constructUpdate('${user.Name}', '${user.Password}', '${user.School}', '${user.Dvision}', '${user.Grade}', '${user.Coordinator}')">Update Profile</a>
								<a class="btn btn-primary" style="background-color: rgba(100, 50, 30) !important; border-color: rgba(100, 50, 30) !important;" data-toggle="modal" data-target="#UpdateSignatory">Signatory</a>
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

		document.getElementById('updateSignature').addEventListener('change', function(event) {
			const file = event.target.files[0];
			const preview = document.getElementById('updateSignaturePrev');
			
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

		function ClearSignatory() {
			$('#updateSignaturePrev').attr('src', '').hide();
		}

		function UpdateSignatory(e) {
			e.preventDefault();
			var formData = new FormData();
			formData.append('ID', document.getElementById('ID').value);
			var imgInput = document.getElementById('updateSignature');
			if (imgInput.files.length > 0) {
				formData.append('img', imgInput.files[0]);
			}
			$.ajax({
				type: 'POST',
				url: '<?php echo site_url('TeacherController/UpdateProfessorSignatory'); ?>',
				data: formData,
				contentType: false, 
				processData: false, 
				success: function(response) {
						$('#FetchUser').empty();
					    GetProfileUser(); 
						$('#UpdateSignatory').modal('hide'); 
                        ClearSignatory();
						message('success', 'Signatory Successfully uploaded', 2000); 
				},
				error: function(xhr) {
					ClearSignatory();
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

</script>