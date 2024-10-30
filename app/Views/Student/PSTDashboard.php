<form>
   <div class="dashboard">
   <p class="announce-para">Welcome Back PST <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></p>
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
   <input type="text" name="id" id="id" value="<?php echo $_SESSION['ID']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>
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
</form>
<script>

	(function() {
    const charts = {
        barChart: null,
        lineChart: null
    };

    $(document).ready(function() {
        var id = $('#id').val();
        var name = $('#name').val();
        displayDashboard(id, name); 
        LoadStudentLineChart(id);
		LoadStudentBarChart(id);
      });

	function formatDate(dateString) {
		const date = new Date(dateString);
		const options = { year: 'numeric', month: 'long', day: 'numeric' };
		return date.toLocaleDateString('en-US', options);
	}


	function displayDashboard(id, name) {
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
			url: '<?= site_url('StudentController/PSTTableDTR') ?>',
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

	function LoadStudentBarChart(id) {
		$.ajax({
			type: 'GET',
			url: '<?= site_url('StudentController/PSTBarChart') ?>',
			data: {
				ID: id
			},
			dataType: 'json',
			success: function(response) {

				if (charts.barChart) {
					charts.barChart.destroy();
            	}

				var ctx = document.getElementById('varChart').getContext('2d');

				charts.barChart = new Chart(ctx, {
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
			url: '<?= site_url('StudentController/PSTInfoChart') ?>',
			data: {
				ID: id
			},
			dataType: 'json',
			success: function(response) {
				if (charts.lineChart) {
					charts.lineChart.destroy();
				}
				const totalScore = response.scores.reduce((acc, score) => acc + Number(score), 0);
				const averageScore = (totalScore / response.scores.length).toFixed(2);

				$('#totalScores').text(averageScore + '%');
				var ctx = document.getElementById('scoreChart').getContext('2d');
				charts.lineChart = new Chart(ctx, {
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
})();
</script>