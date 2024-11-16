<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("StudentController/logout"));
    exit();
}
?>
<form>
   <div class="dashboard">
   <p class="announce-para">Lesson Plan of PST <span id="divForPSTName" style="margin-left: 5px; color: navy; font-weight: 700;"></span></p>
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
    
   <div class="button-container">
		  		<button type="button" class="btn-shadow btn btn-primary" style="font-size: 14px;" data-target="#CreateNewLessonPlan"
                    id="CreatePST" data-toggle="modal">
                    <span class="fas fa-plus"></span> Lesson Plan
                </button>
			</div>
	<div class="space"></div>
    <div id="LessonPlanDiv"></div>
</form>
