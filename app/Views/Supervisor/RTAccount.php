<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form id="rt">
	<div class="dashboard">

<p class="announce-para">Teacher <span> (Resource Teacher Account)</span> </p>
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
			      <th scope="col">SCHOOL</th>
				  <th scope="col">DIVISION</th>
				  <th scope="col">GRADE</th>
				  <th scope="col">COORDINATOR</th>
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
		  		<button type="button" class="btn-shadow btn btn-success" style="font-size: 14px;" data-target="#CreateModal"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-plus"></span> RT Account
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
							CREATE COOPERATING TEACHER ACCOUNT
						</div>	
					</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
			<div class="row">
					  
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
                      <label><span style="color: red;">*</span>COORDINATOR</label>
                      <input type="text" class="form-control" id="Coordinator">
                </div>
			</div>

			<div class="row" style="margin-top: 2%;">
				  <div class="col-md-12">
                      <label><span style="color: red;">*</span>SCHOOL</label>
                       <select class="chosen-select" id="School">
                        		<option value="" selected>Select School</option>
                                <option value="Andres Bonifacio Integrated School">Andres Bonifacio Integrated School (ABIS)</option>
                                <option value="City of Mandaluyong Science High School">City of Mandaluyong Science High School</option>
                                <option value="Eulogio Rodriguez Integrated School">Eulogio Rodriguez Integrated School (ERIS)</option>
                                <option value="Eusebio High School">Eusebio High School</option>
                                <option value="Highway Hills Itegrated School">Highway Hills Itegrated School (HHIS)</option>
                                <option value="Hulo Integrated School">Hulo Integrated School (HIS)</option>
                                <option value="Ilaya Barangka Integrated School">Ilaya Barangka Integrated School (IBIS)</option>
                                <option value="Isaac Lopez Integrated School">Isaac Lopez Integrated School (ILIS)</option>
                                <option value="Jose Fabella Memorial School">Jose Fabella Memorial School (JFMS)</option>
                                <option value="Mandaluyong High School">Mandaluyong High School (MHS)</option>
                                <option value="Manggahan High School">Manggahan High School</option>
                                <option value="Mataas na Paaralang Neptali A. Gonzales">Mataas na Paaralang Neptali A. Gonzales</option>
                                <option value="Nagpayong High School">Nagpayong High School</option>
                                <option value="Pinagbuhatan High School">Pinagbuhatan High School</option>
                                <option value="Rizal Experimental Station and Pilot School">Rizal Experimental Station and Pilot School (REPSCI)</option>
                                <option value="Rizal High School">Rizal High School</option>
                                <option value="Rizal Technological University">Rizal Technological University (RTU)</option>
                                <option value="Sagad High School">Sagad High School</option>
                                <option value="San Joaquin-Kalawaan High School">San Joaquin-Kalawaan High School</option>
                                <option value="Santolan High School">Santolan High School</option>
                                <option value="Sta. Lucia High School">Sta. Lucia High School</option>
                      </select>
                </div>
				</div>
                
			    <div class="row" style="margin-top: 2%;">
                <div class="col-md-6">
                      <label><span style="color: red;">*</span>DIVISION</label>
                       <select class="chosen-select" id="Division">
                        		<option value="" selected>Select Division</option>
								<option value="CSS-TLE">CSS (TLE)</option>
                                <option value="CCS-TLE">CCS (TLE)</option>
                                <option value="Drafting-TLE">Drafting (TLE)</option>
                                <option value="Electrical-TLE">Electrical (TLE)</option>
                                <option value="Electronics-TLE">Electronics (TLE)</option>
                                <option value="Cookery-TLE">Cookery (TLE)</option>
                                <option value="Cosmetics-TLE">Cosmetics (TLE)</option>
                                <option value="ICT-STRAND">ICT (STRAND)</option>
                                <option value="Programming-STRAND">Programming (STRAND)</option>
                                <option value="ABM-STRAND">ABM (STRAND)</option>
                                <option value="HUMMS-STRAND">HUMMS (STRAND)</option>
                                <option value="STEM-STRAND">STEM (STRAND)</option>
                                <option value="GAS-STRAND">GAS (STRAND)</option>
                                <option value="Automotive-STRAND">Automotive (STRAND)</option>
                      </select>
                </div>
                <div class="col-md-6">
                      <label><span style="color: red;">*</span>GRADE</label>
                       <select class="chosen-select" id="Grade">
                        		<option value="" selected>Select Grade</option>
                                <option value="Grade 6">Grade 6 JHS</option>
                                <option value="Grade 7">Grade 7 JHS</option>
                                <option value="Grade 8">Grade 8 JHS</option>
                                <option value="Grade 9">Grade 9 JHS</option>
                                <option value="Grade 10">Grade 10 JHS</option>
                                <option value="Grade 11">Grade 11 SHS</option>
                                <option value="Grade 12">Grade 12 SHS</option>
                      </select>
                </div>
                </div>

            </div>
            <div class="modal-footer" style="margin-top: 5%;">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SaveUser" onclick="addNewProf(event)">Save</button>
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
                <button type="button" class="btn btn-danger" id="SaveUser" onclick="profDelete(event)">Delete RT</button>
            </div>

    </div>
 </div>
 </div>

	</form>

	<script>
		   $(document).ready(function() {
			fetchRecentDep();
			$(".chosen-select").chosen({
				no_results_text: "No results matched",
				width: "100%" 
				});
       		})

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
                                columns: [0,1,2,3,4,5]
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
                                columns: [0,1,2,3,4,5]
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
                                columns: [0,1,2,3,4,5]
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
                                columns: [0,1,2,3,4,5]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-csv buttons-html5')
                        }
					}
				]
			});

            $.ajax({
            type: 'GET', 
            url: '<?= site_url('SupervisorController/AllProfessorAcc') ?>', 
            dataType: 'json',
            success: function(response) {    
                table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr id="trid${info.ID}">
                                <td>${info.Name}</td>
                                <td>${info.School}</td>
                                <td>${info.Division}</td>
								<td>${info.Grade}</td>
								<td>${info.Coordinator}</td>
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

		function addNewProf(e) {
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('SupervisorController/CreateProf') ?>',
			data: { 
                    Email: $('#Email').val(), 
                    Name: $('#Name').val(), 
                    Coordinator: $('#Coordinator').val(), 
                    School: $('#School').val(),           
                    Division: $('#Division').val(),       
                    Grade: $('#Grade').val()              
                }, 
            dataType: 'json',
            success: function(response) {    
                if(response.invalid){
                    message('error', response.invalid, 2000);
                }else if(response.missing){
                    message('error', response.missing, 2000);
                }else{
                    message('success',`RT Succesfully Generated`, 2000);
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
            $('#Coordinator').val(''); 
            $('#School').val('');          
            $('#Division').val('');       
            $('.chosen-select').trigger('chosen:updated');
        }

        $('#CreateModal').on('hidden.bs.modal', function () {
            ClearAllFields();
        });

		function deleteQues(id, name) {
			$('#DelId').val(id);
			$('#DelName').text(name.toUpperCase());
		}

		function profDelete(e){
			e.preventDefault();
			$.ajax({
            type: 'POST', 
            url: '<?= site_url('SupervisorController/DeleteProf') ?>',
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
            url: '<?= site_url('SupervisorController/ResetRT') ?>',
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