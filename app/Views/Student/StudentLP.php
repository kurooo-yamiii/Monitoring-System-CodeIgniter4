<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("StudentController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">Lesson Plan of PST <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"></span></p>
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
   <input type="text" name="id" id="id" value="<?php echo $_SESSION['ID']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>
    
   <div class="button-container">
		  		<button type="button" class="btn-shadow btn btn-primary" style="font-size: 14px;" data-target="#CreateNewLessonPlan"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-plus"></span> Lesson Plan
                </button>
			</div>
	<div class="space"></div>

       <!-- ADD MODAL -->
       <div class="modal fade" id="CreateNewLessonPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                CREATE LESSON PLAN
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="text" id="SupID" name="SupID" value="<?php echo $_SESSION['Name']; ?>" hidden />
                        <div class="post-group">
                            <label for="lesson" id="plab1">Lesson:</label>
                            <input name="lesson" id="lesson" type="text" placeholder="Lesson Plan Title" required></input>
                        </div>
                        <div class="space"></div>
                        <div class="prof-center">
                            <img id="lessonplanPreview" style="display:none; max-width: 250px; max-height: 250px;" />
                            <iframe id="lessonplanPDF" style="display:none; width: 100%; height: 350px;"></iframe>
                            <object id="lessonplanWord" style="display:none; width: 100%; height: 350px;"></object>
                        </div>

                        <div class="post-group">
                            <div class="choose-post">
                                <label for="lessonplan" id="plab2">File: </label>
                                <input type="file" name="lessonplan" id="chooseLesson" />
                            </div>
                        </div>
                    <div class="modal-footer" style="margin-top: 1%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="CreateLessonPlan()" type="button">Create</button>
                    </div>
               </div>
            </div>
        </div>
    </div>
</form>

<script>

    function CreateLessonPlan() {
        var formData = new FormData();
        formData.append('ID', document.getElementById('id').value); 
        formData.append('Lesson', document.getElementById('lesson').value);

        var lessonplan = document.getElementById('chooseLesson');
        if (lessonplan.files.length > 0) {
            formData.append('LP', lessonplan.files[0]);
        }
        $.ajax({
            url: '<?php echo site_url("StudentController/InsertNewLessonPlan"); ?>',
            type: 'POST',
            data: formData,
            contentType: false, 
            processData: false, 
            success: function(response) {
                $('#lesson').val(''); 
                $('#chooseLesson').val('');
                $('#lessonplanPreview').hide();
                $('#lessonplanPDF').hide();
                $('#lessonplanWord').hide();
                $('#CreateNewLessonPlan').modal('hide'); 
                message('success', 'Lesson Plan Created Successfully', 2000); 
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

    document.getElementById('chooseLesson').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileType = file.type;
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const result = e.target.result;
                    const lessonplanPreview = document.getElementById('lessonplanPreview');
                    const lessonplanPDF = document.getElementById('lessonplanPDF');
                    const lessonplanWord = document.getElementById('lessonplanWord');
                    
                    lessonplanPreview.style.display = 'none';
                    lessonplanPDF.style.display = 'none';
                    lessonplanWord.style.display = 'none';
                    
                    if (fileType.startsWith('image')) {
                        lessonplanPreview.src = result;
                        lessonplanPreview.style.display = 'block';
                    } else if (fileType === 'application/pdf') {
                        try {
                            lessonplanPDF.src = result;
                            lessonplanPDF.style.display = 'block';

                            let iframe = document.createElement('iframe');
                            iframe.src = result;
                            iframe.style.width = '100%';
                            iframe.style.height = '500px';
                            lessonplanPDF.innerHTML = ''; 
                            lessonplanPDF.appendChild(iframe);
                            
                        } catch (error) {
                            message('error', 'Error loading PDF. Please try again.', 2000);
                            console.error('PDF Load Error:', error);
                        }
                    } else {
                        message('error', 'Unsupported File Type, PDF and Image Only', 2000);
                    }
                };
                
                reader.readAsDataURL(file);
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
