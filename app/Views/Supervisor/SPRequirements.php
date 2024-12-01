<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form id="statistic">
   <div class="dashboard">
   <p class="announce-para">Pre-Service Teacher <span> E-Portfolio & CBAR</span></p>
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
   <table class="table table-striped" id="RequirementsTable">
			  <thead>
			    <tr>
                    <th scope="col">STUDENT</t>
			        <th scope="col">RESOURCE TEACHER</th>
				    <th scope="col">SCHOOL</th>
                    <th scope="col">BLOCK</th>
                    <th scope="col">RESEARCH (CBAR)</th>
				    <th scope="col">E-PORTFOLIO</th>
				    <th scope="col">GRADE</th>
			    </tr>
			  </thead>
			  <tbody>
			  </tbody>	 
			</table>
      <div class="space"></div>
	  <div class="divider"></div>

    <!-- Preview Requirements Modal -->
    <div class="modal fade" id="PreviewStudentRequirements" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg"  style="max-width: 80%;" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">
                           <div class="logos">
                              <div class="logo-right">
                                 <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                              </div>
                              <div>CBAR and Porfolio of PST  <span id="StudentName" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"></span></div>
                           </div>	
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <div class="modal-body">
                  <div class="space"></div>
                        <div style="display: flex; justify-content: space-between; width: 100%;">
                            <div id="portfolioDiv" style="width: 50%; padding-right: 10px;">

                            </div>
                            <div id="cbarDiv" style="width: 50%; padding-right: 10px;">
                            
                            </div>
                        </div>
                   </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>
            </div>
         </div>
      </div>

   <!-- Grade Requirements Modal -->
    <div class="modal fade" id="GradeStudentRequirements" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg"  style="max-width: 30%;" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">
                           <div class="logos">
                              <div class="logo-right">
                                 <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                              </div>
                              <div><span id="Type"> </span>  <span id="NameStud" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"></span></div>
                           </div>	
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <div class="modal-body">
                  <input type="number" class="form-control" id="RequirementID" hidden>
                  <div class="row">
                      <div class="col-md-8">
                            <label>TITLE</label>
                            <input type="text" class="form-control" id="Title" readonly>
                      </div>
                      <div class="col-md-4">
                              <label><span style="color: red;">GRADE</span></label>
                            <input type="number" class="form-control" id="Grade">
                      </div>
                  </div>
                  <div class="space"></div>
                  <div class="prof-center">
						<iframe id="displayRequirement" style="width: 90%; height: 60vh;"></iframe>
				  </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" onclick="UpdateRequirementGrade()">Update Grade</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
            </div>
         </div>
      </div>

