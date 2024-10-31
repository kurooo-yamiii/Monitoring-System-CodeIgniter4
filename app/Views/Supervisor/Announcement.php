<form id="announcement">
    
<div class="dashboard">
		<p class="announce-para">Announcement <span> PST Deployment</span></p>
		<div class="logos">
			<div class="logo">
				<img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50" />
			</div>
			<div class="logo">
				<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50" />
			</div>
		</div>
	</div>
	<div class="divider"></div>
    <div class="button-container">
		  		<button type="button" class="btn-shadow btn btn-primary" style="font-size: 14px;" data-target="#CreateAnnouncement"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-plus"></span> Announcement
                </button>
			</div>
    <div class="space"></div>
    <div id="announcelist">
    
       
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="CreateAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                POST NEW ANNOUNCEMENT
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="text" id="SupID" name="SupID" value="<?php echo $_SESSION['Name']; ?>" hidden />
                        <div class="post-group">
                            <label for="post" id="plab1">Title:</label>
                            <input name="post" id="title" type="text" placeholder="Title Amnouncement" required></input>
                        </div>
                        <div class="post-group">
                            <label for="post" id="plab1">Post:</label>
                            <textarea name="post" id="post" rows="4" placeholder="Enter announcement here..." required></textarea>
                        </div>
                        <div class="space"></div>
						<div class="prof-center">
							  <img id="imagePreview" style="display:none; max-width: 250px; max-height: 250px;" />
						</div>
                        <div class="post-group">
                            <div class="choose-post">
                                <label for="img" id="plab2">Img: </label>
                                <input type="file" name="img" id="choosepost" />
                            </div>
                        </div>
                    <div class="modal-footer" style="margin-top: 5%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="postAnnouncement()" type="button">Post</button>
                    </div>
               </div>
            </div>
        </div>
    </div>

     <!-- UPDATE MODAL -->
     <div class="modal fade" id="UpdateAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                UPDATE POSTED ANNOUNCEMENT
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="text" id="SupName" name="SupID" value="<?php echo $_SESSION['Name']; ?>" hidden />
                        <input type="text" id="UpID" name="SupID" hidden />
                        <div class="post-group">
                            <label for="post" id="plab1">Title:</label>
                            <input name="post" id="uptitle" type="text" placeholder="Title Amnouncement" required></input>
                        </div>
                        <div class="post-group">
                            <label for="post" id="plab1">Post:</label>
                            <textarea name="post" id="uppost" rows="4" placeholder="Enter announcement here..." required></textarea>
                        </div>
                        <div class="space"></div>
						<div class="prof-center">
							  <img id="imagePreviewUpdate" style="display:none; max-width: 250px; max-height: 250px;" />
						</div>
                        <div class="post-group">
                            <div class="choose-post">
                                <label for="img" id="plab2">Img: </label>
                                <input type="file" name="img" id="upchoosepost" />
                            </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 5%;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" onclick="updateAnnouncement()" type="button">Update</button>
                    </div>
               </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="DelAnnounce" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                DELTE ANNOUNCEMENT
                            </div></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="DelId" hidden>
                    <p>Are you sure you want to delete <span id="DelName" style="color: red;"></span> announcement?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ECashID">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="SaveUser" onclick="announceDelete(event)">Delete Announcement</button>
                </div>

        </div>
    </div>
    </div>
</form>

