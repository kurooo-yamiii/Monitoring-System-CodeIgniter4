<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form id="statistic">
   <div class="dashboard">
   <p class="announce-para">Pre-Service Teacher <span> Lesson Plan</span></p>
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
   <div class="space"></div>
   <table class="table table-striped" id="startuptable">
			  <thead>
			    <tr>
              <th scope="col">STUDENT</t>
			     <th scope="col">RESOURCE TEACHER</th>
				  <th scope="col">SCHOOL</th>
              <th scope="col">BLOCK</th>
              <th scope="col">AVERAGE</th>
				  <th scope="col">LESSON PLAN STATUS</th>
				  <th scope="col">PREVIEW</th>
			    </tr>
			  </thead>
			  <tbody>
			  </tbody>	 
			</table>
      <div class="space"></div>
		<div class="divider"></div>

       <!-- Preview Evaluation Modal -->
      <div class="modal fade" id="PrevStudentLessonPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg"  style="max-width: 60%;" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">
                           <div class="logos">
                              <div class="logo-right">
                                 <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                              </div>
                              <div>Lesson Plan List of PST  <span id="StudentName" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"></span></div>
                           </div>	
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <div class="modal-body">
                     <div id="LessonPlanDiv"></div>

                     <div class="space"></div>
                        <div class="divider"></div>
                        <div class="button-container" style="justify-content: space-between;">
                           <p class="btn-shadow  btn btn-primary">Total Average: <span id="fetchTransmutedGrade"> </span></p>
                     </div>
                     </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>
            </div>
         </div>
      </div>
</form>   
<script>
		   $(document).ready(function() {
			   GetAllStudentLP();
       	})

         function InitializeLP(url) {
            window.open(url, '_blank');
         }

        function previewLessonPlan(e, id, name) {
         fetchTransmutedGrade(id);
         $('#StudentName').text(name);
         $('#LessonPlanDiv').empty();
         $.ajax({
               type: 'POST',
               url: '<?php echo site_url('SupervisorController/SpecificStudentLP'); ?>',
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
                                 <button onclick="InitializeLP('${baseUrl}${fileName}')" class="btn btn-warning" type="button" 
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

      function fetchTransmutedGrade(id) {
         $.ajax({
            type: 'POST',
            url: '<?php echo site_url('SupervisorController/LPTotalAverage'); ?>',
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

		 function GetAllStudentLP() { 
         
			var table = $('#startuptable').DataTable({
            ordering: false,
            responsive: true,
            retrieve: true,
            pageLength: 5,
            dom: '<"row"<"col-md-6"B><"col-md-6"f>>' + 
               '<"row"<"col-md-12"tr>>' + 
               '<"row"<"col-md-5"i><"col-md-7"p>>', 
                  buttons: [
                        {
                           extend: "pdfHtml5",
                           className: 'btn btn-danger',
                           exportOptions: {
                                 columns: [0,1,2,3,4]
                           },
                           text: 'PDF',
                           init: function(api, node, config) {
                              $(node).removeClass('dt-button buttons-pdf buttons-html5')
                           }
                     },
                     {
                           extend: "copyHtml5",
                           className: 'btn btn-primary',
                           exportOptions: {
                                 columns: [0,1,2,3,4]
                           },
                           text: 'Copy',
                           init: function(api, node, config) {
                              $(node).removeClass('dt-button buttons-copy buttons-html5')
                           }
                     },
                     {
                           extend: "excelHtml5",
                           className: 'btn btn-success',
                           text: 'Excel',
                           exportOptions: {
                                 columns: [0,1,2,3,4]
                           },
                           init: function(api, node, config) {
                              $(node).removeClass('dt-button buttons-excel buttons-html5')
                           }
                     },
                     {
                           extend: "csvHtml5",
                           className: 'btn btn-warning',
                           text: 'CSV',
                           exportOptions: {
                                 columns: [0,1,2,3,4]
                           },
                           init: function(api, node, config) {
                              $(node).removeClass('dt-button buttons-csv buttons-html5')
                           }
                  }
               ]
            });

               $.ajax({
               type: 'GET', 
               url: '<?= site_url('SupervisorController/GetAllStudentLP') ?>', 
               dataType: 'json',
               success: function(response) {    
                  table.clear().draw();
                     const res = response.data;
                           if (res.length > 0) {
                              res.forEach(function(info) {
                                 var rowData = $(`<tr id="trid${info.ID}">
                                 <td>${info.Name}</td>
                                 <td>
                                    <button 
                                       style="opacity: 1 !important; font-size: 11px !important;" 
                                       class="btn btn-secondary" disabled>
                                          ${info.ResourceTeacher}
                                    </button>
                                 </td>
                                 <td>${info.DeployedSchool}</td>
                                 <td>${info.BlockSection}</td>
                                 <td>
                                    <button 
                                       style="opacity: 1 !important; font-size: 11px !important;" 
                                       class="btn btn-primary" disabled>
                                          ${info.OverallAverage}
                                    </button>
                                 </td>
                                 <td>${info.TotalLesson}</td>
                                 <td>
                                 <button data-toggle="modal" type="button" data-target="#PrevStudentLessonPlan" onclick="previewLessonPlan(event, ${info.ID}, '${info.Name}');"
                                    class="btn btn-warning"><span class="fas fa-eye"></span></button>
                                 </td>
                                 </tr>
                                 `);  
                           table.row.add(rowData);
                           });
                     table.draw();
                  }
               },
               error: function(error) {
               console.log(error);
               }
               });
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