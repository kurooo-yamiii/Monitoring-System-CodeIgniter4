<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("TeacherController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">Requirements of PST <span id="divForPSTName" style="margin-left: 5px; color:  rgba(100, 50, 30); font-weight: 700;"></span></p>
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
   <input type="text" name="studentid" id="studentid" value="<?php echo $_SESSION['Student']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>
    
	<div class="space"></div>
    
	<div style="display: flex; justify-content: space-between; width: 100%;">
		<div id="portfolioDiv" style="width: 50%; padding-right: 10px;">

		</div>
		<div id="cbarDiv" style="width: 50%; padding-right: 10px;">
		
		</div>
	</div>

</form>
<script>
    
	  $(function () {
		GetRequirements();
        getPSTName();
	  });

    function getPSTName() {
        const id = $('#studentid').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/FetchStudentName'); ?>',
            data: {
                ID: id
            },
            dataType: 'json',
            success: function(response) {
               if(response && response.name){
                $('#divForPSTName').text(response.name);
               }else{
                $('#divForPSTName').text('No Current Student Assigned');
               }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function GetRequirements() {
		var id = $('#studentid').val();
		var baseUrl = '<?= base_url('assets/requirements/'); ?>';
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('TeacherController/GetAllRequirements'); ?>',
			data: { ID: id },
			success: function(response) {
				$('#portfolioDiv').empty();
				$('#cbarDiv').empty();
				var portofolioDiv = $('#portfolioDiv');
				var cbarDiv = $('#cbarDiv');

				var hasPortfolio = false;
				var hasCBAR = false;

				if (response === null || response.length === 0) {
					var noPortfolioFetch = $(`
						<p class="prof-title"> I. Portfolio</p>
						<div class="todo-itemprof">
							<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
								<div style="width: auto; flex-grow: 1;">
									<h2>Portfolio:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current Portfolio Attached</span></h2>
									<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your Portfolio</small>
								</div>
							</div>
						</div>
					`);
					
					var noCBARFetch = $(`
						<p class="prof-title"> II. Action-Based Research</p>
						<div class="todo-itemprof">
							<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
								<div style="width: auto; flex-grow: 1;">
									<h2>CBAR:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current CBAR Attached</span></h2>
									<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your CBAR</small>
								</div>
							</div>
						</div>
					`);

					portofolioDiv.append(noPortfolioFetch);
					cbarDiv.append(noCBARFetch);

				} else {
					response.forEach(function(info) {
						const formattedDate = formatDate(info.Date);
						if (info.Type === 'Portfolio') {
							hasPortfolio = true;
							const file = info.FilePath;
							if(isValidPdfFilePath(file)){
								var fileName = `${id}/${info.FilePath}`;
								var sourceView = `${baseUrl}${fileName}`;
							}else{
								var sourceView = file;
							}
							var portfolioFetch = $(`
								<p class="prof-title"> I. Portfolio</p>
								<div class="todo-itemprof">
									<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
										<div style="width: auto; flex-grow: 1;">
											<h2>Portfolio:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Title}</span></h2>
											<small style="color: rgba(100, 50, 30); font-weight: 700;">Total Grade: ${info.Grade == '0' ? 'Not Graded Yet' : info.Grade}</small>
											<small>Date: ${formattedDate}</small>
										</div>
										<div style="width: auto;">
											<button onclick="PreviewFile('${sourceView}')" class="btn btn-secondary" type="button" id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button>
										</div>
									</div>
								</div>
								<div class="space"></div>
								<div class="prof-center">
									<iframe src="${sourceView}" style="width: 90%; height: 350px;"></iframe>
								</div>
							`);
							portofolioDiv.append(portfolioFetch);
						} else if (info.Type === 'CBAR') {
							const formattedDate = formatDate(info.Date);
							hasCBAR = true;
							const fileCBAR = info.FilePath;
							if(isValidPdfFilePath(fileCBAR)){
								var fileName = `${id}/${info.FilePath}`;
								var sourceView = `${baseUrl}${fileName}`;
							}else{
								var sourceView = fileCBAR;
							}
							var cbatFetch = $(`
									<p class="prof-title"> II. Action-Based Research</p>
									<div class="todo-itemprof">
										<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
											<div style="width: auto; flex-grow: 1;">
												<h2>CBAR:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Title}</span></h2>
												<small style="color: rgba(100, 50, 30); font-weight: 700;">Total Grade: ${info.Grade == '0' ? 'Not Graded Yet' : info.Grade}</small>
												<small>Date: ${formattedDate}</small>
											</div>
											<div style="width: auto;">
												<button onclick="PreviewFile('${sourceView}')" class="btn btn-secondary" type="button" id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button>
											</div>
										</div>
									</div>
									<div class="space"></div>
									<div class="prof-center">
										<iframe src="${sourceView}" style="width: 100%; height: 350px;"></iframe>
									</div>
							`);
							cbarDiv.append(cbatFetch);
						}
					});

					if (!hasPortfolio) {
						var noPortfolioFetch = $(`
							<p class="prof-title"> I. Portfolio</p>
							<div class="todo-itemprof">
								<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
									<div style="width: auto; flex-grow: 1;">
										<h2>Portfolio:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current Portfolio Attached</span></h2>
										<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your Portfolio</small>
									</div>
								</div>
							</div>
						`);
						portofolioDiv.append(noPortfolioFetch);
					}

					if (!hasCBAR) {
						var noCBARFetch = $(`
							<p class="prof-title"> II. Action-Based Research</p>
							<div class="todo-itemprof">
								<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
									<div style="width: auto; flex-grow: 1;">
										<h2>CBAR:<span class="ave" style="background-color: rgba(100, 50, 30);">No Current CBAR Attached</span></h2>
										<small style="color: rgba(100, 50, 30); font-weight: 700;">Click the Button to Add your CBAR</small>
									</div>
								</div>
							</div>
						`);
						cbarDiv.append(noCBARFetch);
					}
				}
			},
			error: function(error) {
				console.error("Error fetching user profile:", error);
			}
		});
	}

    function isValidWebsiteUrl(url) {
		const regex = /^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,6}(\/[^\s]*)?$/i;  
		return regex.test(url);
	}

	function isValidPdfFilePath(filePath) {
		const regex = /(\.pdf)$/i;  
		return regex.test(filePath);
	}

    function formatDate(dateString) {
		const date = new Date(dateString);
		const options = { year: 'numeric', month: 'long', day: 'numeric' };
		return date.toLocaleDateString('en-US', options);
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

	function PreviewFile(url) {
        window.open(url, '_blank');
    }	

</script>