<script>
        $(document).ready(function() {
			FetchAllAnnouncement();
       		})
        
        function deleteContrsuct(id, name) {
            $('#DelId').val(id);
			$('#DelName').text(name.toUpperCase());
        }

        function updateConstruct(id, title, post) {
            $('#UpID').val('');
			$('#uptitle').val('');
            $('#uppost').val('');
            $('#UpID').val(id);
			$('#uptitle').val(title);
            $('#uppost').val(post);
        }

        function announceDelete(e){
            e.preventDefault();
            const delID = $('#DelId').val();
            $.ajax({
            type: 'POST', 
            data: { delID: delID },
            url: '<?= site_url('SupervisorController/DeleteAnnouncement') ?>',
            success: function(response) {    
                $('#announcelist').empty();
                FetchAllAnnouncement();
                $('#DelAnnounce').modal('hide');
                message('success',`Announcement Deleted Successfully`, 2000);
            },
            error: function(error) {
                message('error',`Something Went Wrong Try Again`, 2000);
            }
            });
        }

        function FetchAllAnnouncement() {
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('SupervisorController/FetchAnnouncement') ?>',
            success: function(response) {    
                if (response && response.length > 0) {
                            response.forEach(function(info) {
                                if (info.Picture === '') {
                                    var appendPost = $(`
                                    <div class="todo-itemprof">
                                    <div class="announce-delete">
                                        <div>
                                        <button type="button" onclick="deleteContrsuct(${info.ID}, '${info.Title}')" class="btn btn-danger" data-target="#DelAnnounce"
                                         id="deleteAnnounce" data-toggle="modal"><span class="fas fa-trash"></span></button>
                                        <button type="button" onclick="updateConstruct(${info.ID},'${info.Title}','${info.Post}')" class="btn btn-primary" data-target="#UpdateAnnouncement"
                                          id="deleteAnnounce" data-toggle="modal"><span class="fa fa-edit"></span></button>
                                        
                                        </div>
                                        <h2>${info.Title} </h2>
                                        <p class="date-pin" >${info.Date}</p> 
                                        </div>
                                        <div style="width: 90%; margin-left: 3%;">
                                        <h2 style="font-weight: 500;">${info.Post}</h2>
                                        <br>
                                        <small>- ${info.Author}</small>
                                        </div>
                                                <div class="likes-container">
                                                    <small>
                                                        <span class="fa fa-thumbs-up like-button" aria-hidden="true"></span> ${info.Likes}
                                                    </small>
                                                    <small>
                                                        <span class="fa fa-heart heart-button" aria-hidden="true"></span> ${info.Heart}
                                                    </small>
                                                </div>
                                             </div>            
                                    `);
                                 } else {
                                    var imageUrl = `<?= base_url('assets/uploads/') ?>${info.Picture}`;
                                    var appendPost = $(`
                                    <div class="todo-itemprof">
                                        <div class="announce-delete">
                                        <div>
                                   
                                        <button type="button" onclick="deleteContrsuct(${info.ID}, '${info.Title}')" class="btn btn-danger" data-target="#DelAnnounce"
                                         id="deleteAnnounce" data-toggle="modal"><span class="fas fa-trash"></span></button>
                                         <button type="button" onclick="updateConstruct(${info.ID},'${info.Title}','${info.Post}')" class="btn btn-primary" data-target="#UpdateAnnouncement"
                                         id="deleteAnnounce" data-toggle="modal"><span class="fa fa-edit"></span></button>
                                      
                                        </div>
                                        <h2>${info.Title} </h2>
                                        <p class="date-pin" >${info.Date}</p> 
                                        </div>
                                        <br>
                                        <div class="empty">
                                            <div class="pic-announce">
                                                <img src="${imageUrl}" alt="Post Image">
                                            </div>
                                            <div class="pic-description">
                                                <div style="width: 90%; margin-left: 3%;">
                                                    <h2 style="font-weight: 500;">${info.Post}</h2>
                                                    </div>
                                                <br>
                                                <small>- ${info.Author}</small>
                                                <div class="likes-container">
                                                    <small>
                                                        <span class="fa fa-thumbs-up like-button" aria-hidden="true"></span> ${info.Likes}
                                                    </small>
                                                    <small>
                                                        <span class="fa fa-heart heart-button" aria-hidden="true"></span> ${info.Heart}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                    `);
                                 }
                                $('#announcelist').append(appendPost);
                            });
                        } else {
                            var noCurrentPost = $(`
                            <div class="todo-itemprof">
                                <a class="date-pin">N/A</a> <br>
                                <h2>No Current Announcements Posted</h2>
                                <br>
                                <small>- Please regularly check the announcements to stay informed about any updates regarding deployments.</small>
                            </div>
                            `);
                $('#announcelist').append(noCurrentPost);
             }
            },
            error: function(error) {
			
            }
            });
		}

        function postAnnouncement() {
        
            var formData = new FormData();
            
            formData.append('name', document.getElementById('SupID').value);
            formData.append('title', document.getElementById('title').value);
            formData.append('post', document.getElementById('post').value);
            formData.append('date', getFormattedDate());
            
            var imgInput = document.getElementById('choosepost');
            if (imgInput.files.length > 0) {
                formData.append('img', imgInput.files[0]);
            }

            $.ajax({
                url: '<?php echo site_url("SupervisorController/AddPostAnnouncement"); ?>', 
                type: 'POST',
                data: formData,
                contentType: false, 
                processData: false, 
                success: function(response) {
                    $('#title').val('');
                    $('#post').val('');
                    $('#SupID').val('');
                    $('#announcelist').empty();
                    FetchAllAnnouncement();
                    $('#CreateAnnouncement').modal('hide');
                    message('success',`Announcement Posted Successfully`, 2000);
                },
                error: function(xhr, status, error) {
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

    function updateAnnouncement() {
    var formData = new FormData();

    formData.append('ID', document.getElementById('UpID').value); 
    formData.append('title', document.getElementById('uptitle').value);
    formData.append('post', document.getElementById('uppost').value);
    
    var imgInput = document.getElementById('upchoosepost');
    if (imgInput.files.length > 0) {
        formData.append('img', imgInput.files[0]);
    }
    $.ajax({
        url: '<?php echo site_url("SupervisorController/UpdateAnnouncement"); ?>',
        type: 'POST',
        data: formData,
        contentType: false, 
        processData: false, 
        success: function(response) {
            $('#UpID').val(''); 
            $('#title').val(''); 
            $('#uppost').val(''); 
            $('#upchoosepost').val(''); 
            $('#announcelist').empty(); 
            FetchAllAnnouncement(); 
            $('#UpdateAnnouncement').modal('hide'); 
            message('success', 'Announcement Updated Successfully', 2000); 
        },
        error: function(xhr, status, error) {
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


    function getFormattedDate() {
    const today = new Date();
    const options = { year: 'numeric', month: 'short', day: '2-digit' };
    return today.toLocaleDateString('en-US', options).replace(',', '');
    }

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
		
		document.getElementById('choosepost').addEventListener('change', function(event) {
			const file = event.target.files[0];
			if (file) {
				const reader = new FileReader();
				
				reader.onload = function(e) {
					const imagePreview = document.getElementById('imagePreview');
					imagePreview.src = e.target.result;
					imagePreview.style.display = 'block'; 
				};
        reader.readAsDataURL(file); 
			}
		});
		
		document.getElementById('upchoosepost').addEventListener('change', function(event) {
			const file = event.target.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					const imagePreviewUpdate = document.getElementById('imagePreviewUpdate');
					imagePreviewUpdate.src = e.target.result;
					imagePreviewUpdate.style.display = 'block'; // Show the image
				};
				reader.readAsDataURL(file); 
			}
		});
</script>