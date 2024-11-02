<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("TeacherController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">PST <span id="divForPSTName" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"> Daily Time Log</span></p>
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
    <input type="text" name="id" id="id" value="<?php echo $_SESSION['ID']; ?>" hidden>
    <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden></div>
    <input type="text" name="studentID" id="studentID" value="<?php echo $_SESSION['Student']; ?>" hidden></div>
   <div class="eval-studd">
			<table class="table table-striped" id="ApprovedDTR">
					<thead>
                    <tr>
                        <th colspan="6" class="text-center">Approved Daily Time Log</th>
                    </tr>
					<tr>
						<th scope="col">Date</th>
						<th scope="col">Time In</th>
						<th scope="col">Time Out</th>
						<th scope="col">Total Hours</th>
						<th scope="col">Signatory</th>
                        <th scope="col">Action</th>
					</tr>
				  </thead>
                 <tbody>
                </tbody>
            </table>
	</div>
    <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container" style="justify-content: space-between;">
          <p class="btn-shadow  btn btn-primary">Overall Time <span id="fetchOverallTime"> </span></p>
		  		<p type="button" class="btn-shadow btn btn-primary" data-target="#DissparovedModal"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-calendar"></span> Approve DTR
                </p>
			</div>

<!-- Disapproved Modal -->
    <div class="modal fade" id="DissparovedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"  style="max-width: 65%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                                <div class="logos">
                                    <div class="logo-right">
                                        <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                    </div>
                                    <div>Pending <span style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;">Daily Time Record</span></div>
                                </div>	
                            </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                            <table class="table table-striped" id="DissaprovedDTR">
                                    <thead>
                                    <tr>
                                        <th colspan="6" class="text-center">Disapproved Daily Time Log</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time In</th>
                                        <th scope="col">Time Out</th>
                                        <th scope="col">Total Hours</th>
                                        <th scope="col">Signatory</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ECashID">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

        </div>
    </div>
    </div>
</form>
<script>

     $(document).ready(function() {
        displayDashboard(); 
        GetTotalHoursMinutes();
      });

   function formatDate(dateString) {
		const date = new Date(dateString);
		const options = { year: 'numeric', month: 'long', day: 'numeric' };
		return date.toLocaleDateString('en-US', options);
	}

    function displayDashboard() {
        var id = $('#studentID').val();
		if ($.fn.DataTable.isDataTable('#ApprovedDTR')) {
			$('#ApprovedDTR').DataTable().destroy();
		}
		var table = $('#ApprovedDTR').DataTable({
			ordering: false,
            responsive: true,
            retrieve: true,
			pageLength: 4,
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
			url: '<?= site_url('TeacherController/GetApprovedDTR') ?>',
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
                                          <td style="width: 50px; height: 50px;">
                                            ${info.Status === 'Approved' || info.Status === 'Not Approved' ? 
                                                `<button style="opacity: 1 !important; font-size: 10px !important;" 
                                                        class="${info.Status === 'Not Approved' ? 'btn btn-secondary' : 'btn btn-success'}" disabled>
                                                    ${info.Status}
                                                </button>` 
                                                : 
                                                `<img src="<?= base_url('assets/signatory/') ?>${info.Status}" alt="Signatory"  style="width: 100%; height: 100%; object-fit: contain;">`
                                            }
										</td>
                                        <td><a href="javascript:void(0);" onclick="deleteDTR(${info.ID}, '${info.TotalHrs}', '${info.Status}');" type="button" class="red-button" data-target="#DeletePST" data-toggle="modal"><span class="fas fa-trash"></span></a> 
                                        <a href="javascript:void(0);" onclick="disapproveDTR(${info.ID}, '${info.TotalHrs}');"
                                            class="btn btn-warning"><span class="fa fa-thumbs-down"></span></a>
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

    function GetTotalHoursMinutes() {
        var id = $('#studentID').val();
        $.ajax({
			type: 'GET',
			url: '<?= site_url('TeacherController/PSTTotalHours') ?>',
			data: {
				ID: id
			},
			dataType: 'json',
			success: function(response) {
                $('#fetchOverallTime').text(response.totalTime);
			},
			error: function(error) {
                console.log(error)
			}
		});
    }

    function ModalDissaproved() {
        var id = $('#studentID').val();
		if ($.fn.DataTable.isDataTable('#DissaprovedDTR')) {
			$('#DissaprovedDTR').DataTable().destroy();
		}
		var table = $('#DissaprovedDTR').DataTable({
			ordering: false,
            responsive: true,
            retrieve: true,
			pageLength: 4,
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
			url: '<?= site_url('TeacherController/GetDisapprovedDTR') ?>',
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
											<button style="opacity: 1; !important; font-size: 10px !important;" class="${info.Status === 'Not Approved' ? 'btn btn-secondary' : 'btn btn-success'}" disabled>
												${info.Status}
											</button>
										</td>
                                        <td><a href="javascript:void(0);" onclick="deleteDTR(${info.ID}, '${info.TotalHrs}', '${info.Status}');" type="button" class="red-button" data-target="#DeletePST" data-toggle="modal"><span class="fas fa-trash"></span></a> 
                                        <a href="javascript:void(0);" onclick="approveDTR(${info.ID}, '${info.TotalHrs}');"
                                            class="btn btn-success"><span class="fa fa-thumbs-up"></span></a>
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

    function approveDTR(id, total) {
        var studID = $('#studentID').val();
        $.ajax({
			type: 'GET',
			url: '<?= site_url('TeacherController/TimeApproved') ?>',
			data: {
				ID: id,
                total: total,
                studID: studID
			},
			dataType: 'json',
			success: function(response) {
                message('success',`Daily Time Log Approved`, 2000);
                displayDashboard();
                ModalDissaproved();
                GetTotalHoursMinutes();
			},
			error: function(error) {
				console.log(error);
			}
        })
    }

    function disapproveDTR(id, total) {
        var studID = $('#studentID').val();
        $.ajax({
			type: 'GET',
			url: '<?= site_url('TeacherController/TimeDisapproved') ?>',
			data: {
				ID: id,
                total: total,
                studID: studID
			},
			dataType: 'json',
			success: function(response) {
                message('success',`Daily Time Log Disapproved`, 2000);
                displayDashboard();
                ModalDissaproved();
                GetTotalHoursMinutes();
			},
			error: function(error) {
				console.log(error);
			}
        })
    }

    function deleteDTR(id, total, status){
        var studID = $('#studentID').val();
        $.ajax({
			type: 'GET',
			url: '<?= site_url('TeacherController/DeleteDTR') ?>',
			data: {
				ID: id,
                total: total,
                studID: studID,
                status: status,
			},
			dataType: 'json',
			success: function(response) {
                console.log(response);
                message('success',`Daily Time Log Deleted`, 2000);
                displayDashboard();
                ModalDissaproved();
                GetTotalHoursMinutes();
			},
			error: function(error) {
				console.log(error);
			}
        })
    }

    $('#DissparovedModal').on('shown.bs.modal', function () {
        ModalDissaproved();
    });

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