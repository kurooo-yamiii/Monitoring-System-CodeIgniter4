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
    <div id="LessonPlanDiv"></div>

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
                            <iframe id="lessonplanPDF" style="display:none; width: 100%; height: 350px;"></iframe>
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

     <!-- UPDATE MODAL -->
     <div class="modal fade" id="UpdateLessonPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                UPDATE LESSON PLAN
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="text" id="upID" name="upID" hidden />
                        <div class="post-group">
                            <label for="lesson" id="plab1">Lesson:</label>
                            <input name="uplesson" id="uplesson" type="text" placeholder="Lesson Plan Title" required></input>
                        </div>
                        <div class="space"></div>
                        <div class="prof-center">
                            <iframe id="lessonplanPDFUpdate" style="display:none; width: 100%; height: 350px;"></iframe>
                        </div>

                        <div class="post-group">
                            <div class="choose-post">
                                <label for="lessonplan" id="plab2">File: </label>
                                <input type="file" name="lessonplan" id="chooseLessonUpdate" />
                            </div>
                        </div>
                    <div class="modal-footer" style="margin-top: 1%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="UpdateLessonPlan()" type="button">Update</button>
                    </div>
               </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="DelLessonPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                DELETE LESSON PLAN
                            </div></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="DelId" hidden>
                    <p>Are you sure you want to delete <span id="DelName" style="color: red;"></span> Lesson Plan?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ECashID">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="SaveUser" onclick="DeleteLP(event)">Delete Lesson Plan</button>
                </div>
        </div>
    </div>
    </div>
</form>

<script>

    $(document).ready(function() {
        PopulateLessonPlan()
    });

    function previewLessonPlan(url) {
        window.open(url, '_blank');
    }

    function PopulateLessonPlan() {
        const id = $('#id').val();
        const name = $('#name').val();
        $('#divForPSTName').text(name);
        $('#LessonPlanDiv').empty();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('StudentController/GetLessonPlan'); ?>',
            data: {
                ID: id
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    response.forEach(function(info) {
                        const formattedDate = formatDate(info.Date);
                        var baseUrl = '<?= base_url('assets/lesson/'); ?>';
                        var fileName = `${id}/${info.FilePath}`;
                        var updatePrev = `<?= base_url('assets/lesson/') ?>${fileName}`;
                        var appendLessonPlan = $(` 
                            <div class="todo-itemprof">
                            <div style=" display: flex;
                                flex-direction: row;
                                justify-content: space-between;
                                align-items: center;">
                               <div style="width: auto; flex-grow: 1;">
                                    <h2>Lesson:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Lesson}</span></h2>
                                    <small style="color: rgba(100, 50, 30); font-weight: 700;">Total Grade: ${info.Grade == '0' ? 'Not Graded Yet' : info.Grade}</small> 
                                    <small>Date: ${formattedDate}</small> 
                               </div>
                               <div style="width: auto;">
                                <button href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Lesson}');"type="button" class="btn btn-danger" data-target="#DelLessonPlan" data-toggle="modal"><span class="fas fa-trash"></span></button> 
                                <button type="button" onclick="updateConstruct(${info.ID}, '${info.Lesson}', '${updatePrev}')" class="btn btn-primary" data-target="#UpdateLessonPlan" data-toggle="modal">
                                    <span class="fas fa-redo"></span>
                                </button>
                                <button onclick="previewLessonPlan('${baseUrl}${fileName}')" class="btn btn-warning" type="button" 
                                    id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button> 
                               </div>
                               </div>
                            </div>
                        `);
                        $('#LessonPlanDiv').append(appendLessonPlan);
                    });
                } else {
                    var noLessonPlanExisting = $(`
                        <div class="todo-itemprof">
                            <button class="removee-to-do" style="background-color: rgba(100, 50, 30);" type="button">N/A</button> 
                            <h2>No Lesson Plan Attached</h2>
                            <small>Note: Always attach your Lesson Plan and inform your resource teacher to grade and evaluate</small>
                        </div>
                    `);
                    $('#LessonPlanDiv').append(noLessonPlanExisting);
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function deleteQues(id, lesson) {
        $('#DelName').text(lesson);
        $('#DelId').val(id);
    }

    function DeleteLP(e){
        const id = $('#DelId').val();
        e.preventDefault();
            $.ajax({
            type: 'POST', 
            data: { delID: id },
            url: '<?= site_url('StudentController/DeleteLessonPlan') ?>',
            success: function(response) {    
                $('#LessonPlanDiv').empty();
                PopulateLessonPlan();
                $('#DelLessonPlan').modal('hide');
                message('success',`Lesson Plan Deleted Successfully`, 2000);
            },
            error: function(error) {
                message('error',`Something Went Wrong Try Again`, 2000);
            }
            });
    }

    function updateConstruct(id, lesson, pdfPath) {
        const lessonplanPDF = document.getElementById('lessonplanPDFUpdate');
        lessonplanPDF.style.display = 'none';
        
            lessonplanPDF.src = pdfPath;
            lessonplanPDF.style.display = 'block';
            let iframe = document.createElement('iframe');
            iframe.src = pdfPath;
            iframe.style.width = '100%';
            iframe.style.height = '500px';
            lessonplanPDF.innerHTML = ''; 
            lessonplanPDF.appendChild(iframe);

        $('#uplesson').val(lesson);
        $('#upID').val(id);
    }

    function UpdateLessonPlan() {
        var formData = new FormData();
        formData.append('ID', document.getElementById('upID').value); 
        formData.append('Lesson', document.getElementById('uplesson').value);

        var lessonplan = document.getElementById('chooseLessonUpdate');
        if (lessonplan.files.length > 0) {
            formData.append('LP', lessonplan.files[0]);
        }
        $.ajax({
            url: '<?php echo site_url("StudentController/UpdateLessonPlan"); ?>',
            type: 'POST',
            data: formData,
            contentType: false, 
            processData: false, 
            success: function(response) {
                $('#uplesson').val(''); 
                $('#chooseLessonUpdate').val('');
                $('#lessonplanPDFUpdate').hide();
                $('#UpdateLessonPlan').modal('hide'); 
                PopulateLessonPlan();
                message('success', 'Lesson Plan Updated Successfully', 2000); 
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
                $('#lessonplanPDF').hide();
                $('#CreateNewLessonPlan').modal('hide'); 
                PopulateLessonPlan();
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
                    const lessonplanPDF = document.getElementById('lessonplanPDF');
                    
                    lessonplanPDF.style.display = 'none';
                    if (fileType === 'application/pdf') {
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

        document.getElementById('chooseLessonUpdate').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileType = file.type;
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const result = e.target.result;
                    const lessonplanPDF = document.getElementById('lessonplanPDFUpdate');
                    
                    lessonplanPDF.style.display = 'none';
                    if (fileType === 'application/pdf') {
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

    function formatDate(dateString) {
		const date = new Date(dateString);
		const options = { year: 'numeric', month: 'long', day: 'numeric' };
		return date.toLocaleDateString('en-US', options);
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

</script>