</form>
<script>

    $(document).ready(function() {
	    PopulateRequirements();
    })

    function UpdateRequirementGrade() {
        var requirementsid = $('#RequirementID').val();
        var grade = $('#Grade').val();
        $.ajax({
               type: 'POST',
               url: '<?php echo site_url('SupervisorController/UpdateRequirements'); ?>',
               data: {
                  ID: requirementsid,
                  Grade: grade,
               },
               dataType: 'json',
               success: function(response) {
                if(response.invalid){
                    message('error', response.invalid, 2000);
                }else{
                    message('success', response.message, 2000);
                    PopulateRequirements();
                    $('#PreviewStudentRequirements').modal('hide');
                    $('#GradeStudentRequirements').modal('hide');
                }
               },
               error: function(error) {
                  console.error('Error fetching data:', error);
               }
         });
    }

    function PopulateRequirements() { 
         
         var table = $('#RequirementsTable').DataTable({
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
            url: '<?= site_url('SupervisorController/RequirementsStatus') ?>', 
            dataType: 'json',
            success: function(response) {    
               table.clear().draw();
                  const res = response.data;
                        if (res.length > 0) {
                           res.forEach(function(info) {
                              var rowData = $(`<tr id="trid${info.ID}">
                              <td>${info.Name}</td>
                              <td>${info.ResourceTeacher}</td>
                              <td>${info.DeployedSchool}</td>
                              <td>${info.BlockSection}</td>
                              <td>
                                 <button 
                                    style="opacity: 1 !important; font-size: 11px !important;" 
                                    class="btn btn-primary" disabled>
                                       ${info.CBAR}
                                 </button>
                              </td>
                              <td>
                                 <button 
                                    style="opacity: 1 !important; font-size: 11px !important;" 
                                    class="btn btn-primary" disabled>
                                       ${info.Portfolio}
                                 </button>
                              </td>
                              <td>
                              <button data-toggle="modal" type="button" data-target="#PreviewStudentRequirements" onclick="GetStudentRequirements(event, ${info.ID}, '${info.Name}');"
                                 class="btn btn-warning"><span class="fa fa-pencil"></span></button>
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

      $('#PreviewStudentRequirements').on('hidden.bs.modal', function () {
        $('#portfolioDiv').empty();
		$('#cbarDiv').empty();
      });

      $('#GradeStudentRequirements').on('hidden.bs.modal', function () {
        const pdfView = document.getElementById('displayRequirement');
        pdfView.src = '';
        $('#Type').text('');
        $('#NameStud').text('');
        $('#Title').val('');
        $('#Grade').val('');
        $('#RequirementID').val('');
      });

      function GradeRequirements(id, source, type, title, grade, name) {
            $('#Type').text(type);
            $('#NameStud').text(name);
            $('#Title').val(title);
            $('#Grade').val(grade);
            $('#RequirementID').val(id);
            
            const pdfView = document.getElementById('displayRequirement');
            pdfView.src = source;
        }


      function GetStudentRequirements(e, id, name) {
        $('#StudentName').text(name);
		var baseUrl = '<?= base_url('assets/requirements/'); ?>';
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('SupervisorController/PSTGetAllRequirements'); ?>',
			data: { ID: id },
			success: function(response) {
				$('#portfolioDiv').empty();
				$('#cbarDiv').empty();
				var portofolioDiv = $('#portfolioDiv');
				var cbarDiv = $('#cbarDiv');

				var hasPortfolio = false;
				var hasCBAR = false;

				if (response === null || response.length === 0) {
					var noPortfolioFetch = $(`
						<p class="prof-title"> I. Portfolio</p>
						<div class="todo-itemprof">
							<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
								<div style="width: auto; flex-grow: 1;">
									<h2>Portfolio:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current Portfolio Attached</span></h2>
									<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your Portfolio</small>
								</div>
							</div>
						</div>
					`);
					
					var noCBARFetch = $(`
						<p class="prof-title"> II. Action-Based Research</p>
						<div class="todo-itemprof">
							<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
								<div style="width: auto; flex-grow: 1;">
									<h2>CBAR:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current CBAR Attached</span></h2>
									<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your CBAR</small>
								</div>
							</div>
						</div>
					`);

					portofolioDiv.append(noPortfolioFetch);
					cbarDiv.append(noCBARFetch);

				} else {
					response.forEach(function(info) {
						const formattedDate = formatDate(info.Date);
						if (info.Type === 'Portfolio') {
							hasPortfolio = true;
							const file = info.FilePath;
							if(isValidPdfFilePath(file)){
								var fileName = `${id}/${info.FilePath}`;
								var sourceView = `${baseUrl}${fileName}`;
							}else{
								var sourceView = file;
							}
							var portfolioFetch = $(`
								<p class="prof-title"> I. Portfolio</p>
								<div class="todo-itemprof">
									<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
										<div style="width: auto; flex-grow: 1;">
											<h2>Portfolio:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Title}</span></h2>
											<small style="color: rgba(100, 50, 30); font-weight: 700;">Total Grade: ${info.Grade == '0' ? 'Not Graded Yet' : info.Grade}</small>
											<small>Date: ${formattedDate}</small>
										</div>
										<div style="width: auto;">
											<button onclick="PreviewFile('${sourceView}')" class="btn btn-secondary" type="button" id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button>
                                            <button onclick="GradeRequirements(${info.ID}, '${sourceView}', 'Portfolio', '${info.Title}', ${info.Grade}, '${name}')" class="btn btn-primary" type="button"  data-target="#GradeStudentRequirements" data-toggle="modal"><span class="fas fa-pencil"></span></button>
										</div>
									</div>
								</div>
								<div class="space"></div>
								<div class="prof-center">
									<iframe src="${sourceView}" style="width: 90%; height: 40vh;"></iframe>
								</div>
							`);
							portofolioDiv.append(portfolioFetch);
						} else if (info.Type === 'CBAR') {
							const formattedDate = formatDate(info.Date);
							hasCBAR = true;
							const fileCBAR = info.FilePath;
							if(isValidPdfFilePath(fileCBAR)){
								var fileName = `${id}/${info.FilePath}`;
								var sourceView = `${baseUrl}${fileName}`;
							}else{
								var sourceView = fileCBAR;
							}
							var cbatFetch = $(`
									<p class="prof-title"> II. Action-Based Research</p>
									<div class="todo-itemprof">
										<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
											<div style="width: auto; flex-grow: 1;">
												<h2>CBAR:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Title}</span></h2>
												<small style="color: rgba(100, 50, 30); font-weight: 700;">Total Grade: ${info.Grade == '0' ? 'Not Graded Yet' : info.Grade}</small>
												<small>Date: ${formattedDate}</small>
											</div>
											<div style="width: auto;">
												<button onclick="PreviewFile('${sourceView}')" class="btn btn-secondary" type="button" id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button>
                                                <button onclick="GradeRequirements(${info.ID}, '${sourceView}', 'CBAR', '${info.Title}',  ${info.Grade}, '${name}')" class="btn btn-primary" type="button"  data-target="#GradeStudentRequirements" data-toggle="modal"><span class="fas fa-pencil"></span></button>
											</div>
										</div>
									</div>
									<div class="space"></div>
									<div class="prof-center">
										<iframe src="${sourceView}" style="width: 100%; height: 40vh;"></iframe>
									</div>
							`);
							cbarDiv.append(cbatFetch);
						}
					});

					if (!hasPortfolio) {
						var noPortfolioFetch = $(`
							<p class="prof-title"> I. Portfolio</p>
							<div class="todo-itemprof">
								<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
									<div style="width: auto; flex-grow: 1;">
										<h2>Portfolio:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current Portfolio Attached</span></h2>
										<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your Portfolio</small>
									</div>
								</div>
							</div>
						`);
						portofolioDiv.append(noPortfolioFetch);
					}

					if (!hasCBAR) {
						var noCBARFetch = $(`
							<p class="prof-title"> II. Action-Based Research</p>
							<div class="todo-itemprof">
								<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
									<div style="width: auto; flex-grow: 1;">
										<h2>CBAR:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current CBAR Attached</span></h2>
										<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your CBAR</small>
									</div>
								</div>
							</div>
						`);
						cbarDiv.append(noCBARFetch);
					}
				}
			},
			error: function(error) {
				console.error("Error fetching user profile:", error);
			}
		});
	}

    function isValidWebsiteUrl(url) {
		const regex = /^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,6}(\/[^\s]*)?$/i;  
		return regex.test(url);
	}

	function isValidPdfFilePath(filePath) {
		const regex = /(\.pdf)$/i;  
		return regex.test(filePath);
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

	function PreviewFile(url) {
        window.open(url, '_blank');
    }	

</script>