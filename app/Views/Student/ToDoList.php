<form>
<div class="dashboard">
   <p class="announce-para">To Do List of PST <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></p>
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
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>
        <div id="todoContainer"></div>
        <p class="prof-title">Finished Tasks</p>
        <div id="updateSuccess"></div>
        <p class="prof-title">Missed Task</p>
        <div id="updateMissed"></div>
        <p class="prof-title">Pending Task</p>
        <div id="updateUnfinished"></div>
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

	function GetAllTodoList() {
        var id = $('#id').val();
        var name = $('#name').val();
        $('#divForPSTName').text(name);
        $.ajax({
            type: 'GET',
            url: '<?= site_url('StudentController/FetchAllTodoList') ?>',
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
                            todoHTML += `<button class="listtodobut" type="button" onclick="MarkAsDone(${list.ID})">Mark as Done</button>`;
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

    function MarkAsDone(todoid) {
        var id = $('#id').val();
        $.ajax({
            type: 'POST',
            url: '<?= site_url('StudentController/UpdateToDoStatus') ?>',
            data: {
                ID: id,
                ItemID: todoid
            },
            dataType: 'json',
            success: function(response) {
                GetAllTodoList();
                message('success',`Pending Task Finished`, 2000);
            },
            error: function(xhr, status, error) {
                message('error',`Unknown Error Occured, Please try Again`, 2000);
            }
        });
    }

    function hasDatePassed(dateString) {
        const today = new Date().toISOString().split('T')[0];
        const dueDate = new Date(dateString).toISOString().split('T')[0];
        return dueDate < today;
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