<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("TeacherController/logout"));
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PST <?php echo $_SESSION['Name']; ?></title>
<link rel="icon" href="<?=base_url('assets/img/cedlogo.png')?>" type="image/x-icon">

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

      <!-- Chosen CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      
      <!-- DataTables CSS -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
      
      <!-- Font Awesome CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/cooperatingui.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/cooperatinmedia.css')?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

</head>
<body>

    <style>
        .section-1 {
          padding: 20px;
          width: 100%;
          background-image: url(<?=base_url('assets/img/bg.png')?>);
          background-size: cover;
            background-repeat: no-repeat;
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;
        }
    </style>

	<header class="header">
  <h2 class="u-name">RIZAL<b> TECHNOLOGICAL UNIVERSITY</b>
		</h2>
    <div class="dashboardstats">
		<span onclick="loadView('PreviewDashboard')" class="material-icons-outlined">home</span>
      </div>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
			<div id="profileHandler"> 
      <?php if (!empty($images)) : ?>
       <?php $profileImage = $images['Profile']; ?>
       <img src="<?= base_url('assets/uploads/' .  $profileImage) ?>">	
       <?php else : ?>
                     <img  src="<?=base_url('assets/img/default.jpeg')?>">
       <?php endif; ?>
	   </div>
       <h4>Professor: <?php echo $_SESSION['Name']?></h4>
			</div>
			<ul>
				<li id="studlistbut">
					<b onclick="loadView('PreviewApprovalDTR')">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-calendar" aria-hidden="true"></i>DTR</p>
					</a>
					</b>
				</li>

				<li id="teachlistbut">
					<b onclick="loadView('PreviewEvaluation')">
					<a style="text-decoration: none; color: #eee;">
						<luation><i class="fa fa-file-text" aria-hidden="true"></i>EVALUATION</p>
					</a>
					</b>
				</li>
				<li id="annbtn">
					<b onclick="loadView('PreviewToDoList')">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-list" aria-hidden="true"></i>TO-DO-LIST</p>
					</a>
					</b>
				</li>

				<li id="accbtn">
					<b onclick="loadView('PreviewProfile')">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-address-card" aria-hidden="true"></i>PROFILE</p>
					</a>
					</b>
				</li>

				<li>
				<b>
					<a href="<?= site_url("TeacherController/logout") ?>" style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-sign-out" aria-hidden="true"></i>LOGOUT</p>
					</a>
					</b>
				</li>
			</ul>
		</nav>
		<section class="section-1" id="sectionsss">
       <!-- View the Fetch Here -->
		</section>
	</div>

</body>
</html>

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

	<!-- Bootstrap Bundle (includes Popper) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

	<!-- DataTables JS -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

	<!-- DataTables Buttons JS -->
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
	<script src="<?=base_url('assets/sweetalert2/dist/sweetalert2.all.js')?>"></script>

<script>

      const baseUrl = '<?= site_url("TeacherController/") ?>';

      function getViewUrl(viewName) {
          return baseUrl + viewName;
      }

      $(document).ready(function() {
        loadView('PreviewDashboard'); 
      });

    function loadView(viewName) {
          $('#sectionsss').empty(); 
          const url = getViewUrl(viewName); 
          $.ajax({
              url: url,
              method: 'GET',
              success: function(response) {
                  $('#sectionsss').append(response); 
              },
              error: function(error) {
                  console.log("Error loading the view:", error);
              }
          });
      }

</script>

