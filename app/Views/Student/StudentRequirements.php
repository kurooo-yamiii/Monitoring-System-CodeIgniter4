<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("StudentController/logout"));
    exit();
}
?>
<form>
<div class="dashboard">
		<p class="announce-para">List of  <span> Requirements</span></p>
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
	
	<div style="display: flex; justify-content: space-between; width: 100%;">
		<div id="portfolioDiv" style="width: 50%; padding-right: 10px;">

		</div>
		<div id="cbarDiv" style="width: 50%; padding-right: 10px;">
		
		</div>
	</div>

	   <!-- ADD REQUIREMENTS MODAL -->
       <div class="modal fade" id="CreateNewRequirements" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <div class="logos">
                                <div class="logo-right">
                                    <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
                                </div>
                                ATTACH REQUIREMENTS
                            </div>	
                        </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="text" id="SupID" name="SupID" value="<?php echo $_SESSION['Name']; ?>" hidden />
						<input type="text" id="type" name="type" hidden/>
                        <div class="post-group">
                            <label for="title" id="plab1">Title:</label>
                            <input name="title" id="title" type="text" placeholder="Attachment Title" required></input>
                        </div>
                        <div class="space"></div>
						
						<div class="prof-center">
							<iframe id="lessonplanPDF" style="display:none; width: 100%; height: 350px;"></iframe>
						</div>
						<div class="space"></div>
						<div style="display: flex; flex-direction: column; align-items: left;">
							<label style="margin-right: 10px;">Choose Attachment Type:</label>
							<div style="display: flex; flex-direction: row;">
							<div style="display: flex; align-items: center; margin-right: 20px; margin-left: 20px">
								<input type="radio" id="fileOption" name="attachmentType" value="file" checked style="vertical-align: middle;" />
								<label for="fileOption" style="margin-left: 5px; margin-top: 6px;">File</label>
							</div>
							
							<div style="display: flex; align-items: center;">
								<input type="radio" id="linkOption" name="attachmentType" value="link" style="vertical-align: middle;" />
								<label for="linkOption" style="margin-left: 5px; margin-top: 6px;">Link</label>
							</div>
						</div>
						</div>
						<div class="space"></div>
						<div id="fileInputGroup" class="post-group">
							<div style="display: flex; flex-direction: row">
							<label for="lessonplan">File:</label>
							<input type="file" name="lessonplan" id="chooseLesson" />
							</div>
						</div>
						
						<div id="linkInputGroup" class="post-group" style="display:none;">
							<label for="chooseLink">Website URL:</label>
							<input type="url" id="chooseLink" placeholder="Enter a website URL" />
						</div>

                    <div class="modal-footer" style="margin-top: 1%;">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button id="portfolioFile" style="display: none;" class="btn btn-primary" onclick="PortfolioFile()" type="button">Attach Portfolio File</button>
							<button id="portfolioLink" style="display: none;" class="btn btn-primary" onclick="PortfolioLink()" type="button">Attach Portfolio Link</button>
							<button id="CBARFile" style="display: none;" class="btn btn-primary" onclick="CBARFile()" type="button">Attach CBAR File</button>
							<button id="CBARLink" style="display: none;" class="btn btn-primary" onclick="CBARLink()" type="button">Attach CBAR Link</button>
                    </div>
               </div>
            </div>
        </div>
    </div>

