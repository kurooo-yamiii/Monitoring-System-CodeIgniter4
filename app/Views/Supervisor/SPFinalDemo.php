<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form id="finaldemo">
   <div class="dashboard">
   <p class="announce-para">Pre-Service Teacher <span> Final Demonstration</span></p>
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
   
   <div style="display: flex; flex-direction: row; justify-content: space-between;">
   <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
	   <label for="statpst" class="search-input" style="margin-bottom: 0px !important;">Search:</label>
	   <input type="text" name="statpst" id="statpst" placeholder="Enter PST Name" class="search-input">
	   <button type="button" onclick="searchDeployed()" class="search-button">Search</button>
   </div>
      <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
         <label class="search-input" style="margin-bottom: 0px !important;">Major</label>
            <select class="chosen-select search-input" id="School" onchange="searchByMajor()">
                <option value="FetchAll">All of Majors</option>
                <option value="BSE-Math">BSE-Math</option>
				<option value="BSE-Filipino">BSE-Filipino</option>
				<option value="BSE-English">BSE-English</option>
				<option value="BSE-Science">BSE-Science</option>
                <option value="BSE-Social-Studies">BSE-Social-Studies</option>
				<option value="BTVTED-CSS">BTVTED-CSS</option>
				<option value="BTVTED-VGD">BTVTED-VGD</option>
				<option value="BTVTED-Animation">BTVTED-Animation</option>
			</select>
          </div>
   </div>
   <div class="lightspace"></div>
   
   <input type="hidden" id="SupID" name="SupID">
   <div id="StatResult">
   </div>
   
   <div id="showstats">
  
   </div>
   <div class="space"></div>
   <div class="divider"></div>

    <!-- Preview Final Demo List Modal -->
    <div class="modal fade" id="FinalDemoList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"  style="max-width: 70%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                                <div class="logos">
                                    <div class="logo-right">
                                        <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                    </div>
                                    <div>Final Demonstration of <span id="PSTName" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"></span></div>
                                </div>	
                            </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                <div id="EvalResult" class="todo-container"></div>
                <div class="space"></div>
                <div class="divider"></div>
                    <div class="button-container" style="justify-content: space-between;">
                        <p class="btn-shadow  btn btn-primary">Final Transmuted Grade: <span id="fetchTransmutedGrade"> </span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
