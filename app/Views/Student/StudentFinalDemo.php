<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("StudentController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">List of <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"> Final Demonstration Evaluation </span></p>
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

	<div class="space"></div>

	<div id="EvalResult" class="todo-container"></div>

   <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container" style="justify-content: space-between;">
          <p class="btn-shadow  btn btn-primary">Final Transmuted Grade: <span id="fetchTransmutedGrade"> </span></p>
		  		<p type="button" class="btn-shadow btn btn-warning" data-target="#AttachFinalLessonPlan"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-plus"></span> Attach Lesson Plan (Final Demo)
                </p>
			</div>

    <!-- Preview Final Demo Evaluation Modal -->
    <div class="modal fade" id="PrevEval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"  style="max-width: 60%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                                <div class="logos">
                                    <div class="logo-right">
                                        <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                    </div>
                                    <div>Observer: <span id="Observer" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"></span></div>
                                </div>	
                            </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="TableforEvalPreview">
                                    <thead>
                                    <tr>
                                        <th scope="col">Category</th>
                                        <th scope="col">Qs1</th>
                                        <th scope="col">Qs2</th>
                                        <th scope="col">Qs3</th>
                                        <th scope="col">Qs4</th>
                                        <th scope="col">Qs5</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                            <tbody>
                    </tbody>
                </table>
                <div class="space"></div>
                <div class="space"></div>
                    <div style="margin-bottom: 10px;">
                        <p class="button-title-remarks">Strenghts</p> 
                        <textarea class="form-control" id="strenghtsHolder" style="margin-left: 5px; font-weight: 700;" rows="3" readonly></textarea>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <p class="button-title-remarks">Improvements</p> 
                        <textarea class="form-control" id="improvementssHolder" style="margin-left: 5px; font-weight: 700;" rows="3" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

      <!-- Attach Final Lesson Plan -->
      <div class="modal fade" id="AttachFinalLessonPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 50%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                ATTACH FINAL DEMO LESSON PLAN
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="prof-center">
                            <iframe id="lessonplanPDF" style="display:none; width: 100%; height: 500px;"></iframe>
                        </div>

                        <div class="post-group">
                            <div class="choose-post">
                                <label for="lessonplan" id="plab2">PDF: </label>
                                <input type="file" name="lessonplan" id="chooseLesson" />
                            </div>
                        </div>
                    <div class="modal-footer" style="margin-top: 1%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="AttachLessonPLan()" type="button">Attach Final Lesson Plan</button>
                    </div>
               </div>
            </div>
        </div>
    </div>
</form>
<script>
    
   $(document).ready(function() {
        StudentFinalDemo()
    });

    function StudentFinalDemo() {
        const id = $('#id').val();
        fetchTransmutedGrade()
        $('#EvalResult').empty();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('StudentController/StudentFetchAllDemo'); ?>',
            data: {
                ID: id
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    response.forEach(function(info) {
                        const formattedDate = formatDate(info.Date);

                        const scores = {
                           a1: info['1A'], b1: info['1B'], c1: info['1C'], d1: info['1D'], e1: info['1E'],
                           a2: info['2A'], b2: info['2B'], c2: info['2C'], d2: info['2D'], e2: info['2E'],
                           a3: info['3A'], b3: info['3B'], c3: info['3C'], d3: info['3D'], e3: info['3E'],
                           a4: info['4A'], b4: info['4B'], c4: info['4C'], d4: info['4D'], e4: info['4E'],
                           a5: info['5A'], b5: info['5B'], c5: info['5C'], d5: info['5D'], e5: info['5E'],
                        };

                        var appendEvaluation = $(` 
                            <div class="todo-itemprof">
                            <div style=" display: flex;
                                flex-direction: row;
                                justify-content: space-between;
                                align-items: center;">
                               <div style="width: auto; flex-grow: 1;">
                                    <h2>Observer:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Observer}</span></h2>
                                    <small style="color: rgba(100, 50, 30); font-weight: 700;">Trasnmuted Average: ${info.Grade}</small> 
                                    <small>Subject & Grade: ${info.SubjectGrade}</small>
                                    <small>Date: ${formattedDate}</small> 
                               </div>
                               <div style="width: auto;">
                                <button onclick="previewEvaluation(${info.ID}, '${info.Observer}', '${info.Strenghts}', '${info.Improvement}')" class="btn btn-warning" type="button" data-target="#PrevEval"
                                    id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button> 
                               </div>
                               </div>
                            </div>
                        `);
                        $('#EvalResult').append(appendEvaluation);
                    });
                } else {
                    var noEvaluationExisting = $(`
                        <div class="todo-itemprof">
                            <button class="removee-to-do" style="background-color: rgba(100, 50, 30);" type="button">N/A</button> 
                            <h2>No current Final Demo Evaluation</h2>
                            <small>Note: Make sure to give all the Observer devices to Answer the Final Demo Sheet</small>
                        </div>
                    `);
                    $('#EvalResult').append(noEvaluationExisting);
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function fetchTransmutedGrade() {
      const id = $('#id').val();
      $.ajax({
         type: 'POST',
         url: '<?php echo site_url('StudentController/ComputeFinalAverage'); ?>',
         data: { ID: id },
         dataType: 'json',
         success: function(response) {
               if (response && response.grade) { 
                  $('#fetchTransmutedGrade').text(response.grade);
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

   function previewEvaluation(id, observer, strenghts, improvement) {
        $('#Observer').text(observer);
        $('#strenghtsHolder').val(strenghts);
        $('#improvementssHolder').val(improvement);
        var table = $('#TableforEvalPreview').DataTable({
               ordering: false,
               responsive: true,
               retrieve: true,
               paging: false,  
               info: false,    
               pageLength: 7,  
               dom: '<"row"<"col-md-6"B><"col-md-6"f>>' + 
                     '<"row"<"col-md-12"tr>>',  
               language: {
                     info: "", 
                     paginate: {
                        next: 'Next',
                        previous: 'Previous'
                     }
               },
                 buttons: [
                     {
                        extend: "pdfHtml5",
                        className: 'btn btn-danger',
						text: `PST Evaluation`,
                        title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        text: 'PDF',
                         init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-pdf buttons-html5')
                        }
                    },
                    {
                        extend: "copyHtml5",
                        className: 'btn btn-primary',
						text: `PST Evaluation`,
                        title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
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
						title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-excel buttons-html5')
                        }
                    },
                    {
                        extend: "csvHtml5",
                        className: 'btn btn-warning',
                        text: 'CSV',
						title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-csv buttons-html5')
                        }
					}
				]
			});
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('StudentController/FinalDemoScores'); ?>',
                data: {
                    ID: id
                },
                dataType: 'json',
                success: function(response) {
                    table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr >
                                <td>${info.Variable}</td>
                                 <td>${info.Q1 ? info.Q1 : ''}</td>
                                 <td>${info.Q2 ? info.Q2 : ''}</td>
                                 <td>${info.Q3 ? info.Q3 : ''}</td>
                                 <td>${info.Q4 ? info.Q4 : ''}</td>
                                 <td>${info.Q5 ? info.Q5 : ''}</td>
                                 <td>${info.Total ? Number(info.Total).toFixed(2) : ''}</td>
                                </tr>
                                `);  
                        table.row.add(rowData);
                        });
                    table.draw();
                }              
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
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