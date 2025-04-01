<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">List of School <span> Grade</span></p>
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

   <table class="table table-striped" id="ListofLevel">
	    <thead>
		    <tr>
			    <th scope="col">ID</th>
			    <th scope="col">GRADE</th>
				<th scope="col">LEVEL</th>
				<th scope="col">ACTION</th>
		    </tr>
		</thead>
		<tbody>
		</tbody>	 
	</table>

    <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container">
		  		<button type="button" onclick="ClearAllFields()" class="btn-shadow btn btn-success" style="font-size: 14px;" data-target="#CreateNewGradeModal"
                    id="CreateDeployingSchool" data-toggle="modal">
                    <span class="fas fa-plus"></span> ADD NEW LEVEL
                </button>
			</div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="CreateNewGradeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                CREATE/UPDATE NEW LEVEL
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
                        <label><span style="color: red;">*</span>GRADE</label>
                        <input type="text" class="form-control" id="Grade">
                    </div>
                    <div class="col-md-4">
                            <label><span style="color: red;">LEVEL</span></label>
                             <select class="chosen-select" id="Level">
                                <option value="">Select Grade Level</option>
                                <option value="ELEMENTARY">Elementary</option>
                                <option value="JHS">JHS</option>
                                <option value="SHS">SHS</option>
                                <option value="COLLEGIATE">Collegiate</option>
                            </select>
                    </div>
                </div>
                </div>
                <div class="modal-footer" style="margin-top: 5%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="AddGrade" onclick="CreateGrade(event)">Create Grade</button>
                    <button type="button" class="btn btn-primary" id="UpdateGrade" onclick="UpdateSchoolGrade()">Update Grade</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteSchoolGrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                        <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                DELETE PASIG DEPLOYING SCHOOL
                            </div>	
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="DelId" hidden>
                    <p>Are you sure you want to delete the <span id="DelName" style="color: red;"></span> in the list of Grade?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ECashID">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="SaveUser" onclick="DeleteGradeLevel(event)">Delete Grade</button>
                </div>

        </div>
    </div>
    </div>
</form>
<script>

    $(document).ready(function() {
        FetchAllGrade();
    })

        function ClearAllFields(){
            const AddButton = document.getElementById("AddGrade");
            const UpdateButton = document.getElementById("UpdateGrade");
            AddButton.style.display = 'block';
            UpdateButton.style.display = 'none';
            $(".chosen-select").chosen({
                no_results_text: "No results matched",
                width: "100%" 
            });
            $('.chosen-select').trigger('chosen:updated');
            $('#Grade').val('');
            $('#Level').val('');
        }

        function DeleteGradeLevel(e){
			e.preventDefault();
			$.ajax({
            Level: 'POST', 
            url: '<?= site_url('Maintenance/DeleteSchoolGrade') ?>',
			data: { ID: $('#DelId').val() }, 
            dataLevel: 'json',
            success: function(response) {    
				message('success',`Grade Succesfully Deleted`, 2000);
				FetchAllGrade();
				$('#DeleteSchoolGrade').modal('hide');
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#DeleteSchoolGrade').modal('hide');
            }
            });
		}

        $('#CreateNewGradeModal').on('hidden.bs.modal', function () {
            $('#Grade').val('');
            $('#Level').val('');
        });

        function UpdateCreateButton(id, grade, level) {
            const AddButton = document.getElementById("AddGrade");
            const UpdateButton = document.getElementById("UpdateGrade");
            AddButton.style.display = 'none';
            UpdateButton.style.display = 'block';
            $('#UpdateID').val(id);
            $('#Grade').val(grade);
            $('#Level').val(level);
            $(".chosen-select").chosen({
                no_results_text: "No results matched",
                width: "100%" 
            });
            $('.chosen-select').trigger('chosen:updated');
        }

        function UpdateSchoolGrade() {
            $.ajax({
            Level: 'POST', 
            url: '<?= site_url('Maintenance/UpdateSchoolGrade') ?>',
			data: { ID: $('#UpdateID').val(), Grade: $('#Grade').val(), Level: $('#Level').val() }, 
            dataLevel: 'json',
            success: function(response) {   
                if(response.missing){
                    message('error', response.missing, 2000);
                }else if (response.existing) {
                    message('error', response.existing, 2000);
                }else{
                    message('success',`Deploying School Succesfully Updated`, 2000);
                    FetchAllGrade();
                    $('#CreateNewGradeModal').modal('hide');
                }
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#CreateNewGradeModal').modal('hide');
            }
            });

        }

        function CreateGrade(e) {
			e.preventDefault();
			$.ajax({
            Level: 'POST', 
            url: '<?= site_url('Maintenance/CreateGrade') ?>',
			data: { Grade: $('#Grade').val(), Level: $('#Level').val() }, 
            dataLevel: 'json',
            success: function(response) {   
                if(response.missing){
                    message('error', response.missing, 2000);
                } else if (response.existing) {
                    message('error', response.existing, 2000);
                }else{
                    message('success',`New Grade Succesfully Generated`, 2000);
                    FetchAllGrade();
                    $('#CreateNewGradeModal').modal('hide');
                }
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#CreateNewGradeModal').modal('hide');
            }
            });
		}

        
		 function FetchAllGrade() { 
			var table = $('#ListofLevel').DataTable({
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
            Level: 'GET', 
            url: '<?= site_url('Maintenance/GetAllGrade') ?>', 
            dataLevel: 'json',
            success: function(response) {    
                table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr id="${info.ID}">
                                <td>${info.ID}</td>
                                <td>${info.Grade}</td>
                                <td>${info.Level}</td>
								<td><a href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Grade}');"Level="button" class="red-button" data-target="#DeleteSchoolGrade" data-toggle="modal"><span class="fas fa-trash"></span></a> 
								<a href="javascript:void(0);" onclick="UpdateCreateButton(${info.ID}, '${info.Grade}', '${info.Level}');"
									class="blue-button" data-target="#CreateNewGradeModal" data-toggle="modal"><span class="fa fa-pencil"></span></a>
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

        
		function deleteQues(id, Grade) {
			$('#DelId').val(id);
			$('#DelName').text(Grade.toUpperCase());
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