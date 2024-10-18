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
		<p class="announce-para">Deployment <span> Pre-Service Teachers</span></p>
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

	<label for="depstudent" class="search-label">Search (Name or Course):</label>
	<input type="text" name="depstudent" id="depstudent" placeholder="Name/Course" class="search-input" />
	<div class="space"></div>

	<div id="DeployResult" class="todo-container"></div>

	<!-- Deployment Modal -->
	<div class="modal fade" id="CoopPST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						<div class="logos">
							<div class="logo-right">
								<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50" />
							</div>
							SELECT COOPERATING TEACHER
						</div>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="space"></div>
				<div class="col-md-8">
					<label for="depcoop" class="search-label">Search (Name or School):</label>
					<input type="text" name="depstudent" id="depcoop" placeholder="Name/School" class="search-input" />
				</div>
				<input type="number" id="pstId" class="form-control" name="pstId" hidden />
				<div class="modal-body" id="coopTeacher"></div>
				<div class="modal-footer">
					<input type="hidden" id="ECashID" />
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
	<script src="<?=base_url('assets/sweetalert2/dist/sweetalert2.all.js')?>"></script>

	<script>
		   $(document).ready(function() {
			PDOStudent();
       		})

            function deploymentID(id) {
                $('#CoopPST').modal('show');
                $('#pstId').val(id);
                PDOTeacher();
            }

               function PDOStudent() {
                $('#DeployResult').empty();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('SupervisorController/FetchAllofPST'); ?>',
                    success: function(response) {
                        if (response && response.length > 0) {
                            response.forEach(function(info) {
                                var appendPST = $(`
                                        <div class="todo-item">
                                            <button onclick="deploymentID(${info.ID})" class="removee-to-do" type="button">Deploy</button> 
                                            <h2>${info.Name}<span class="ave">${info.Program}</span></h2>
                                            <small style="color: #4F6128; font-weight: 700;">Section: ${info.Section}</small> 
                                            <small>Supervisor: ${info.Supervisor}</small> 
                                        </div>
                               
                                `);
                                $('#DeployResult').append(appendPST);
                            });
                        } else {
                            var noStudentsDeployed = $(`
                                <div class="todo-item">
                                    <button class="removee-to-do" type="button">N/A</button> 
                                    <h2>All of the PST Student has been Deployed</h2>
                                    <small>Note: If you want to undeploy student kindly delete his/her account and create new account</small>
                                </div>
                            `);
                            $('#DeployResult').append(noStudentsDeployed);
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            function searchdeploystudent() {
                $('#DeployResult').empty();
               var searchTerm = $('#depstudent').val().trim(); 
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url('SupervisorController/SearchPSTStudents'); ?>',
                        data: { searchTerm: searchTerm }, 
                        success: function(response) {
                            $('#DeployResult').empty(); 
                            if (response && response.length > 0) {
                                response.forEach(function(info) {
                                    var appendPST = $(`
                                            <div class="todo-item">
                                                <button onclick="deploymentID(${info.ID})" class="removee-to-do" type="button">Deploy</button> 
                                                <h2>${info.Name}<span class="ave">${info.Program}</span></h2>
                                                <br>
                                                <small style="color: #4F6128; font-weight: 700;">Section: ${info.Section}</small> 
                                                <small>Supervisor: ${info.Supervisor}</small> 
                                            </div>
                                    `);
                                    $('#DeployResult').append(appendPST);
                                });
                            } else {
                                var noStudentsDeployed = $(`
                                <div class="todo-itemprof">
                                    <button class="removee-to-do" type="button">N/A</button> 
                                    <h2>The PST student you are searching for is not exisitng</h2>
                                    <small>Note: If you want to undeploy student kindly delete his/her account and create new account</small>
                                </div>
                            `);
                            $('#DeployResult').append(noStudentsDeployed);
                            }
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
                
            $('#depstudent').keyup(function() {
                searchdeploystudent();
            });

            function PDOTeacher() {
                $('#coopTeacher').empty();
                var studentID = $('#pstId').val().trim(); 
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('SupervisorController/FetchAllofCoop'); ?>',
                    success: function(response) {
                        if (response && response.length > 0) {
                            response.forEach(function(info) {
                                var appendPST = $(`
                                    <div id="profShow">
                                        <div class="todo-itemprof">
                                        <button onclick="deployTeacher(${studentID}, ${info.ID}, '${info.Name}', '${info.School}', '${info.Division}', '${info.Grade}', '${info.Coordinator}')" class="removee-to-do" type="button">Deploy</button>
                                            <h2>${info.Name}<span class="ave">${info.School}</span></h2>
                                            <small style="color: #4F6128; font-weight: 700;">Section: ${info.Division}</small> 
                                            <small>Supervisor: ${info.Coordinator}</small> 
                                        </div>
                                    </div>
                                `);
                                $('#coopTeacher').append(appendPST);
                            });
                        } else {
                            var noStudentsDeployed = $(`
                                <div class="todo-itemprof">
                                    <button class="removee-to-do" type="button">N/A</button> 
                                    <h2>All of the Cooperating Teacher has been Deployed</h2>
                                    <small>Note: If you want to undeploy resource teacher kindly delete his/her student account</small>
                                </div>
                            `);
                            $('#coopTeacher').append(noStudentsDeployed);
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            function searchCoopTeacher() {
                $('#coopTeacher').empty();
                var studentID = $('#pstId').val().trim(); 
                var searchTerm = $('#depcoop').val().trim(); 
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url('SupervisorController/SearchCooperatingTeach'); ?>',
                        data: { searchTerm: searchTerm }, 
                        success: function(response) {
                            $('#coopTeacher').empty(); 
                            if (response && response.length > 0) {
                                response.forEach(function(info) { 
                                    var appendPST = $(`
                                    <div id="profShow">
                                        <div class="todo-itemprof">
                                        <button onclick="deployTeacher(${studentID}, ${info.ID}, '${info.Name}', '${info.School}', '${info.Division}', '${info.Grade}', '${info.Coordinator}')" class="removee-to-do" type="button">Deploy</button>
                                            <h2>${info.Name}<span class="ave">${info.School}</span></h2>
                                            <small style="color: #4F6128; font-weight: 700;">Section: ${info.Division}</small> 
                                            <small>Supervisor: ${info.Coordinator}</small> 
                                        </div>
                                    </div>
                                `);
                                $('#coopTeacher').append(appendPST);
                                });
                            } else {
                                var noStudentsDeployed = $(`
                                <div class="todo-itemprof">
                                    <button class="removee-to-do" type="button">N/A</button> 
                                    <h2>All of the Cooperating Teacher has been Deployed</h2>
                                    <small>Note: If you want to undeploy resource teacher kindly delete his/her student account</small>
                                </div>
                            `);
                            $('#coopTeacher').append(noStudentsDeployed);
                            }
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
                
            $('#depcoop').keyup(function() {
                searchCoopTeacher();
            });

            function deployTeacher(idpst, idcoop, name, school, division, grade, coor) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('SupervisorController/DeployPSTnCoop'); ?>',
                    data: { 
                        idpst: idpst, 
                        idcoop: idcoop, 
                        name: name, 
                        school: school, 
                        division: division, 
                        grade: grade, 
                        coor: coor 
                    },
                    dataType: 'json', 
                    success: function(response) {
                        if (response.status === 200) {
                            message('success', `PST Successfully Deployed`, 2500);
                            $('#DeployResult').empty();
                            PDOStudent();
                            $('#CoopPST').modal('hide');
                        } else {
                            message('error', 'Something Went Wrong Please Try Again', 2500);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', xhr.responseText);
                        console.error('Status:', status);
                        console.error('Error:', error);
                    }
                });
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