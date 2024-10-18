<form>
   <!-- Chosen CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
   <!-- DataTables CSS -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" />
   <div class="dashboard">
   <p class="announce-para">Monitor <span> PST Progress</span></p>
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
	   <input type="text" name="statpst" id="statpst" placeholder="Enter your search term" class="search-input">
	   <button type="button" onclick="searchStatPst()" class="search-button">Search</button>
   </div>
      <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
         <label class="search-input" style="margin-bottom: 0px !important;">Major</label>
            <select class="chosen-select search-input" id="School">
                <option>Select Major</option>
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
   <!--
   <div class="todo-item">
      <button class="removee-to-do" type="button">N/A</button> 
      <h2>No PST is currently Deployed</h2>
      <br>
      <small>Note: If you want to deploy student kindly go to deoplyment button</small>
   </div>
   -->
   <div id="showstats">
  
   </div>
   <div class="space"></div>
   <div class="divider"></div>
   
   
<!-- PST DASHBOARD MODAL -->
	<div class="modal fade" id="DashboardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 70%;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Pre-Service Teacher <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></div>
							</div>	
						</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="eval-update">
						<div class="canvas-container">
							<h2 style=" font-family: 'Helvetica', 'Arial', sans-serif;"> Evaluation Statistic Total average of <span style="margin-left: 5px; color: navy; font-weight: 700;" id="totalScores"></span></h2>
							<canvas id="scoreChart" width="550" height="200"></canvas>
					    </div>
						<div class="canvas-container">
							  <h2 style=" font-family: 'Helvetica', 'Arial', sans-serif;">PST Recent Scores and Ratings</h2>
							  <canvas id="varChart" width="550" height="200"></canvas> 
						</div>
					</div>  
					<div class="eval-studd">
						<h2 style=" font-family: 'Helvetica', 'Arial', sans-serif;">Recent <span style="color: navy; font-weight: 700;"> Daily Time Record</span></h2>
						<table class="table table-striped" id="TableForDTR">
							   <thead>
								  <tr>
									  <th scope="col">Date</th>
									  <th scope="col">Time In</th>
									  <th scope="col">Time Out</th>
									  <th scope="col">Total Hours</th>
									  <th scope="col">Status</th>
								  </tr>
							  </thead>
						   </tbody>
						</table>
				        <tbody>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<!-- PST EVALUATION MODAL -->
<div class="modal fade" id="EvaluationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 50%;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Evaluation Forms of <span id="divEvalPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></div>
							</div>	
						</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
						<table class="table table-striped" id="TableForEvaluation">
							   <thead>
								  <tr>
									  <th scope="col">Lesson</th>
									  <th scope="col">Date</th>
									  <th scope="col">Conciseness</th>
									  <th scope="col">Clearness</th>
									  <th scope="col">Clarity</th>
									  <th scope="col">Correctness</th>
									  <th scope="col">Average</th>
									  <th scope="col">Remarks</th>
								  </tr>
							  </thead>
						   </tbody>
						</table>
				        <tbody>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<!-- PST REMARKS MODAL -->
<div class="modal fade" id="RemarksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 40%;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Lesson: <span id="divLessonName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></div>
							</div>	
						</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="ReflectRemarks"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?=base_url('assets/sweetalert2/dist/sweetalert2.all.js')?>"></script>
