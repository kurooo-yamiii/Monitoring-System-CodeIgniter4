<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form id="pst">
	<div class="dashboard">

<p class="announce-para">Student <span> (Pre-Service Teacher Account)</span> </p>
	<div class="logos">
            <div class="logo">
                <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
            </div>
        </div>
     </div>     
<div class="divider"></div>
<div class="space"></div>
			
			<table class="table table-striped" id="startuptable">
			  <thead>
			    <tr>
			      <th scope="col">FULL NAME</th>
			      <th scope="col">PROGRAM</th>
				  <th scope="col">SECTION</th>
				  <th scope="col">CONTACT</th>
				  <th scope="col">MAIL</th>
				  <th scope="col">ACTION</th>
			    </tr>
			  </thead>
			  <tbody>
			  </tbody>	 
			</table>
      <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container">
		  		<button onclick="onSelectLoad()" type="button" class="btn-shadow btn btn-success" style="font-size: 14px;" data-target="#CreateModal"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-plus"></span> PST Account
                </button>
			</div>

<!-- ADD MODAL -->
<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
						<div class="logos">
							<div class="logo-right">
								<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
							</div>
							CREATE PST ACCOUNT
						</div>	
					</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
			<div class="row">

				<input type="text" 
                  class="form-control" 
                  id="Supervisor" 
                  name="supervisor"
                  value="<?php echo $_SESSION['Name']; ?>" 
                      hidden>
                                      
				<input type="id" 
					class="form-control" 
					id="ID" 
					name="id"
					value="<?php echo $_SESSION['ID']; ?>" 
                      hidden>
					  
				<div class="col-md-8">
                      <label><span style="color: red;">*</span>EMAIL</label>
                      <input type="text" class="form-control" id="Email"  pattern="[a-zA-Z0-9]+" 
					  title="Only letters and numbers are allowed">
				</div>

				<div class="col-md-4">
						<label><span style="color: red;">EXTENSION</span></label>
                      <input type="text" class="form-control" id="Ext" value="@rtu.ced.com" readonly>
				</div>

				
			</div>
			<div class="row" style="margin-top: 2%;">
				<div class="col-md-6">
                      <label><span style="color: red;">*</span>NAME</label>
                      <input type="text" class="form-control" id="Name">
                </div>
				<div class="col-md-6">
                      <label><span style="color: red;">*</span>CONTACT</label>
                      <input type="text" class="form-control" id="Contact">
                </div>
			</div>

			<div class="row" style="margin-top: 2%;">
				  <div class="col-md-6">
                      <label><span style="color: red;">*</span>PROGRAM</label>
                       <select class="chosen-select" id="Program">
                      </select>
                </div>

				<div class="col-md-6">
                      <label><span style="color: red;">*</span>SECTION</label>
                       <select class="chosen-select" id="Section">
                      </select>
                </div>

				</div>
            </div>
            <div class="modal-footer" style="margin-top: 5%;">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SaveUser" onclick="addNewPST(event)">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="DeletePST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DELETE USER ACCOUNT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <input type="text" id="DelId" hidden>
                <p>Are you sure you want to delete <span id="DelName" style="color: red;"></span> account?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="ECashID">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="SaveUser" onclick="pstDelete(event)">Delete PST</button>
            </div>

    </div>
 </div>
 </div>

	</form>
	<script>
		   $(document).ready(function() {
            getProgram();
            getSection();
			fetchRecentDep();
       		})

        function onSelectLoad() {
            $(".chosen-select").chosen({
                no_results_text: "No results matched",
                width: "100%" 
            });
        }    
            
        function getProgram(){
            const programSelect = $('#Program');
            programSelect.empty(); 
            programSelect.append('<option value="">Select Student Program</option>');
                $.ajax({
                type: 'GET', 
                url: '<?= site_url('SupervisorController/GetAllProgram') ?>',
                dataType: 'json',
                success: function(response) {    
                    const res = response.data;
                    if (res.length > 0) {
                        res.forEach(function(info) {
                            programSelect.append(`<option value="${info.Program}">${info.Program}</option>`);
                        });
                    }
                    },
                error: function(error) {
                    message('error',`Failed to Fetch Program, Try Again`, 2000);
                }
                });
		}

        function getSection(){
            const sectionSelect = $('#Section');
            sectionSelect.empty(); 
            sectionSelect.append('<option value="">Select Student Section</option>');
                $.ajax({
                type: 'GET', 
                url: '<?= site_url('SupervisorController/GetAllSection') ?>',
                dataType: 'json',
                success: function(response) {    
                    const res = response.data;
                    if (res.length > 0) {
                        res.forEach(function(info) {
                            sectionSelect.append(`<option value="${info.Section}">${info.Section}</option>`);
                        });
                    }
                    },
                error: function(error) {
                    message('error',`Failed to Fetch Program, Try Again`, 2000);
                }
                });
		}

		 function fetchRecentDep() { // Table Fetch
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
            url: '<?= site_url('SupervisorController/AllStudentAcc') ?>', 
            dataType: 'json',
            success: function(response) {    
                table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr id="trid${info.ID}">
                                <td>${info.Name}</td>
                                <td>${info.Program}</td>
                                <td>${info.Section}</td>
								<td>${info.Contact}</td>
								<td>${info.Username}</td>
								<td><a href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Name}');"type="button" class="red-button" data-target="#DeletePST" data-toggle="modal"><span class="fas fa-trash"></span></a> 
								<a href="javascript:void(0);" onclick="resetPassword(event, ${info.ID});"
									class="blue-button"><span class="fas fa-redo"></span></a>
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

		function addNewPST(e) {
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('SupervisorController/CreatePST') ?>',
			data: { Supervisor: $('#Supervisor').val(), ID: $('#ID').val(), Email: $('#Email').val(), Name: $('#Name').val(), Contact: $('#Contact').val(), Program: $('#Program').val(), Section: $('#Section').val() }, 
            dataType: 'json',
            success: function(response) {   
                if(response.invalid){
                    message('error', response.invalid, 2000);
                }else if(response.missing){
                    message('error', response.missing, 2000);
                }else{ 
				message('success',`PST Succesfully Generated`, 2000);
                ClearAllFields();
				fetchRecentDep();
				$('#CreateModal').modal('hide');
                }
            },
            error: function(error) {
				message('error',`Try Again! Invalid Credentials`, 2000);
				$('#CreateModal').modal('hide');
            }
            });
		}

        function ClearAllFields(){
            $('#Email').val('');
            $('#Name').val('');
            $('#Contact').val(''); 
            $('#Program').val('');          
            $('#Section').val('');       
            $('.chosen-select').trigger('chosen:updated');
        }

        $('#CreateModal').on('hidden.bs.modal', function () {
            ClearAllFields();
        });

		function deleteQues(id, name) {
			$('#DelId').val(id);
			$('#DelName').text(name.toUpperCase());
		}

		function pstDelete(e){
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('SupervisorController/DeletePST') ?>',
			data: { ID: $('#DelId').val() }, 
            dataType: 'json',
            success: function(response) {    
				message('success',`PST Succesfully Removed`, 2000);
				fetchRecentDep();
				$('#DeletePST').modal('hide');
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#DeletePST').modal('hide');
            }
            });
		}

		function resetPassword(e, id){
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('SupervisorController/ResetPST') ?>',
			data: { ID: id }, 
            dataType: 'json',
            success: function(response) {    
				message('success',`Password Has Been Reset`, 2000);
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
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