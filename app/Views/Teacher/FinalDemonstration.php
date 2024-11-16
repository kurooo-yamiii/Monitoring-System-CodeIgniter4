<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("TeacherController/logout"));
    exit();
}
?>
<form>
<div class="dashboard">
   <p class="announce-para">Pre-Service Teacher <span id="divForPSTName" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"> Final Demonstration</span></p>
   <div class="logos">
      <div class="logo">
         <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50" />
      </div>
      <div class="logo">
         <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50" />
      </div>
   </div>
   </div>
   
   <input type="text" name="id" id="id" value="<?php echo $_SESSION['ID']; ?>" hidden>
   <input type="text" name="StudentID" id="StudentID" value="<?php echo $_SESSION['Student']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>

   <div class="divider"></div>
	<div class="space"></div>

	<div id="EvalResult" class="todo-container"></div>

   <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container" style="justify-content: space-between;">
          <p class="btn-shadow  btn btn-primary">Final Transmuted Grade: <span id="fetchTransmutedGrade"> </span></p>
		  		<p type="button" class="btn-shadow btn btn-primary" data-target="#FinalDemoModal"
                    id="CreatePST" data-toggle="modal"  onclick="openAddEvaluation()" >
                    <span class="fas fa-plus"></span> Final Demo Evaluation
                </p>
			</div>
   <?= view('Teacher/FinalDemoForm') ?>

   <!-- Preview Evaluation Modal -->
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

 <!-- Delete Modal -->
<div class="modal fade" id="DeletePST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Delete PST <span style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"> Evaluation</span></div>
							</div>	
						</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="ClearAllField()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <input type="text" id="DelId" hidden>
                <p>Are you sure you want to delete observer <span id="DelName" style="color: red;"></span> Final Demo Evaluation?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="ECashID">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="SaveUser" onclick="DeleteEvaluation(event)">Delete Evaluation</button>
            </div>

    </div>
 </div>
 </div>

