<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("StudentController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">Lesson Plan of PST <span id="divForPSTName" style="margin-left: 5px; color:  rgba(100, 50, 30); font-weight: 700;"></span></p>
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
   <input type="text" name="studentid" id="studentid" value="<?php echo $_SESSION['Student']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>
    
	<div class="space"></div>
    <div id="LessonPlanDiv"></div>

    <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container" style="justify-content: space-between;">
          <p class="btn-shadow  btn btn-primary">Total Average: <span id="fetchTransmutedGrade"> </span></p>
	</div>

       <!-- GRADING MODAL -->
       <div class="modal fade" id="UpdateLessonPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 70%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                GRADE LESSON PLAN
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display: flex; flex-direction: row;">
                    <div class="frame-lesson-plan">
                        <iframe  id="lessonplanPDFUpdate"  
                        class="iframe-lesson-plan" 
                        frameborder="0">></iframe>
                    </div>
                    <div class="answer-sheet">
                    <input type="text" id="upID" name="upID" hidden />
                            <label for="gradee">Grade:</label>
                            <input name="gradee" id="gradee"  class="form-control" type="number" placeholder="Not Graded Yet" required>
                        <p class="prof-title">Lesson Plan Remarks</p> 
                    <textarea class="form-control" id="remarks" style="margin-left: 5px; font-weight: 700;" rows="6"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 1%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="updateGradeRemarks()" type="button">Save Grade</button>
                    </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        getPSTName();
        PopulateLessonPlan();
    });

    function fetchTransmutedGrade() {
      const id = $('#studentid').val();
      $.ajax({
         type: 'POST',
         url: '<?php echo site_url('TeacherController/LessonPlanEvaluate'); ?>',
         data: { ID: id },
         dataType: 'json',
         success: function(response) {
               if (response && response.grade) { 
                const fixedGrade = parseFloat(response.grade).toFixed(2);
                  $('#fetchTransmutedGrade').text(fixedGrade);
               } else {
                  $('#fetchTransmutedGrade').text('No Current Evaluation');
               }
         },
         error: function(xhr, status, error) {
               console.error("Error Details:", status, error, xhr.responseText); 
               message('error', 'Something Went Wrong, Try Again', 2000);
         }
      });
   }

    function previewLessonPlan(url) {
        window.open(url, '_blank');
    }

    function updateGradeRemarks() {
        const id = $('#upID').val();
        const grade = $('#gradee').val();
        const remarks = $('#remarks').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/UpdateLessonGrade'); ?>',
            data: {
                ID: id, 
                Grade: grade, 
                Remarks: remarks
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    message('success', 'Lesson Plan Graded', 2000);
                    PopulateLessonPlan();
                    $('#UpdateLessonPlan').modal('hide'); 
                } else if (response.status === 'invalid') {
                    message('error', 'That is Invalid Grade', 2000);
                } else {
                    message('error', 'Unexpected Response, Please Try Again', 2000);
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
                message('error', 'Unknown Error Occured', 2000);
            }
        });
    }

    function getPSTName() {
        const id = $('#studentid').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/GetStudentName'); ?>',
            data: {
                ID: id
            },
            dataType: 'json',
            success: function(response) {
               if(response && response.name){
                $('#divForPSTName').text(response.name);
               }else{
                $('#divForPSTName').text('No Current Student Assigned');
               }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function PopulateLessonPlan() {
        fetchTransmutedGrade();
        const id = $('#studentid').val();
        $('#LessonPlanDiv').empty();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/GetPSTLessonPlan'); ?>',
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
                                <button type="button" onclick="updateConstruct(${info.ID}, ${info.Grade}, '${info.Remarks}', '${updatePrev}')" class="btn btn-primary" data-target="#UpdateLessonPlan" data-toggle="modal">
                                    <span class="fas fa-pencil"></span>
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
                            <small>Note: Always Remind your PST to attach every written Lesson Plan</small>
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

    function updateConstruct(id, grade, remarks, pdfPath) {
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

        $('#grade').val(grade ? grade : null);
        $('#remarks').val(remarks ? remarks : 'No Current Remarks');
        $('#upID').val(id);
    }

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