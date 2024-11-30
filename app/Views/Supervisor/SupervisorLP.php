<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("SupervisorController/logout"));
    exit();
}
?>
<form id="statistic">
   <div class="dashboard">
   <p class="announce-para">Pre-Service Teacher <span> Lesson Plan</span></p>
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
</form>   