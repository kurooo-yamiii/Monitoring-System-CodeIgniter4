<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">List of Deploying School in <span> MANDALUYONG</span></p>
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

   <table class="table table-striped" id="ListofSchool">
	    <thead>
		    <tr>
			    <th scope="col">ID</th>
			    <th scope="col">SCHOOL</th>
				<th scope="col">ABBREVIATION</th>
				<th scope="col">ACTION</th>
		    </tr>
		</thead>
		<tbody>
		</tbody>	 
	</table>

    <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container">
		  		<button type="button" onclick="GetExisitingAbbreviaiton()" class="btn-shadow btn btn-success" style="font-size: 14px;" data-target="#CreateDeployingSchoolManda"
                    id="CreateDeployingSchool" data-toggle="modal">
                    <span class="fas fa-plus"></span> MANDALUYONG DEPLOYING SCHOOL
                </button>
			</div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="CreateDeployingSchoolManda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                CREATE DEPLOYING SCHOOL IN PASIG
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
                        <label><span style="color: red;">*</span>SCHOOL/UNIVERSITY NAME</label>
                        <input type="text" class="form-control" oninput="generateAbbreviation()" id="SchoolName">
                    </div>
                    <div class="col-md-4">
                            <label><span style="color: red;">ABBREVIATION</span></label>
                        <input type="text" class="form-control" id="Abbreviation" readonly>
                    </div>
                </div>
                </div>
                <div class="modal-footer" style="margin-top: 5%;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="AddSchool" onclick="CreatePasigSchool(event)">Create Deploying School</button>
                    <button type="button" class="btn btn-primary" id="UpdateSchool" onclick="UpdatePasigSchool()">Update Deploying School</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteDeployingSchool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p>Are you sure you want to delete deploying school <span id="DelName" style="color: red;"></span> in Manda Branch?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ECashID">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="SaveUser" onclick="DeletePasigSchool(event)">Delete Deploying School</button>
                </div>

        </div>
    </div>
    </div>
</form>
<script>

    $(document).ready(function() {
        FetchAllSchool();
    })

    var existingAbbreviations = [];

        function generateAbbreviation() {
            let input = document.getElementById("SchoolName").value.trim();
            let words = input.split(' ').filter(word => word.length > 0);
            let abbreviation = '';

            const generate = () => {
                if (words.length >= 3) {
                    let middleWord = words[Math.floor(words.length / 2)];
                    let randomIndex = Math.floor(Math.random() * middleWord.length);
                    return words[0].charAt(0).toUpperCase() + 
                        middleWord.charAt(randomIndex).toUpperCase() +
                        words[words.length - 1].charAt(0).toUpperCase();
                } else if (words.length === 2) {
                    return words[0].charAt(0).toUpperCase() +
                        words[1].charAt(1).toUpperCase() +
                        words[1].charAt(words[1].length - 1).toUpperCase();
                } else if (words.length === 1) {
                    return words[0].substring(0, 3).toUpperCase();
                }
                return '';
            };

            let attemptCount = 0;
            do {
                abbreviation = generate();
                attemptCount++;
                if (attemptCount > 50) { 
                    alert('Unable to generate a unique abbreviation. Please modify the school name.');
                    abbreviation = '';
                    break;
                }
            } while (existingAbbreviations.includes(abbreviation));

            document.getElementById("Abbreviation").value = abbreviation;
        }


        function GetExisitingAbbreviaiton(){
            const AddButton = document.getElementById("AddSchool");
            const UpdateButton = document.getElementById("UpdateSchool");
            AddButton.style.display = 'block';
            UpdateButton.style.display = 'none';
			$.ajax({
                type: 'GET', 
                url: '<?= site_url('Maintenance/FetchMandaDeployedSchool') ?>',
                dataType: 'json',
                success: function(response) { 
                    existingAbbreviations = [];   
                    existingAbbreviations = response.map(item => item.Abbreviation.toUpperCase());
                },
                error: function(error) {
                    message('error',`Something Went Wrong, Try Again`, 2000);
                }
            });
		}

        function DeletePasigSchool(e){
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('Maintenance/DeleteMandaDeployingSchool') ?>',
			data: { ID: $('#DelId').val() }, 
            dataType: 'json',
            success: function(response) {    
				message('success',`Pasig Deploying School Succesfully Deleted`, 2000);
				FetchAllSchool();
				$('#DeleteDeployingSchool').modal('hide');
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#DeleteDeployingSchool').modal('hide');
            }
            });
		}

        $('#CreateDeployingSchoolManda').on('hidden.bs.modal', function () {
            $('#SchoolName').val('');
            $('#Abbreviation').val('');
        });

        function UpdateCreateButton(id, school, abbre) {
            const AddButton = document.getElementById("AddSchool");
            const UpdateButton = document.getElementById("UpdateSchool");
            AddButton.style.display = 'none';
            UpdateButton.style.display = 'block';
            $('#UpdateID').val(id);
            $('#SchoolName').val(school);
            $('#Abbreviation').val(abbre);
        }

        function UpdatePasigSchool() {
            $.ajax({
            type: 'POST', 
            url: '<?= site_url('Maintenance/UpdateMandaSchool') ?>',
			data: { ID: $('#UpdateID').val(), School: $('#SchoolName').val(), Abbreviation: $('#Abbreviation').val() }, 
            dataType: 'json',
            success: function(response) {   
                if(response.missing){
                    message('error', response.missing, 2000);
                }else{
                    message('success',`Deploying School Succesfully Updated`, 2000);
                    FetchAllSchool();
                    $('#CreateDeployingSchoolManda').modal('hide');
                }
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#CreateDeployingSchoolManda').modal('hide');
            }
            });

        }

        function CreatePasigSchool(e) {
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('Maintenance/CreateMandaSchool') ?>',
			data: { School: $('#SchoolName').val(), Abbreviation: $('#Abbreviation').val() }, 
            dataType: 'json',
            success: function(response) {   
                if(response.missing){
                    message('error', response.missing, 2000);
                }else{
                    message('success',`Deploying School Succesfully Generated`, 2000);
                    FetchAllSchool();
                    $('#CreateDeployingSchoolManda').modal('hide');
                }
            },
            error: function(error) {
				message('error',`Something Went Wrong, Try Again`, 2000);
				$('#CreateDeployingSchoolManda').modal('hide');
            }
            });
		}

        
		 function FetchAllSchool() { 
			var table = $('#ListofSchool').DataTable({
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
            url: '<?= site_url('Maintenance/GetAllSchoolManda') ?>', 
            dataType: 'json',
            success: function(response) {    
                table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr id="${info.ID}">
                                <td>${info.ID}</td>
                                <td>${info.School}</td>
                                <td>${info.Abbreviation}</td>
								<td><a href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.School}');"type="button" class="red-button" data-target="#DeleteDeployingSchool" data-toggle="modal"><span class="fas fa-trash"></span></a> 
								<a href="javascript:void(0);" onclick="UpdateCreateButton(${info.ID}, '${info.School}', '${info.Abbreviation}');"
									class="blue-button" data-target="#CreateDeployingSchoolManda" data-toggle="modal"><span class="fa fa-pencil"></span></a>
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

        
		function deleteQues(id, school) {
			$('#DelId').val(id);
			$('#DelName').text(school.toUpperCase());
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