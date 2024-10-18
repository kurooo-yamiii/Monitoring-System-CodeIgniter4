<!DOCTYPE html>
<html>
<head>
	<title>RTU PST Login</title>
     <meta charset="UTF-8">
	<meta http-eequiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">  
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/sweetalert2/dist/sweetalert2.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/stylemedia.css')?>">
	<link rel="icon"  href="<?=base_url('assets/img/cedlogo.png')?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<style>
    body {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: sans-serif; 
	background-image: url(<?=base_url('assets/img/bg.png')?>);
	background-size: cover;
	background-repeat: no-repeat;
	/* display: flex;
	justify-content: center;
	align-items: center; */
	height: 100vh;
	/* flex-direction: column; */
}
body::before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: -1;
}
.btn-red {
    background-color: rgb(166, 44, 44) !important; 
    color: white !important;
}
</style>
<body>
     <form>
		
     	<h2><img src="<?=base_url('assets/img/logo.png')?>"></h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

		<div class="form-group">
     	<label>Username</label>
     	<input id="username" type="text" name="uname" placeholder="Username" required><br>
		</div>

		<div class="form-group">
     	<label>Password</label>
                <div class="password-container">
     	<input type="password" id="password" name="password" placeholder="Password" required>
                        <span class="material-icons-outlined" onclick="togglePasswordVisibility()" id="toggleoff">visibility_off</span>
                <span class="material-icons-outlined" onclick="togglePasswordVisibility()" id="toggle">visibility</span>
                        
                <br>
                </div>
		</div>	

     	<button type="button" onclick="loginUser(event)" style="background-color: #000080; margin-top: 3%;">Login</button>
     </form>
    
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>	
     <script src="<?=base_url('assets/sweetalert2/dist/sweetalert2.all.js')?>"></script>
     
<script>
    var host_url = '<?php echo host_url(); ?>';
            
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggle = document.getElementById("toggle");
        var toggleoff = document.getElementById("toggleoff");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggle.style.display = "none";
            toggleoff.style.display = "block";
        } else {
            passwordInput.type = "password";
            toggle.style.display = "block";
            toggleoff.style.display = "none";
        }

       
    }

     function loginUser(e) {
            e.preventDefault();
            $.ajax({
            type: 'POST', 
            url: '<?= site_url('Home/getemployees') ?>', 
            dataType: 'JSON',
            data: { user: $('#username').val(), pas: $('#password').val()},
            success: function(response) {
              if(response.status === '200'){
                message('success',`Welcome ${response.data.Name}!`, 1500)
                setTimeout(function() {
                    window.location.href = '<?= site_url('SupervisorController') ?>';
                }, 1700);
              }else{
               message('error','Wrong Credentials', 1500)
               $('#username').val('');
               $('#password').val('');
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

        
        function successMessage(icon,message,duration){
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
</body>
</html>