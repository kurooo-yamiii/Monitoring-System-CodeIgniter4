<form>
<div class="dashboard">
   <p class="announce-para">PST <span id="divForPSTName" style="color: rgba(100, 50, 30);"> To-Do-List</span></p>
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
   <div class="button-container">
		  		<button type="button" class="btn-shadow btn btn-primary" style="font-size: 14px;" data-target="#CreateTodo"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-plus"></span> Create New To-Do
                </button>
			</div>
   <input type="text" name="id" id="id" value="<?php echo $_SESSION['Student']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>
        <div id="todoContainer"></div>
        <p class="prof-title">Finished Tasks</p>
        <div id="updateSuccess"></div>
        <p class="prof-title">Missed Task</p>
        <div id="updateMissed"></div>
        <p class="prof-title">Pending Task</p>
        <div id="updateUnfinished"></div>

  <!-- ADD MODAL -->
  <div class="modal fade" id="CreateTodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 30%" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                CREATE NEW TODO
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-12">
                                <label>LESSON</label>
                                <input type="text" class="form-control" id="Lesson">
					    </div>
                        <div class="col-md-12">
                                <label>DATE</label>
                                <input type="date" class="form-control" id="Date">
					    </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 5%;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="ClearTodo()">Close</button>
                        <button type="button" class="btn btn-primary" id="SaveUser" onclick="AddToDoList()">Create</button>
				    </div>
               </div>
            </div>
        </div>
</form>
<script>

    $(document).ready(function() {
        GetAllTodoList();
      });

    function hasDatePassed(dateString) {
        const today = new Date().toISOString().split('T')[0];
        const dueDate = new Date(dateString).toISOString().split('T')[0];
        return dueDate < today;
    }

    function ClearTodo() {
        $('#Lesson').val('');
        $('#Date').val('');
    }

    function AddToDoList() {
        var id = $('#id').val();
        var lesson = $('#Lesson').val();
        var date = $('#Date').val();
        $.ajax({
            type: 'POST', 
            url: '<?= site_url('TeacherController/AddNewToDo') ?>',
            data: {
                ID: id,
                Lesson: lesson,
                Date: date,
            },
            dataType: 'json',
            success: function(response) {
                if (response.message === 'Success') { 
                    GetAllTodoList(); 
                    $('#CreateTodo').modal('hide'); 
                    ClearTodo();
                    message('success', 'To-Do Successfully Generated', 2000); 
                } else {
                    console.log(response.message);
                    message('error', response.message, 2000);
                }
            },
            error: function(error) {
                console.log(error);
                message('error', 'An error occurred', 2000);
            }
        });
    }

	function GetAllTodoList() {
        var id = $('#id').val();
        $.ajax({
            type: 'GET',
            url: '<?= site_url('TeacherController/FetchAllTodoList') ?>',
            data: {
                ID: id
            },
            dataType: 'json',
            success: function(response) {
                $('#updateSuccess').empty(); 
                $('#updateMissed').empty(); 
                $('#updateUnfinished').empty(); 

                let hasCompleted = false;
                let hasMissed = false;
                let hasPending = false;

                if (response.length === 0) {
                    $('#todoContainer').append(`
                        <div class="todobox">
                            <div class="rowtodo">
                                <p class="titletodo">There are no assigned tasks</p>
                            </div>
                        </div>
                    `);
                } else {
                    response.forEach(function(list) {
                        let hasPassed = hasDatePassed(list.Date);
                        let todoHTML = `<div class="todobox" style="background-color: ${list.Checked === '1' ? 'rgba(144, 238, 144, 0.3)' : hasPassed ? 'rgba(255, 99, 71, 0.3)' : 'rgba(173, 216, 230, 0.3)'};">`;

                        todoHTML += `<div class="rowtodo">
                                        <p class="titletodo">${list.Checked === '1' ? '<span style="text-decoration: line-through;">' + list.Title + '</span>' : list.Title}</p>
                                        <p class="datetodo">${list.Date}</p>
                                    </div>`;

                        if (list.Checked === '1') {
                            todoHTML += '<p class="listtodobut2" style="color: green; padding: 9px 30px;">Complete</p>';
                            hasCompleted = true; 
                        } else if (hasPassed) {
                            todoHTML += '<p class="listtodobut2" id="missing" style="color: red; padding: 9px 30px; margin-right: 1%;">Missed</p>';
                            hasMissed = true; 
                        } else {
                            todoHTML += '<p class="listtodobut2" id="missing" style="color: #2a52be; padding: 9px 30px; margin-right: 1%;">Assigned</p>';
                            hasPending = true; 
                        }

                        todoHTML += '</div>'; 
                        if (list.Checked === '1') {
                            $('#updateSuccess').append(todoHTML);
                        } else if (hasPassed) {
                            $('#updateMissed').append(todoHTML);
                        } else {
                            $('#updateUnfinished').append(todoHTML);
                        }
                    });

                    if (!hasCompleted) {
                        $('#updateSuccess').append(`
                            <div class="todobox" style="background-color: rgba(144, 238, 144, 0.3)">
                                <p class="titletodo">No completed tasks.</p>
                            </div>
                        `);
                    }
                    if (!hasMissed) {
                        $('#updateMissed').append(`
                            <div class="todobox" style="background-color: rgba(255, 99, 71, 0.3)">
                                <p class="titletodo">No missed tasks.</p>
                            </div>
                        `);
                    }
                    if (!hasPending) {
                        $('#updateUnfinished').append(`
                            <div class="todobox" style="background-color: rgba(173, 216, 230, 0.3)">
                                <p class="titletodo">No pending tasks.</p>
                            </div>
                        `);
                    }
                }
            },
            error: function(error) {
                console.log(error);
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