</form>
<script>

   $(document).ready(function() {
        PDOFinalDemo()
      });

   function fetchTransmutedGrade() {
      const id = $('#StudentID').val();
      $.ajax({
         type: 'POST',
         url: '<?php echo site_url('TeacherController/FinalDemoComputation'); ?>',
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
   

   function openAddEvaluation() {
        const firstSection = document.getElementById('firstSet');
        firstSection.style.display = 'block';

        const firstButton = document.querySelector('.nav-button');
        firstButton.classList.add('active');

        const upButton = document.getElementById('updateButton');
        const adButton = document.getElementById('addButton');
        upButton.style.display = 'none';
        adButton.style.display = 'block';
    }

    function showSection(sectionId, button) {
        const sections = document.querySelectorAll('.set-group');
        sections.forEach(section => {
            section.style.display = 'none';
        });

        const selectedSection = document.getElementById(sectionId);
        selectedSection.style.display = 'block';

        const buttons = document.querySelectorAll('.nav-button');
        buttons.forEach(btn => {
            btn.classList.remove('active');
        });

        button.classList.add('active');
    }

    $('#FinalDemoModal').on('hide.bs.modal', function () {
        ClearAllField();
    });

    function AddEvaluation() {
      var firstSet = {
         a1: $('#a1').val(),
         a2: $('#a2').val(),
         a3: $('#a3').val(),
         a4: $('#a4').val(),
         a5: $('#a5').val(),
      }

      var secondSet = {
         b1: $('#b1').val(),
         b2: $('#b2').val(),
         b3: $('#b3').val(),
         b4: $('#b4').val(),
         b5: $('#b5').val(),
      }

      var thirdSet = {
         c1: $('#c1').val(),
         c2: $('#c2').val(),
         c3: $('#c3').val(),
         c4: $('#c4').val(),
         c5: $('#c5').val(),
      }

      var fourthSet = {
         d1: $('#d1').val(),
         d2: $('#d2').val(),
         d3: $('#d3').val(),
         d4: $('#d4').val(),
         d5: $('#d5').val(),
      }

      var fifhtSet = {
         e1: $('#e1').val(),
         e2: $('#e2').val(),
         e3: $('#e3').val(),
         e4: $('#e4').val(),
         e5: $('#e5').val(),
      }

      var info = {
         teacherid: $('#id').val(),
         studentid: $('#StudentID').val(),
         pst: $('#pst').val(),
         subject: $('#subject').val(),
         date: $('#date').val(),
         observer: $('#observer').val(),
         cooperating: $('#cooperating').val(),
         quarter: $('#quarter').val(),
         strenght: $('#strenght').val(),
         improvement: $('#improvement').val(),
      }

      var data = {
         firstSet: firstSet,
         secondSet: secondSet,
         thirdSet: thirdSet,
         fourthSet: fourthSet,
         fifthSet: fifhtSet,
         info: info,
      }

      $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/GenerateFinalDemo'); ?>',
            data: {
                  data: data
            },
            dataType: 'json',
            success: function(response) {
               PDOFinalDemo();
               $('#FinalDemoModal').modal('hide'); 
               ClearAllField();
            message('success', 'Final Demo Evaluation Succesfully Added', 2000); 
            },
            error: function(error) {
                  message('error', 'Something Went Wrong, Try  Again', 2000); 
            }
         });
      }

      function UpdateEvaluation() {
      var firstSet = {
         a1: $('#a1').val(),
         a2: $('#a2').val(),
         a3: $('#a3').val(),
         a4: $('#a4').val(),
         a5: $('#a5').val(),
      }

      var secondSet = {
         b1: $('#b1').val(),
         b2: $('#b2').val(),
         b3: $('#b3').val(),
         b4: $('#b4').val(),
         b5: $('#b5').val(),
      }

      var thirdSet = {
         c1: $('#c1').val(),
         c2: $('#c2').val(),
         c3: $('#c3').val(),
         c4: $('#c4').val(),
         c5: $('#c5').val(),
      }

      var fourthSet = {
         d1: $('#d1').val(),
         d2: $('#d2').val(),
         d3: $('#d3').val(),
         d4: $('#d4').val(),
         d5: $('#d5').val(),
      }

      var fifhtSet = {
         e1: $('#e1').val(),
         e2: $('#e2').val(),
         e3: $('#e3').val(),
         e4: $('#e4').val(),
         e5: $('#e5').val(),
      }

      var info = {    
         id: $('#EvalID').val(),
         pst: $('#pst').val(),
         subject: $('#subject').val(),
         date: $('#date').val(),
         observer: $('#observer').val(),
         cooperating: $('#cooperating').val(),
         quarter: $('#quarter').val(),
         strenght: $('#strenght').val(),
         improvement: $('#improvement').val(),
      }

      var data = {
         firstSet: firstSet,
         secondSet: secondSet,
         thirdSet: thirdSet,
         fourthSet: fourthSet,
         fifthSet: fifhtSet,
         info: info,
      }

      $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/UpdateFinalDemo'); ?>',
            data: {
                  data: data
            },
            dataType: 'json',
            success: function(response) {
               PDOFinalDemo();
               $('#FinalDemoModal').modal('hide'); 
               ClearAllField();
            message('success', 'Final Demo Evaluation Succesfully Updated', 2000); 
            },
            error: function(error) {
                  message('error', 'Something Went Wrong, Try  Again', 2000); 
            }
         });
      }

      function deleteQues(id, name) {
         $('#DelId').val(id);
         $('#DelName').text(name.toUpperCase());
      }

      function DeleteEvaluation(e){
         e.preventDefault();
         $.ajax({
               type: 'POST', 
               url: '<?= site_url('TeacherController/DeleteFinalDemo') ?>',
               data: { ID: $('#DelId').val() }, 
               dataType: 'json',
               success: function(response) {    
               message('success',`Final Demo Evaluation Succesfully Removed`, 2000);
               PDOFinalDemo();
               $('#DeletePST').modal('hide');
               },
               error: function(error) {
               message('error',`Something Went Wrong, Try Again`, 2000);
               }
         });
      }

      function PDOFinalDemo() {
        const id = $('#StudentID').val();
        fetchTransmutedGrade()
        $('#EvalResult').empty();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/FinalDemoPDO'); ?>',
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
                                <button href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Observer}');"type="button" class="btn btn-danger" data-target="#DeletePST" data-toggle="modal"><span class="fas fa-trash"></span></button> 
                                <button type="button" onclick="updateConstruct('${encodeURIComponent(JSON.stringify(scores))}', ${info.ID}, '${info.Observer}', '${info.Date}', '${info.Name}', '${info.SubjectGrade}', '${info.Quarter}', '${info.School}', '${info.Strenghts}', '${info.Improvement}')" class="btn btn-primary">
                                    <span class="fas fa-redo"></span>
                                </button>
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

      function ClearAllField() {
         $('#pst').val('');
         $('#subject').val('');
         $('#date').val('');
         $('#observer').val('');
         $('#cooperating').val('');
         $('#quarter').val('');
         $('#strenght').val('');
         $('#improvement').val('');

         const dropdownGroups = ['#firstSet', '#secondSet', '#thirdSet', '#fourthSet', '#fifthSet'];
         dropdownGroups.forEach(group => {
               const elements = document.querySelectorAll(`${group} select`);
               elements.forEach(select => {
                  select.selectedIndex = 0;
               });
         });

         const sections = document.querySelectorAll('.set-group');
         sections.forEach(section => {
               section.style.display = 'none';
         });

         const buttons = document.querySelectorAll('.nav-button');
         buttons.forEach(btn => {
               btn.classList.remove('active');
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
                url: '<?php echo site_url('TeacherController/PreviewEvalFinalDemo'); ?>',
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

        function updateConstruct(scoreString, id, observer, date, name, subject, quarter, school, strengths, imporvement) {
         try {
         const scores = JSON.parse(decodeURIComponent(scoreString));
         $('#pst').val(name);
            $('#subject').val(subject);
            $('#date').val(date);
            $('#observer').val(observer);
            $('#cooperating').val(school);
            $('#quarter').val(quarter);
            $('#strenght').val(strengths);
            $('#improvement').val(imporvement);
         $('#EvalID').val(id);

         for (const key in scores) {
               if (scores.hasOwnProperty(key)) {
                  $('#' + key).val(scores[key]);
               }
         }

         const firstSection = document.getElementById('firstSet');
         firstSection.style.display = 'block';

         const firstButton = document.querySelector('.nav-button');
         firstButton.classList.add('active');

         const upButton = document.getElementById('updateButton');
         const adButton = document.getElementById('addButton');
         upButton.style.display = 'block';
         adButton.style.display = 'none';

        $('#FinalDemoModal').modal('show');
    } catch (error) {
        console.error('Error parsing scores:', error);
    }
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