<form>
   <div class="dashboard">
   <p class="announce-para">Daily TIne Record of PST <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></p>
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
  
	<div class="eval-studd">
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
			<tbody>
    </tbody>
</table>
	</div>
   <div class="space"></div>
		<div class="divider"></div>
		  <div class="button-container" style="justify-content: space-between;">
          <p class="announce-para">Overall Time <span id="fetchOverallTime" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></p>
		  		<button type="button" class="btn-shadow btn btn-warning" style="font-size: 14px;" data-target="#AddDTRModal"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-calendar"></span> Create Daily Log
                </button>
			</div>

<!-- Add DTR Modal -->
<div class="modal fade" id="AddDTRModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  style="max-width: 25%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Create<span style="margin-left: 5px; color: navy; font-weight: 700;">Daily Time Record</span></div>
							</div>	
						</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                
				<div class="col-md-12">
               <label for="date">Date</label>
               <input type="date" class="form-control" id="date" name="date" required>
				</div>
            <div class="space"></div>

            <div class="col-md-12">
               <label for="timein">Time In</label>
               <input type="time" class="form-control"  id="timein"  name="timein" required>
				</div>
            <div class="space"></div>

            <div class="col-md-12">
               <label for="timeout">Time Out</label>
               <input type="time" class="form-control"  id="timeout"  name="timeout" required>
				</div>
            <div class="space"></div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="ECashID">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="AddDTR" onclick="AddDailyTimeRecord(event)">Publish Daily Log</button>
            </div>

    </div>
 </div>
 </div>

</form>

<script>

    $(document).ready(function() {
        var id = $('#id').val();
        var name = $('#name').val();
        displayDashboard(id, name); 
        GetTotalHoursMinutes();
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
			url: '<?= site_url('StudentController/GetAllPSTDTR') ?>',
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

    function GetTotalHoursMinutes() {
        var id = $('#id').val();
        $.ajax({
			type: 'GET',
			url: '<?= site_url('StudentController/TotalHourNMinutes') ?>',
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

    function AddDailyTimeRecord() {
        var id = $('#id').val();
        var date = $('#date').val();
        var timein = $('#timein').val();
        var timeout = $('#timeout').val();
        var name = $('#name').val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url('StudentController/PublishDTR') ?>',
                data: {
                    ID: id,
                Date: date,
                TimeIn: timein,
                TimeOut: timeout
                },
                dataType: 'json',
                success: function(response) {
                    message('success',`Daily Time Log is now Recorded`, 2000);
                    $('#AddDTRModal').modal('hide');
                    $('#date').val('');
                    $('#timein').val('');
                    $('#timeout').val('');
                    displayDashboard(id, name); 
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

    $('#AddDTRModal').on('hidden.bs.modal', function () {
        $('#date').val('');
        $('#timein').val('');
        $('#timeout').val('');
	});
</script>