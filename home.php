<?php
	include("inc/conf.php");
	if( logged_in() ){
		header('Location: index.php');
	}
	$Login="";
	$Register="";	
	if(isset($_REQUEST['Register'])){
		
		
		
		
		
		
	}elseif(isset($_REQUEST['Login'])){
		$username = ($_POST['username']);
		$password = ($_POST['password']);
		if(!empty($username) && !empty($password) ){
			$queryLogin = $db->query("SELECT * FROM `players` where `username` = '".$username."' and `password` = '".md5($password)."'");
			if($db->num_rows($queryLogin)){
				$rowLogin = $db->fetch_row($queryLogin);
				if(isset($_POST['remember_me'])){
					set_cookie("loggedin", true, 7);
					set_cookie("username", $rowLogin['username'], 7);
					set_cookie("UID", $rowLogin['id'], 7);
				}else{
					set_cookie("loggedin", true);
					set_cookie("username", $rowLogin['username']);
					set_cookie("UID", $rowLogin['id']);
				}
				header("Location: ".$config['domain']);
				$Login.= '<div class="alert alert-success">Sign in successfully!</div> '; 
			}else{
				$Login.= '<div class="alert alert-danger">Please check the information entered!</div> ';
			}
		}else{
			$Login.= '<div class="alert alert-danger">Please make sure to fill all blanks!</div> ';
		}
	
	
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
	<link rel="shortcut icon" href="<?php echo $config['domain'];?>/img/icon/favicon.png" />
    <title><?php echo $config['title'];?></title>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $config['domain'];?>/themes/<?php echo $config['theme']; ?>/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo $config['domain'];?>/themes/<?php echo $config['theme']; ?>/css/style.php?<?php echo $cssversion ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=K2D:400,700" rel="stylesheet">
    <script>
      console.log('%c--------------------------------------', 'font-size: 16px');
      console.log("%cDon't paste anything here!", 'color: #f95353; font-size: 22px');
      console.log(
        '%cIf someone asked you to paste something here, they are most likely trying to hijack your account and take your coins.',
        'color: #f95353; font-size: 22px'
      );
      console.log('%c--------------------------------------', 'font-size: 16px');
    </script>
	<noscript>If you're seeing this message, that means <strong>JavaScript has been disabled on your browser</strong>, please <strong>enable JS</strong> to make this app work.</noscript>
  </head>
  <body>
  
  
  
  
  
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="white-bg rounded shadow p-4">
				<div class="row">
					<div class="col">
						<h3 class="fonts mb-3">Login</h3>
						<form class="form-signin" autocomplete="off" method="post">
							<div class="form-label-group margin-bottom-10">
								<input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus readonly>
							</div>
							<div class="form-label-group margin-bottom-10">
								<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
							</div>
							<div class="form-label-group">
								<input name="GAcode" type="text" id="inputGA" class="form-control" placeholder="two factor (if enabled)">
							</div>
								<hr>
							<div class="custom-control custom-checkbox mb-3">
								<input type="checkbox" class="custom-control-input" name="remember_me" id="customCheck1">
								<label class="custom-control-label" for="customCheck1">Remember password<br><span style="font-size:0px;">.</span></label>
							</div>
							<button name="Login" class="btn btn-lg btn-primary btn-block text-uppercase fonts" type="submit">Login</button><br>
							<?php
								echo $Login;
							?>
						</form>
					</div>
					<div class="col">
						<h3 class="fonts mb-3">Register</h3>
						<form class="form-signin" autocomplete="off">
							<div class="form-label-group margin-bottom-10">
								<input name="username" type="text" id="inputRUsername" class="form-control" placeholder="Username" required autofocus readonly>
							</div>
							<div class="form-label-group margin-bottom-10">
								<input name="password" type="password" id="inputRPassword" class="form-control" placeholder="Password" required>
							</div>
							<div class="form-label-group margin-bottom-10">
								<input name="email" type="email" id="inputREmail" class="form-control" placeholder="Email" required>
							</div>
								<hr>
							<div class="mb-3">
								By accessing the site I attest that I am at least <b>18</b> years old and have read the <a href="#Terms_Conditions" data-toggle="modal" data-target="#Terms_Conditions">TERMS OF SERVICE</a></label>
							</div>
							<button name="Register" class="btn btn-lg btn-primary btn-block text-uppercase fonts" type="submit">Register</button><br>
							<?php
								echo $Register;
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
  
  
  
  
  
  
  
	<!-- BetInfo -->
	<div class="modal fade" id="BetInfo" tabindex="-1" role="dialog" aria-labelledby="BetInfoTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary text-uppercase" id="BetInfoTitle"><b>Bet Info</b></h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body" id="BetContent"></div>
		</div>
	  </div>
	</div>
	<!-- UserInfo -->
	<div class="modal fade" id="UserInfo" tabindex="-1" role="dialog" aria-labelledby="UserInfoTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary text-uppercase" id="UserInfoTitle"><b>User Info</b></h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body" id="UserContent"></div>
		</div>
	  </div>
	</div>
<!-- Terms_Conditions -->
<div class="modal fade" id="Terms_Conditions" tabindex="-1" role="dialog" aria-labelledby="Terms_ConditionsTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary text-uppercase" id="Terms_ConditionsTitle">TERMS OF SERVICE</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body Terms_Conditions">
<?php
	$getTerms_Conditions = $config['terms_conditions'];
	$getTerms_Conditions = str_replace("{sitename}", $config['title'], $getTerms_Conditions);
	$getTerms_Conditions = str_replace("{sitemail}", $config['email'], $getTerms_Conditions);
	$getTerms_Conditions = str_replace("{sitedomain}", $domainname, $getTerms_Conditions);
	echo $getTerms_Conditions;
	
?>
      </div>
    </div>
  </div>
</div>
    <footer class="footer">
      <div class="container">
        <span>&copy; <?php echo Date('Y').' '.$config['title']; ?>. All rights reserved.</span>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script>
		$( document ).ready(function() {
			setTimeout(function(){ $("#inputUsername").attr('readonly', false); $("#inputUsername").focus(); },500);
			setTimeout(function(){ $("#inputRUsername").attr('readonly', false); },500);
		});
	</script>
  </body>
</html>