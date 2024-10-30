<form id="statistic">
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
		<div class="modal-dialog modal-lg" style="max-width: 55%;" role="document">
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
						      <tbody>
							</tbody>
						</table>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<!-- PST REMARKS MODAL -->
<div class="modal fade" id="RemarksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 45%;" role="document">
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
<!-- PST PROFILE MODAL -->
<div class="modal fade" id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 30%;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>PST <span id="divProfileName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></div>
							</div>	
						</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="ReflectProfile"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<!-- PST DTR MODAL -->
<div class="modal fade" id="DTRModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="max-width: 45%;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>DTR of PST <span id="divDTRName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></div>
							</div>	
						</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				<table class="table table-striped" id="AllDTRTable">
							   <thead>
								  <tr>
									  <th scope="col">Date</th>
									  <th scope="col">Time In</th>
									  <th scope="col">Time Out</th>
									  <th scope="col">Total Hours</th>
									  <th scope="col">Current Status</th>
								  </tr>
							  </thead> 
						      <tbody>
							</tbody>
						</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>
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
							<div class="monitor">
								<img src="${profileImageSrc}" id="gridpic">                                                                           
								<span class="program">${info.Program}</span> 
								<h2>${info.Name}</h2>
								<small>Section: ${info.Section}</small> 
								<small style="margin-bottom: 3px;">Supervisor: ${info.Supervisor}</small>
								<div class="monitor-button" style="display: flex; flex-direction: row;">
									<button onclick="displayDashboard(${info.ID}, '${info.Name}')" class="btn btn-primary" type="button" style="margin-right: 2%;" data-target="#DashboardModal" data-toggle="modal">Monitor</button>  
									<button onclick="displayDTR(${info.ID}, '${info.Name}')" class="btn btn-secondary" style="margin-right: 2%;" type="button" data-target="#DTRModal" data-toggle="modal">
										<span class="fa fa-calendar" aria-hidden="true"></span>
									</button> 
									<button onclick="displayProfile('${info.ID}', '${info.Name}', '${info.Section}', '${info.Program}', '${info.Contact}', '${info.Username}', '${info.Profile}', '${info.Supervisor}', '${info.Coordinator}', '${info.School}', '${info.Resource}', '${info.Division}', '${info.Grade}')" class="btn btn-success" type="button" style="margin-right: 2%;" data-target="#ProfileModal" data-toggle="modal">
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
			url: '<?= site_url('SupervisorController/SearchDeployedPST ') ?>',
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
							<div class="monitor">
								<img src="${profileImageSrc}" id="gridpic">                                                                           
								<span class="program">${info.Program}</span> 
								<h2>${info.Name}</h2>
								<small>Section: ${info.Section}</small> 
								<small style="margin-bottom: 3px;">Supervisor: ${info.Supervisor}</small>
								<div class="monitor-button" style="display: flex; flex-direction: row;">
									<button onclick="displayDashboard(${info.ID}, '${info.Name}')" class="btn btn-primary" type="button" style="margin-right: 2%;" data-target="#DashboardModal" data-toggle="modal">Monitor</button>  
									<button onclick="displayDTR(${info.ID}, '${info.Name}')" class="btn btn-secondary" style="margin-right: 2%;" type="button" data-target="#DTRModal" data-toggle="modal">
										<span class="fa fa-calendar" aria-hidden="true"></span>
									</button> 
									<button onclick="displayProfile('${info.ID}', '${info.Name}', '${info.Section}', '${info.Program}', '${info.Contact}', '${info.Username}', '${info.Profile}', '${info.Supervisor}', '${info.Coordinator}', '${info.School}', '${info.Resource}', '${info.Division}', '${info.Grade}')" class="btn btn-success" type="button" style="margin-right: 2%;" data-target="#ProfileModal" data-toggle="modal">
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
			url: '<?= site_url('SupervisorController/SearchByMajor') ?>',
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
							<div class="monitor">
								<img src="${profileImageSrc}" id="gridpic">                                                                           
								<span class="program">${info.Program}</span> 
								<h2>${info.Name}</h2>
								<small>Section: ${info.Section}</small> 
								<small style="margin-bottom: 3px;">Supervisor: ${info.Supervisor}</small>
								<div class="monitor-button" style="display: flex; flex-direction: row;">
									<button onclick="displayDashboard(${info.ID}, '${info.Name}')" class="btn btn-primary" type="button" style="margin-right: 2%;" data-target="#DashboardModal" data-toggle="modal">Monitor</button>  
									<button onclick="displayDTR(${info.ID}, '${info.Name}')" class="btn btn-secondary" style="margin-right: 2%;" type="button" data-target="#DTRModal" data-toggle="modal">
										<span class="fa fa-calendar" aria-hidden="true"></span>
									</button> 
									<button onclick="displayProfile('${info.ID}', '${info.Name}', '${info.Section}', '${info.Program}', '${info.Contact}', '${info.Username}', '${info.Profile}', '${info.Supervisor}', '${info.Coordinator}', '${info.School}', '${info.Resource}', '${info.Division}', '${info.Grade}')" class="btn btn-success" type="button" style="margin-right: 2%;" data-target="#ProfileModal" data-toggle="modal">
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
						const formattedDate = formatDate(info.Date);
						var rowData = $(`
									<tr>
										  <td>${formattedDate}</td>
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

	function displayProfile(id, name, section, program, contact, username, profile, supervisor, coordinator, school, resource, division, grade) {
		var profileDiv = $('#ReflectProfile'); 
		$('#divProfileName').text(name);
		profileDiv.empty();
		var profileImageSrc = profile ? `<?= base_url('assets/uploads/') ?>${profile}` : '<?= base_url('assets/img/default.jpeg') ?>';
		var userProfile = $(`
							<div class="prof-center">
								<img class="profile-image" src="${profileImageSrc}">
							</div>
							<div class="indent-left">
								<p class="prof-title">I. Profile of the Student</p>
								<table class="prof-table">
									<tr>
										<th class="profile-th" style="text-align: left !important;">Name:</th>
										<td class="profile-td" style="text-align: left !important;">${name}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Section:</th>
										<td class="profile-td" style="text-align: left !important;">${section}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Program:</th>
										<td class="profile-td" style="text-align: left !important;">${program}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Contact:</th>
										<td class="profile-td" style="text-align: left !important;">${contact}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Email:</th>
										<td class="profile-td" style="text-align: left !important;">${username}</td>
									</tr>
								</table>
							</div>
							<div class="indent-left">
								<p class="prof-title">II. Deployment Info</p>
								<table class="prof-table">
									<tr>
										<th class="profile-th" style="text-align: left !important;">Supervisor:</th>
										<td class="profile-td" style="text-align: left !important;">${supervisor ? supervisor : 'Not Yet Deployed'}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Coordinator:</th>
										<td class="profile-td" style="text-align: left !important;">${coordinator ? coordinator : 'Not Yet Deployed'}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">School:</th>
										<td class="profile-td" style="text-align: left !important;">${school ? school : 'Not Yet Deployed'}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Resource:</th>
										<td class="profile-td" style="text-align: left !important;">${resource ? resource : 'Not Yet Deployed'}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Division:</th>
										<td class="profile-td" style="text-align: left !important;">${division ? division : 'Not Yet Deployed'}</td>
									</tr>
									<tr>
										<th class="profile-th" style="text-align: left !important;">Grade Level:</th>
										<td class="profile-td" style="text-align: left !important;">${grade ? grade : 'Not Yet Deployed'}</td>
									</tr>
								</table>
							</div>
							</div>
						`);
			profileDiv.append(userProfile);
	}

	function displayDTR(id, name) {
		$('#divDTRName').text(name);
		var table = $('#AllDTRTable').DataTable({
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
						text: `PDF`,
                        title: `PST DTR`,
                        exportOptions: {
							columns: [0, 1, 2, 3, 4],
							format: {
								body: function (data, row, column, node) {
									return $(node).text(); 
								}
							}
						},
						
						customize: function (doc) {
							doc.pageOrientation = 'portrait'; 
							if (doc.content[0].table) {
								doc.content[0].table.widths = ['20%', '20%', '20%', '20%', '20%'];
							}
						},
						init: function(api, node, config) {
							$(node).removeClass('dt-button buttons-pdf buttons-html5');
						}
					},
                    {
                        extend: "copyHtml5",
                        className: 'btn btn-primary',
						text: `PST DTR`,
                        title: `PST DTR`,
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
						title: `PST DTR`,
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
						title: `PST DTR`,
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
            url: '<?= site_url('SupervisorController/GetPSTDTR') ?>', 
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
                                <td>${formattedDate}</td>
                                <td>${info.TimeIn}</td>
								<td>${info.TimeOut}</td>
								<td>${info.TotalHrs}</td>
								<td>
								 	<button 
											style="opacity: 1 !important; font-size: 10px !important;" 
											class="${info.Status === 'Not Approved' ? 'btn btn-secondary' : 'btn btn-success'}" 
											disabled
											>
											${info.Status === 'Not Approved' ? 'Not Approved' : 'Approved'}
										</button>
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


</script>