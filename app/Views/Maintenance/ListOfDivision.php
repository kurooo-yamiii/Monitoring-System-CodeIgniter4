<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">List of School <span> DIVISION</span></p>
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

   <table class="table table-striped" id="ListofDivision">
	    <thead>
		    <tr>
			    <th scope="col">ID</th>
			    <th scope="col">DIVISION</th>
				<th scope="col">TYPE</th>
				<th scope="col">ACTION</th>
		    </tr>
		</thead>
		<tbody>
		</tbody>	 
	</table>

    <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container">
		  		<button type="button" onclick="ClearAllFields()" class="btn-shadow btn btn-success" style="font-size: 14px;" data-target="#CreateNewDivisionModal"
                    id="CreateDeployingSchool" data-toggle="modal">
                    <span class="fas fa-plus"></span> ADD NEW DIVISION
                </button>
			</div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="CreateNewDivisionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                CREATE/UPDATE NEW DIVISION
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <input type="text" class="form-control" id="UpdateID" hidden>
                <div class="row">
                    <div class="col-md-8">
                        <label><span style="color: red;">*</span>DIVSION</label>
                        <input type="text" class="form-control" id="Division">
                    </div>
                    <div class="col-md-4">
                            <label><span style="color: red;">TYPE</span></label>
                             <select class="chosen-select" id="Type">
                                <option value="">Select Division Type</option>
                                <option value="STRAND">STRAND</option>
                                <option value="TLE">TLE</option>
                                <option value="SUBJECT">SUBJECT</option>
                            </select>
                    </div>
                </div>
                </div>
                <div class="modal-footer" style="margin-top: 5%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="AddDivision" onclick="CreateDivision(event)">Create Division</button>
                    <button type="button" class="btn btn-primary" id="UpdateDivision" onclick="UpdateSchoolDivision()">Update Division</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteSchoolDivision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                        <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                DELETE DIVISION
                            </div>	
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="DelId" hidden>
                    <p>Are you sure you want to delete the <span id="DelName" style="color: red;"></span> in the list of Division?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ECashID">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="SaveUser" onclick="DeletePasigSchool(event)">Delete Division</button>
                </div>

        </div>
    </div>
    </div>
</form>
<script>

    $(document).ready(function() {
        FetchAllDivision();
    })

        function ClearAllFields(){
            const AddButton = document.getElementById("AddDivision");
            const UpdateButton = document.getElementById("UpdateDivision");
            AddButton.style.display = 'block';
            UpdateButton.style.display = 'none';
            $(".chosen-select").chosen({
                no_results_text: "No results matched",
                width: "100%" 
            });
            $('.chosen-select').trigger('chosen:updated');
            $('#Division').val('');
            $('#Type').val('');
        }

        function DeletePasigSchool(e){
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('Maintenance/DeleteSchoolDivision') ?>',
			data: { ID: $('#DelId').val() }, 
            dataType: 'json',
            success: function(response) {    
				message('success',`Division Succesfully Deleted`, 2000);
				FetchAllDivision();
				$('#DeleteSchoolDivision').modal('hide');
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#DeleteSchoolDivision').modal('hide');
            }
            });
		}

        $('#CreateNewDivisionModal').on('hidden.bs.modal', function () {
            $('#Division').val('');
            $('#Type').val('');
        });

        function UpdateCreateButton(id, div, type) {
            const AddButton = document.getElementById("AddDivision");
            const UpdateButton = document.getElementById("UpdateDivision");
            AddButton.style.display = 'none';
            UpdateButton.style.display = 'block';
            $('#UpdateID').val(id);
            $('#Division').val(div);
            $('#Type').val(type);
            $(".chosen-select").chosen({
                no_results_text: "No results matched",
                width: "100%" 
            });
            $('.chosen-select').trigger('chosen:updated');
        }

        function UpdateSchoolDivision() {
            $.ajax({
            type: 'POST', 
            url: '<?= site_url('Maintenance/UpdateSchoolDivision') ?>',
			data: { ID: $('#UpdateID').val(), Division: $('#Division').val(), Type: $('#Type').val() }, 
            dataType: 'json',
            success: function(response) {   
                if(response.missing){
                    message('error', response.missing, 2000);
                }else if (response.existing) {
                    message('error', response.existing, 2000);
                }else{
                    message('success',`Deploying School Succesfully Updated`, 2000);
                    FetchAllDivision();
                    $('#CreateNewDivisionModal').modal('hide');
                }
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#CreateNewDivisionModal').modal('hide');
            }
            });

        }

        function CreateDivision(e) {
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('Maintenance/CreateDivision') ?>',
			data: { Division: $('#Division').val(), Type: $('#Type').val() }, 
            dataType: 'json',
            success: function(response) {   
                if(response.missing){
                    message('error', response.missing, 2000);
                } else if (response.existing) {
                    message('error', response.existing, 2000);
                }else{
                    message('success',`New Division Succesfully Generated`, 2000);
                    FetchAllDivision();
                    $('#CreateNewDivisionModal').modal('hide');
                }
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#CreateNewDivisionModal').modal('hide');
            }
            });
		}

        
		 function FetchAllDivision() { 
			var table = $('#ListofDivision').DataTable({
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
                                columns: [0,1,2]
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
                                columns: [0,1,2]
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
                                columns: [0,1,2]
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
                                columns: [0,1,2]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-csv buttons-html5')
                        }
					}
				]
			});

            $.ajax({
            type: 'GET', 
            url: '<?= site_url('Maintenance/GetAllDivision') ?>', 
            dataType: 'json',
            success: function(response) {    
                table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr id="${info.ID}">
                                <td>${info.ID}</td>
                                <td>${info.Division}</td>
                                <td>${info.Type}</td>
								<td><a href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Division}');"type="button" class="red-button" data-target="#DeleteSchoolDivision" data-toggle="modal"><span class="fas fa-trash"></span></a> 
								<a href="javascript:void(0);" onclick="UpdateCreateButton(${info.ID}, '${info.Division}', '${info.Type}');"
									class="blue-button" data-target="#CreateNewDivisionModal" data-toggle="modal"><span class="fa fa-pencil"></span></a>
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

        
		function deleteQues(id, division) {
			$('#DelId').val(id);
			$('#DelName').text(division.toUpperCase());
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