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

</form>
<script>
     $(document).ready(function() {
        PDOEvaluation()
      });

      function PDOEvaluation() {
        const id = $('#id').val();
        $('#EvalResult').empty();
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
                        console.log(info.ID);
                        // var appendPST = $(`
                        //     <div class="todo-item">
                        //         <button onclick="deploymentID(${info.ID})" class="removee-to-do" type="button">Deploy</button> 
                        //         <h2>${info.Name}<span class="ave">${info.Program}</span></h2>
                        //         <small style="color: #4F6128; font-weight: 700;">Section: ${info.Section}</small> 
                        //         <small>Supervisor: ${info.Supervisor}</small> 
                        //     </div>
                        // `);
                        // $('#DeployResult').append(appendPST);
                    });
                } else {
                    console.log("Walang Laman");
                    // var noStudentsDeployed = $(`
                    //     <div class="todo-item">
                    //         <button class="removee-to-do" type="button">N/A</button> 
                    //         <h2>All of the PST Student have been Deployed</h2>
                    //         <small>Note: If you want to undeploy a student, kindly delete his/her account and create a new account.</small>
                    //     </div>
                    // `);
                    // $('#DeployResult').append(noStudentsDeployed);
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

</script>