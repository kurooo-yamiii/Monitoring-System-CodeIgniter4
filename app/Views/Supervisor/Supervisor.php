<?php 
if (isset($_SESSION['ID']) && isset($_SESSION['Name'])) {

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Supervisor <?php echo $_SESSION['Name']; ?></title>
<link rel="icon" href="<?=base_url('assets/img/cedlogo.png')?>" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/superviui.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/supervimedia.css')?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
   <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">

</head>
<body>
    <style>
        #studentList{
            display: none;
        }
        #studentadd{
            display: none;
        }
        #teachList{
            display: none;
        }
        #professoradd{
            display: none;
        }
        #pstDeployment{
          display:none;
        }
        #teachDeployment{
          display: none;
        }
        #statisticForm{
          display: none;
        }
        #statEval{
          display: none;
        }
       
        #statboard{
            display: none;
        }
        #evalRemarks{
            display: none;
        }
        #announcement{
            display: none;
        }
        #profile{
          display: none;
        }
        #profileupdate{
          display: none;
        }
        #profilestud {
          display: none;
        }
       
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
    <span onclick="refStatForm()" class="material-icons-outlined">bar_chart</span>
		<span onclick="refreshDashboard()" class="material-icons-outlined">home</span>
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
       <h4>Supervisor <?php echo $_SESSION['Name']?></h4>
			</div>
			<ul>
				<li id="studlistbut">
					<b onclick="refreshStudList()">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-graduation-cap" aria-hidden="true"></i>PST ACCOUNT</p>
					</a>
					</b>
				</li>

				<li id="teachlistbut">
					<b onclick="refreshTeachList()">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-users" aria-hidden="true"></i>RT ACCOUNT</p>
					</a>
					</b>
				</li>

        <li id="deploybtn">
					<b onclick="refreshDeploy()">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-tags" aria-hidden="true"></i>DEPLOYMENT</p>
					</a>
					</b>
				</li>

				<li id="annbtn">
					<b onclick="refAnnouncement()">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-bullhorn" aria-hidden="true"></i>ANNOUNCEMENT</p>
					</a>
					</b>
				</li>

				<li id="accbtn">
					<b onclick="refProfile()">
					<a style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-address-card" aria-hidden="true"></i>PROFILE</p>
					</a>
					</b>
				</li>

				<li>
				<b>
					<a href="logout.php" style="text-decoration: none; color: #eee;">
						<p><i class="fa fa-sign-out" aria-hidden="true"></i>LOGOUT</p>
					</a>
					</b>
				</li>
			</ul>
		</nav>
		<section class="section-1" id="sectionsss">
          <!-- <?= ('Supervisor/PSTAccount'); ?> -->
           <!-- <?= ('Supervisor/Dashboard'); ?> -->
            <!-- <?= ('Supervisor/RTAccount'); ?> -->
             <!-- <?= ('Supervisor/Deployment'); ?> -->
                <!-- <?= ('Supervisor/Announcement'); ?> -->
					<!-- <?= ('Supervisor/Profile'); ?> -->
						<!-- <?= ('Supervisor/Statistic'); ?> -->
					
           <?= $this->render('Supervisor/Statistic'); ?>
		</section>

        <!-- <script src="superviui.js"></script> -->
	</div>

</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
?>