<script>
	$(document).ready(function() {
		onloadStudent();
	})

	let barChart;
	let lineChart;

	function onloadStudent() {
		var pstHolder = $('#showstats');
		$.ajax({
			type: 'GET',
			url: '<?= site_url('SupervisorController/LoadAllPST ') ?>',
			dataType: 'json',
			success: function(response) {
				pstHolder.empty();
				response.forEach(function(info) {
					var profileImageSrc = info.Profile ? `<?= base_url('assets/uploads/') ?>${info.Profile}` : '<?= base_url('assets/img/default.jpeg') ?>'
					var profileCard = `
							<div class="monitor">
								<img src="${profileImageSrc}" id="gridpic">                                                                           
								<span class="program">${info.Program}</span> 
								<h2>${info.Name}</h2>
								<small>Section: ${info.Section}</small> 
								<small style="margin-bottom: 3px;">Supervisor: ${info.Supervisor}</small>
								<div class="monitor-button" style="display: flex; flex-direction: row;">
									<button onclick="displayDashboard(${info.ID}, '${info.Name}')" class="btn btn-primary" type="button" style="margin-right: 2%;" data-target="#DashboardModal" data-toggle="modal">Monitor</button>  
									<button onclick="displayProfile()" class="btn btn-success" type="button" style="margin-right: 2%;">
										<span class="fa fa-user" aria-hidden="true"></span>
									</button> 
									<button onclick="displayEvaluation(${info.ID}, '${info.Name}')" class="btn btn-warning" type="button" data-target="#EvaluationModal" data-toggle="modal">
										<span class="fa fa-print" aria-hidden="true"></span>
									</button> 			
								</div>
							</div>
						`;
					pstHolder.append(profileCard);
				});
			},
			error: function(error) {
				console.log(error);
			}
		});
	}

	function displayDashboard(id, name) {
		LoadStudentLineChart(id);
		LoadStudentBarChart(id);
		$('#divForPSTName').text(name);
		if ($.fn.DataTable.isDataTable('#TableForDTR')) {
			$('#TableForDTR').DataTable().destroy();
		}
		var table = $('#TableForDTR').DataTable({
			searching: false,
			paging: false,
			ordering: false,
			info: false,
			responsive: false
		});
		$.ajax({
			type: 'GET',
			url: '<?= site_url('SupervisorController/GetTableDTR ') ?>',
			data: {
				ID: id
			},
			dataType: 'json',
			success: function(response) {
				table.clear().draw();
				const res = response.data;
				if (res.length > 0) {
					res.forEach(function(info) {
						var rowData = $(`
									<tr>
										  <td>${info.Date}</td>
										  <td>${info.TimeIn}</td>
										  <td>${info.TimeOut}</td>
										  <td>${info.TotalHrs}</td>
										  <td style="color:${info.Status === 'Not Approved' ? 'red' : 'green'};">
											  ${info.Status}
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

	function LoadStudentBarChart(id) {
		$.ajax({
			type: 'GET',
			url: '<?= site_url('SupervisorController/GetBarChart ') ?>',
			data: {
				ID: id
			},
			dataType: 'json',
			success: function(response) {
				if (barChart) {
					barChart.destroy();
				}

				var ctx = document.getElementById('varChart').getContext('2d');

				barChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: response.labels,
						datasets: [{
								label: 'Conciseness',
								data: response.aT,
								backgroundColor: 'rgba(0, 123, 255, 0.7)',
								borderColor: 'rgba(0, 123, 255, 1)',
								borderWidth: 3
							},
							{
								label: 'Clearness',
								data: response.bT,
								backgroundColor: 'rgba(40, 167, 69, 0.7)',
								borderColor: 'rgba(40, 167, 69, 1)',
								borderWidth: 3
							},
							{
								label: 'Clarity',
								data: response.cT,
								backgroundColor: 'rgba(255, 193, 7, 0.7)',
								borderColor: 'rgba(255, 193, 7, 1)',
								borderWidth: 3
							},
							{
								label: 'Correctness',
								data: response.dT,
								backgroundColor: 'rgba(220, 53, 69, 0.7)',
								borderColor: 'rgba(220, 53, 69, 1)',
								borderWidth: 3
							}
						]
					},
					options: {
						responsive: false,
						maintainAspectRatio: false,
						scales: {
							y: {
								beginAtZero: true,
								ticks: {
									font: {
										family: 'Arial',
										size: 14,
										weight: 'bold'
									}
								}
							}
						},
						plugins: {
							legend: {
								labels: {
									font: {
										family: 'Arial',
										size: 13,
										weight: 'bold'
									}
								}
							},
							tooltip: {
								callbacks: {
									label: function(context) {
										return context.dataset.label + ': ' + context.parsed.y + '%';
									}
								},
								titleFont: {
									family: 'Arial',
									size: 16,
									weight: 'bold'
								},
								bodyFont: {
									family: 'Arial',
									size: 14,
									weight: 'bold'
								}
							}
						},
						scales: {
							x: {
								ticks: {
									font: {
										family: 'Arial',
										size: 14,
										weight: 'bold'
									}
								}
							},
							y: {
								ticks: {
									font: {
										family: 'Arial',
										size: 14,
										weight: 'bold'
									}
								}
							}
						}
					}
				});
			},
			error: function(error) {
				console.log(error);
			}
		});
	}

	function LoadStudentLineChart(id) {
		$.ajax({
			type: 'GET',
			url: '<?= site_url('SupervisorController/GetInfoChart ') ?>',
			data: {
				ID: id
			},
			dataType: 'json',
			success: function(response) {
				if (lineChart) {
					lineChart.destroy();
					lineChart = null;
				}
				const totalScore = response.scores.reduce((acc, score) => acc + Number(score), 0);
				const averageScore = (totalScore / response.scores.length).toFixed(2);

				$('#totalScores').text(averageScore + '%');
				var ctx = document.getElementById('scoreChart').getContext('2d');
				lineChart = new Chart(ctx, {
					type: "line",
					data: {
						labels: response.labels,
						datasets: [{
							label: 'Evaluation Scores',
							data: response.scores,
							borderColor: 'rgba(0, 0, 128, 1)',
							backgroundColor: 'rgba(0, 0, 128, 0.1)',
							borderWidth: 5,
							fill: true,
						}]
					},
					options: {
						responsive: false,
						maintainAspectRatio: false,
						scales: {
							y: {
								beginAtZero: true,
								ticks: {
									font: {
										family: 'Arial',
										size: 14,
										weight: 'bold'
									}
								}
							}
						},
						plugins: {
							legend: {
								labels: {
									font: {
										family: 'Arial',
										size: 13,
										weight: 'bold'
									}
								}
							},
							tooltip: {
								callbacks: {
									label: function(context) {
										return context.dataset.label + ': ' + context.parsed.y + '%';
									}
								},
								titleFont: {
									family: 'Arial',
									size: 16,
									weight: 'bold'
								},
								bodyFont: {
									family: 'Arial',
									size: 14,
									weight: 'bold'
								}
							}
						},
						scales: {
							x: {
								ticks: {
									font: {
										family: 'Arial',
										size: 14,
										weight: 'bold'
									}
								}
							},
							y: {
								ticks: {
									font: {
										family: 'Arial',
										size: 14,
										weight: 'bold'
									}
								}
							}
						}
					}
				});
			},
			error: function(error) {
				console.log(error);
			}
		});
	}

	function displayEvaluation(id, name) {
		$('#divEvalPSTName').text(name);
		var table = $('#TableForEvaluation').DataTable({
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
						text: `PST ${name} Evaluation`,
                        title: `${name}`,
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
						text: `PST ${name} Evaluation`,
                        title: `${name}`,
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
						title: `PST ${name} Evaluation`,
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
						title: `PST ${name} Evaluation`,
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
            type: 'GET', 
            url: '<?= site_url('SupervisorController/GetPSTEvaluation') ?>', 
			data: {
				ID: id
			},
            dataType: 'json',
            success: function(response) {    
                table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
								const date = new Date(info.Date);
								const options = { year: 'numeric', month: 'long', day: 'numeric' };
								const formattedDate = date.toLocaleString('en-US', options);

                                var rowData = $(`<tr >
                                <td>${info.Lesson}</td>
                                <td>${formattedDate}</td>
                                <td>${info.aT}</td>
								<td>${info.bT}</td>
								<td>${info.cT}</td>
								<td>${info.dT}</td>
								<td>${info.Average}</td>
								<td><a href="javascript:void(0);" onclick="previewRemarks('${info.Remarks}', '${info.Lesson}');" data-target="#RemarksModal" data-toggle="modal"
								class="blue-button"><span class="fas fa-eye"></span></a></td>
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

	function previewRemarks(remarks, name){
		$('#divLessonName').text(name);
		if (remarks) {
			$('#ReflectRemarks').text(remarks);
		} else {
		$('#ReflectRemarks').text('There are no remarks for this lesson');
		}
	}
</script>