</form>
<script>

	  $(function () {
		GetRequirements();
	  });

	  function PortfolioLink() {
		const id = $('#id').val();
		const title = $('#title').val();
		const link = $('#chooseLink').val();

		if(!isValidWebsiteUrl(link)){
			message('error', 'Invalid Link, Please Atttach a Valid Website', 2000); 
		}

		$.ajax({
            type: 'POST', 
            url: '<?= site_url('StudentController/InsertPortfolioLink') ?>',
			data: { ID: id, Title: title, Link: link }, 
            dataType: 'json',
            success: function(response) {    
				$('#title').val('');
				$('#chooseLink').val('');  
                $('#chooseLesson').val('');
                $('#lessonplanPDF').hide();
                $('#CreateNewRequirements').modal('hide'); 
                GetRequirements();
                message('success', 'E-Portfolio Attached Successfully', 2000); 
            },
			error: function(xhr, status, error) {
                try {
                    var errorResponse = JSON.parse(xhr.responseText);
                    if (errorResponse.message) {
                        message('error', errorResponse.message, 2000);
                    } else {
                        message('error', 'An unexpected error occurred. Please try again.', 2000);
                    }
                } catch (e) {
                    message('error', 'An unexpected error occurred. Please try again.', 2000);
                }
            }
            });
	  }

	  function PortfolioFile() {
        var formData = new FormData();
        formData.append('ID', document.getElementById('id').value); 
        formData.append('Title', document.getElementById('title').value);

        var lessonplan = document.getElementById('chooseLesson');
        if (lessonplan.files.length > 0) {
            formData.append('Portfolio', lessonplan.files[0]);
        }

        $.ajax({
            url: '<?php echo site_url("StudentController/InsertPortfolioFile"); ?>',
            type: 'POST',
            data: formData,
            contentType: false, 
            processData: false, 
            success: function(response) {
                $('#title').val(''); 
                $('#chooseLesson').val('');
                $('#lessonplanPDF').hide();
                $('#CreateNewRequirements').modal('hide'); 
                GetRequirements();
                message('success', 'Portfolio Attached Successfully', 2000); 
            },
            error: function(xhr, status, error) {
                try {
                    var errorResponse = JSON.parse(xhr.responseText);
                    if (errorResponse.message) {
                        message('error', errorResponse.message, 2000);
                    } else {
                        message('error', 'An unexpected error occurred. Please try again.', 2000);
                    }
                } catch (e) {
                    message('error', 'An unexpected error occurred. Please try again.', 2000);
                }
            }
        });
    }

		document.getElementById('chooseLink').addEventListener('input', function(event) {
			const url = event.target.value.trim();
			const iframe = document.getElementById('lessonplanPDF');
			
			if (url) {
				const isValidUrl = /^https?:\/\/[^\s]+$/.test(url);
				
				if (isValidUrl) {
					try {
						iframe.src = url;  
						iframe.style.display = 'block';  
					} catch (error) {
						message('error', 'Error loading the website. Please try again.', 2000);
						console.error('Website Load Error:', error);
					}
				} else {
					message('error', 'Please enter a valid URL.', 2000);
					iframe.style.display = 'none';  
				}
			} else {
				iframe.style.display = 'none';  
			}
		});

	  document.getElementById('chooseLesson').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileType = file.type;
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const result = e.target.result;
                    const lessonplanPDF = document.getElementById('lessonplanPDF');
                    
                    lessonplanPDF.style.display = 'none';
                    if (fileType === 'application/pdf') {
                        try {
                            lessonplanPDF.src = result;
                            lessonplanPDF.style.display = 'block';

                            let iframe = document.createElement('iframe');
                            iframe.src = result;
                            iframe.style.width = '100%';
                            iframe.style.height = '500px';
                            lessonplanPDF.innerHTML = ''; 
                            lessonplanPDF.appendChild(iframe);
                            
                        } catch (error) {
                            message('error', 'Error loading PDF. Please try again.', 2000);
                            console.error('PDF Load Error:', error);
                        }
                    } else {
                        message('error', 'Unsupported File Type, PDF and Image Only', 2000);
                    }
                };
                
                reader.readAsDataURL(file);
            }
        });

		document.getElementById('fileOption').addEventListener('change', function() {
			if (this.checked) {
				document.getElementById('fileInputGroup').style.display = 'block';
				document.getElementById('linkInputGroup').style.display = 'none';
				if($('#type').val() == 'Portfolio'){
					document.getElementById('portfolioFile').style.display = 'block';
					document.getElementById('portfolioLink').style.display = 'none';
				}else{
					document.getElementById('CBARFile').style.display = 'block';
					document.getElementById('CBARLink').style.display = 'none';
				}
			}
		});

		document.getElementById('linkOption').addEventListener('change', function() {
			if (this.checked) {
				document.getElementById('fileInputGroup').style.display = 'none';
				document.getElementById('linkInputGroup').style.display = 'block';
				if($('#type').val() == 'CBAR'){
					document.getElementById('CBARFile').style.display = 'none';
					document.getElementById('CBARLink').style.display = 'block';
				}else{
					document.getElementById('portfolioFile').style.display = 'none';
					document.getElementById('portfolioLink').style.display = 'block';
				}
			}
		});

	  function TogglePortfolio() {
		document.getElementById('portfolioFile').style.display = 'block';
		document.getElementById('CBARFile').style.display = 'none';
		document.getElementById('CBARLink').style.display = 'none';
		$('#type').val('Portfolio');
	  }

	  function ToggleCBAR() {
		document.getElementById('CBARFile').style.display = 'block';
		document.getElementById('portfolioFile').style.display = 'none';
		document.getElementById('portfolioLink').style.display = 'none';
		$('#type').val('CBAR');
	  }

	  function GetRequirements() {
		var id = $('#id').val();
		var baseUrl = '<?= base_url('assets/requirements/'); ?>';
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('StudentController/GetAllRequirements'); ?>',
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
								<div style="width: auto;">
									<button href="javascript:void(0);" onclick="TogglePortfolio()" type="button" class="btn btn-primary" data-target="#CreateNewRequirements" data-toggle="modal"><span class="fas fa-plus"></span> Portfolio</button>
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
								<div style="width: auto;">
									<button href="javascript:void(0);" onclick="ToggleCBAR()" type="button" class="btn btn-primary" data-target="#CreateNewRequirements" data-toggle="modal"><span class="fas fa-plus"></span> CBAR</button>
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
											<button href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Title}');" type="button" class="btn btn-danger" data-target="#DelLessonPlan" data-toggle="modal"><span class="fas fa-trash"></span></button>
											<button type="button" onclick="updateConstruct(${info.ID}, '${info.Title}')" class="btn btn-primary" data-target="#UpdateLessonPlan" data-toggle="modal">
												<span class="fas fa-redo"></span>
											</button>
											<button onclick="previewLessonPlan('${sourceView}')" class="btn btn-warning" type="button" id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button>
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
							var cbatFetch = $(`
								<div style="width: 50%; padding-left: 10px;">
									<p class="prof-title"> II. Action-Based Research</p>
									<div class="todo-itemprof">
										<div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
											<div style="width: auto; flex-grow: 1;">
												<h2>CBAR:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Title}</span></h2>
												<small style="color: rgba(100, 50, 30); font-weight: 700;">Total Grade: ${info.Grade == '0' ? 'Not Graded Yet' : info.Grade}</small>
												<small>Date: ${formattedDate}</small>
											</div>
											<div style="width: auto;">
												<button href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Lesson}');" type="button" class="btn btn-danger" data-target="#DelLessonPlan" data-toggle="modal"><span class="fas fa-trash"></span></button>
												<button type="button" onclick="updateConstruct(${info.ID}, '${info.Lesson}', '${updatePrev}')" class="btn btn-primary" data-target="#UpdateLessonPlan" data-toggle="modal">
													<span class="fas fa-redo"></span>
												</button>
												<button onclick="previewLessonPlan('${baseUrl}${fileName}')" class="btn btn-warning" type="button" id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button>
											</div>
										</div>
									</div>
									<div class="prof-center">
										<iframe id="previewCBAR" style="display:none; width: 100%; height: 350px;"></iframe>
									</div>
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
									<div style="width: auto;">
										<button href="javascript:void(0);" onclick="TogglePortfolio()" type="button" class="btn btn-primary" data-target="#CreateNewRequirements" data-toggle="modal"><span class="fas fa-plus"></span> Portfolio</button>
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
									<div style="width: auto;">
										<button href="javascript:void(0);" onclick="ToggleCBAR()" type="button" class="btn btn-primary" data-target="#CreateNewRequirements" data-toggle="modal"><span class="fas fa-plus"></span> CBAR</button>
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

	function ClearInsertModal() {
			document.getElementById('title').value = '';
			document.getElementById('chooseLink').value = '';
			document.getElementById('chooseLesson').value = '';
			
			document.getElementById('lessonplanPDF').style.display = 'none';
			
			document.getElementById('fileOption').checked = true;
			document.getElementById('linkOption').checked = false;
			
			document.getElementById('fileInputGroup').style.display = 'block';
			document.getElementById('linkInputGroup').style.display = 'none';
		}

	$('#CreateNewRequirements').on('hidden.bs.modal', function () {
		ClearInsertModal(); 
	});

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


</script>