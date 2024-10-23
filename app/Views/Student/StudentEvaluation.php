<form>
<div class="dashboard">
   <p class="announce-para">Evaluation of PST <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></p>
   <div class="logos">
      <div class="logo">
         <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50" />
      </div>
      <div class="logo">
         <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50" />
      </div>
   </div>
   </div>

   <input type="text" name="id" id="id" value="<?php echo $_SESSION['ID']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>

   <div class="divider"></div>
	<div class="space"></div>

	<div id="EvalResult" class="todo-container"></div>

<!-- Preview Evaluation Modal -->
<div class="modal fade" id="PrevEval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  style="max-width: 60%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Lesson: <span id="lessonHolder" style="margin-left: 5px; color: navy; font-weight: 700;"></span></div>
							</div>	
						</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="TableforEvalPreview">
                                <thead>
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Qs1</th>
                                    <th scope="col">Qs2</th>
                                    <th scope="col">Qs3</th>
                                    <th scope="col">Qs4</th>
                                    <th scope="col">Qs5</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                        <tbody>
                </tbody>
            </table>
            <div class="space"></div>
            <div class="modal-footer">
                <input type="hidden" id="ECashID">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>

    </div>
 </div>
 </div>

</form>

<script>
     $(document).ready(function() {
        PDOEvaluation()
      });

      function PDOEvaluation() {
        const id = $('#id').val();
        const name = $('#name').val();
        $('#EvalResult').empty();
         $('#divForPSTName').text(name);
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('StudentController/PSTEvaluation'); ?>',
            data: {
                ID: id
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    response.forEach(function(info) {
                        const formattedDate = formatDate(info.Date);
                        var appendEvaluation = $(` 
                            <div class="todo-item">
                                <button onclick="previewEvaluation(${info.ID}, '${info.Lesson}')" class="removee-to-do" type="button" data-target="#PrevEval"
                    id="PreviewEvaluation" data-toggle="modal">Preview</button> 
                                <h2>Lesson:<span class="ave">${info.Lesson}</span></h2>
                                <small style="color: #4F6128; font-weight: 700;">Total Average: ${info.Average}</small> 
                                <small>Date: ${formattedDate}</small> 
                            </div>
                        `);
                        $('#EvalResult').append(appendEvaluation);
                    });
                } else {
                    var noEvaluationExisting = $(`
                        <div class="todo-itemprof">
                            <button class="removee-to-do" type="button">N/A</button> 
                            <h2>No current evaluation for you</h2>
                            <small>Note: Always remind your cooperating teacher to conduct evaluation for every lesson</small>
                        </div>
                    `);
                    $('#EvalResult').append(noEvaluationExisting);
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function previewEvaluation(id, lesson) {
        $('#lessonHolder').text(lesson);
        var table = $('#TableforEvalPreview').DataTable({
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
						text: `PST Evaluation`,
                        title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        text: 'PDF',
                         init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-pdf buttons-html5')
                        }
                    },
                    {
                        extend: "copyHtml5",
                        className: 'btn btn-primary',
						text: `PST Evaluation`,
                        title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
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
						title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-excel buttons-html5')
                        }
                    },
                    {
                        extend: "csvHtml5",
                        className: 'btn btn-warning',
                        text: 'CSV',
						title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-csv buttons-html5')
                        }
					}
				]
			});
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('StudentController/FetchEvaluationTable'); ?>',
                data: {
                    ID: id
                },
                dataType: 'json',
                success: function(response) {
                    table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr >
                                    <td>${info.Variable}</td>
                                    <td>${info.Q1 ? info.Q1 : ''}</td>
                                    <td>${info.Q2 ? info.Q2 : ''}</td>
                                    <td>${info.Q3 ? info.Q3 : ''}</td>
                                    <td>${info.Q4 ? info.Q4 : ''}</td>
                                    <td>${info.Q5 ? info.Q5 : ''}</td>
                                    <td>${info.Total}</td>
                                </tr>
                                `);  
                        table.row.add(rowData);
                        });
                    table.draw();
                }              
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

    function formatDate(dateString) {
		const date = new Date(dateString);
		const options = { year: 'numeric', month: 'long', day: 'numeric' };
		return date.toLocaleDateString('en-US', options);
	}

</script>