</form>
<script>

    $(document).ready(function() {
		onloadStudent();
	})

    function onloadStudent() {
		var pstHolder = $('#showstats');
		$.ajax({
			type: 'GET',
			url: '<?= site_url('SupervisorController/FetchAllSTScores ') ?>',
			dataType: 'json',
			success: function(response) {
				pstHolder.empty();
				if (response.length === 0) {
                var noDataMessage = `
							<div class="monitor">
								<img src="<?= base_url('assets/img/default.jpeg') ?>" id="gridpic">                                                                           
								<span class="program">N/A</span> 
								<h2>No Current PST Deployed</h2>
								<small style="margin-bottom: 3px;">Note: You can deploy PST studeny by visiting the Deployment module</small>
								<div class="monitor-button" style="display: flex; flex-direction: row;">
									<button class="btn btn-primary" type="button" style="margin-right: 2%;">N/A</button>  
								</div>
							</div>
					`;
					pstHolder.append(noDataMessage);
				} else {
				response.forEach(function(info) {
					var profileImageSrc = info.Profile ? `<?= base_url('assets/uploads/') ?>${info.Profile}` : '<?= base_url('assets/img/default.jpeg') ?>'
					var profileCard = `
                            <div>
                            <div class="blue-bar"></div>
							<div class="monitor">
								<img src="${profileImageSrc}" id="gridpic">                                                                           
								<span class="program" style="margin-bottom: 5px;">${info.Program}</span> 
								<h2>${info.Name}</h2>
								<small>Section: ${info.Section}</small> 
								<small style="margin-bottom: 5px;">Supervisor: ${info.Supervisor}</small>
								<div class="monitor-button" style="display: flex; flex-direction: row; margin-bottom: 5px;">
									<button onclick="StudentFinalDemo(${info.ID}, '${info.Name}')" class="btn btn-primary" type="button" style="margin-right: 2%;" data-target="#FinalDemoList" data-toggle="modal">
                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                </button>  
                                    <button onclick="javascript:void(0)"  class="btn btn-warning" type="button" style="margin-right: 2%;">Transmuted Grade ${info.TotalGrade}</button>		
								</div>
							</div>
                            </div>
						`;
					pstHolder.append(profileCard);
				});
			}},
			error: function(error) {
				console.log(error);
			}
		});
	}

    function searchDeployed() {
		var searchTerm = $('#statpst').val().trim();
		var pstHolder = $('#showstats');
		$.ajax({
			type: 'GET',
			url: '<?= site_url('SupervisorController/FindhDeployedPST ') ?>',
			data: {
				search: searchTerm
			},
			dataType: 'json',
			success: function(response) {
				pstHolder.empty();
				if (response.length === 0) {
                var noDataMessage = `
							<div class="monitor">
								<img src="<?= base_url('assets/img/default.jpeg') ?>" id="gridpic">                                                                           
								<span class="program">N/A</span> 
								<h2>No Current PST Matched the Information</h2>
								<small style="margin-bottom: 3px;">Note: You can deploy PST studeny by visiting the Deployment module</small>
								<div class="monitor-button" style="display: flex; flex-direction: row;">
									<button class="btn btn-primary" type="button" style="margin-right: 2%;">N/A</button>  
								</div>
							</div>
					`;
					pstHolder.append(noDataMessage);
				} else {
				response.forEach(function(info) {
					var profileImageSrc = info.Profile ? `<?= base_url('assets/uploads/') ?>${info.Profile}` : '<?= base_url('assets/img/default.jpeg') ?>'
					var profileCard = `
                            <div>
                            <div class="blue-bar"></div>
							<div class="monitor">
								<img src="${profileImageSrc}" id="gridpic">                                                                           
								<span class="program" style="margin-bottom: 5px;">${info.Program}</span> 
								<h2>${info.Name}</h2>
								<small>Section: ${info.Section}</small> 
								<small style="margin-bottom: 5px;">Supervisor: ${info.Supervisor}</small>
								<div class="monitor-button" style="display: flex; flex-direction: row; margin-bottom: 5px;">
									<button onclick="StudentFinalDemo(${info.ID}, '${info.Name}')" class="btn btn-primary" type="button" style="margin-right: 2%;" data-target="#FinalDemoList" data-toggle="modal">
                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                </button>  
                                    <button onclick="javascript:void(0)"  class="btn btn-warning" type="button" style="margin-right: 2%;">Transmuted Grade ${info.TotalGrade}</button>		
								</div>
							</div>
                            </div>
						`;
					pstHolder.append(profileCard);
				});
			}},
			error: function(error) {
				console.log(error);
			}
		});
	}

    function searchByMajor() {
		var selectedMajor = $('#School').val(); 
		var pstHolder = $('#showstats'); 
		pstHolder.empty(); 
		$.ajax({
			type: 'GET',
			url: '<?= site_url('SupervisorController/FindByMajor') ?>',
			data: {
				major: selectedMajor 
			},
			dataType: 'json',
			success: function(response) {
				if (response.length === 0) {
					var noDataMessage = `
							<div class="monitor">
								<img src="<?= base_url('assets/img/default.jpeg') ?>" id="gridpic">                                                                           
								<span class="program">N/A</span> 
								<h2>No Current PST Deployed in this Major</h2>
								<small style="margin-bottom: 3px;">Note: You can deploy PST studeny by visiting the Deployment module</small>
								<div class="monitor-button" style="display: flex; flex-direction: row;">
									<button class="btn btn-primary" type="button" style="margin-right: 2%;">N/A</button>  
								</div>
							</div>
					`;
					pstHolder.append(noDataMessage);
				} else {
					response.forEach(function(info) {
						var profileImageSrc = info.Profile ? `<?= base_url('assets/uploads/') ?>${info.Profile}` : '<?= base_url('assets/img/default.jpeg') ?>';
						var profileCard = `
                            <div>
                            <div class="blue-bar"></div>
							<div class="monitor">
								<img src="${profileImageSrc}" id="gridpic">                                                                           
								<span class="program" style="margin-bottom: 5px;">${info.Program}</span> 
								<h2>${info.Name}</h2>
								<small>Section: ${info.Section}</small> 
								<small style="margin-bottom: 5px;">Supervisor: ${info.Supervisor}</small>
								<div class="monitor-button" style="display: flex; flex-direction: row; margin-bottom: 5px;">
									<button onclick="StudentFinalDemo(${info.ID}, '${info.Name}')" class="btn btn-primary" type="button" style="margin-right: 2%;" data-target="#FinalDemoList" data-toggle="modal">
                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                </button>  
                                    <button onclick="javascript:void(0)"  class="btn btn-warning" type="button" style="margin-right: 2%;">Transmuted Grade ${info.TotalGrade}</button>		
								</div>
							</div>
                            </div>
						`;
						pstHolder.append(profileCard);
					});
				}
			},
			error: function(error) {
				console.log(error);
			}
		});
	}

    function StudentFinalDemo(id, name) {
        fetchTransmutedGrade(id)
        $('#EvalResult').empty();
        $('#PSTName').text(name);
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('SupervisorController/FinalDemoPreview'); ?>',
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

    function fetchTransmutedGrade(id) {
      $.ajax({
         type: 'POST',
         url: '<?php echo site_url('SupervisorController/GenerateFinalAverage'); ?>',
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
                url: '<?php echo site_url('SupervisorController/DemoScores'); ?>',
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