<!DOCTYPE html>
    <head>
        <!-- Website Title & Description for Search Engine purposes -->
        <title>Terra Battle Private Room Finder</title>
		<meta charset=utf-8 />
        <meta name="description" content="">
		
		
        <!-- Mobile viewport optimized -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <!-- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">
        
        <!-- Custom CSS -->
        <link href="includes/css/styles.css" rel="stylesheet">
		
		<!-- Icon for mobile -->
		<link rel="apple-touch-icon" href="/terrarooms/apple-touch-icon.png">
		<link rel="apple-touch-startup-image" href="/terrarooms/peprope.png">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        
        <!-- Include Modernizr in the head, before any other Javascript -->
        <script src="includes/js/modernizr-2.6.2.min.js"></script>
        
		<!-- First try for the online version of jQuery-->
		<script src="http://code.jquery.com/jquery.js"></script>
		
		<!-- If no online access, fallback to our hardcoded version of jQuery -->
		<script>window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>
		
		<!-- Bootstrap JS -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="includes/js/script.js"></script>
		
		<!-- Prompt user to add to home screen -->
		<link rel="stylesheet" type="text/css" href="includes/css/addtohomescreen.css">
		<script src="includes/js/addtohomescreen.js"></script>
		<script>
			addToHomescreen();
		</script>
		
    </head>

    <body>
	

	<!-- SideBar Floating Share Buttons for small medium large device -->
	<style>
		#social-widget {
			position:fixed;
			top:25%;
			left:10px;
			border: 1px solid black;
			width:70px;

			border-radius:5px;
			-moz-border-radius:5px;
			-webkit-border-radius:5px;

			background-color:#eff3fa;
			z-index:998;
		}

		#social-widget .sbutton {
			margin: 5px;
		}
	</style>

	<div id='social-widget' title="Share This With Your Friends" class="visible-sm visible-md visible-lg">
		<!-- Facebook -->
		<div class="sbutton">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="http://www.terrarooms.com/" data-send="true" data-layout="box_count" data-width="80" data-show-faces="true" data-action="like" >
			</div>
		</div>

		<!-- Twitter -->
		<div class="sbutton">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.terrarooms.com/" data-count="vertical">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>

		<!-- Google Plus -->
		<div class="sbutton">
			<div class="g-plusone" data-size="tall" data-href="http://www.terrarooms.com/"></div>

			<script type="text/javascript">
			  window.___gcfg = {lang: 'en-GB'};

			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>
	</div>
	<!-- SideBar Floating Share Buttons for small medium large device Code End– -->
	
	
<?php
	// Start the session
	require_once('startsession.php');
	
	// Google analytics
	include_once("analyticstracking.php");
	
	include_once("functions.php");
	
	// Connect to the database 
	require_once('connectvars.php');
	
		if (isset($_GET['flag'])) {
			if ($_GET['flag']=="success") {
				$success_flag = $_GET['msg'];
			} elseif ($_GET['flag']=="fail") {
				$fail_flag = $_GET['msg'];
			} else {
				$success_flag = "";
				$fail_flag = "";
			}
		}
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	
	if (!isset ($_SESSION['refreshFreq'])) {
		$_SESSION['refreshFreq'] = 60000;
	}
	
	// Refresh Frequency
	if (isset ($_GET['freq'])) {
		$_SESSION['refreshFreq'] = mysqli_real_escape_string($dbc, trim($_GET['freq']));
	}
	
	switch ($_SESSION['refreshFreq']) {
    case 5000:
        $refreshFreqTime = "5 sec";
        break;
    case 10000:
        $refreshFreqTime = "10 sec";
        break;
    case 20000:
        $refreshFreqTime = "20 sec";
        break;
	case 30000:
        $refreshFreqTime = "30 sec";
        break;
	case 60000:
        $refreshFreqTime = "1 min";
        break;
	}

	// Process POST request
	if (isset ($_POST['add_room'])) {
		if (isset ($_POST['room_num']) and !empty ($_POST['room_num'])) {
			if (isset ($_POST['room_type']) and !empty ($_POST['room_type'])) {
				if ($_POST['room_num'] > 10000 and $_POST['room_num'] <= 99999) {
					$room_num = mysqli_real_escape_string($dbc, trim($_POST['room_num']));
					$note = mysqli_real_escape_string($dbc, trim($_POST['note']));
					$room_type = mysqli_real_escape_string($dbc, trim($_POST['room_type']));
					
					// Insert room info to database
					$query = "INSERT INTO rooms (room_num, note, room_type, datetime)" .
								"VALUES ('$room_num', '$note', '$room_type', now())";
					mysqli_query($dbc, $query) or die (mysqli_error($dbc));
					$success_flag = "Your room has been added to the list. Good luck with your battle!";
					// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
				} else {
					$fail_flag = "Room number is invalid";
					// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
				}
			} else {
				$fail_flag = "Room type is required";
				// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
			}
		} else {
			$fail_flag = "Room number is required";
			// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
		}
	}


?>
	<?php echo '<form enctype="multipart/form-data" method="post" action="' .$_SERVER["PHP_SELF"]. '" >'; ?>
			<div class="container" id="main" >
				<div class="row" id="bigCallout" >
					<div class="col-12" >              
						<!-- Add form here -->
						<div class="well">
							<div class="page-header">
								<img src="images/Peprope-logo.jpg" id="peprope-logo" class="pull-right" width="150" height="150" />
								<h1>Terra Battle</h1>
								<h1><small>Private Room Finder</small></h1>
								<br>
								<!-- Scroll to bottom button -->
								<a href="#" role="button" class="btn btn-default" onclick="return false;" onmousedown="window.scrollTo(0,document.body.scrollHeight);">Go To Private Room List</a>
							</div>
							
							<!-- Social media share button for XS device -->
							<div id='xs-social-widget' title="Share This With Your Friends" class="visible-xs">

								<!-- Facebook -->
								<div id="fb_button" class="sbutton">
									<div id="fb-root"></div>
									<script>(function(d, s, id) {
									  var js, fjs = d.getElementsByTagName(s)[0];
									  if (d.getElementById(id)) return;
									  js = d.createElement(s); js.id = id;
									  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
									  fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));</script>
									<div class="fb-like" data-href="http://www.terrarooms.com/" data-send="true" data-width="80" data-show-faces="false" data-action="like" >
									</div>
								</div>

								<!-- Twitter -->
								<div class="sbutton">
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.terrarooms.com/" >Tweet</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
								</div>

								<!-- Google Plus -->
								<div class="sbutton">
									<div class="g-plusone" data-href="http://www.terrarooms.com/"></div>

									<script type="text/javascript">
									  window.___gcfg = {lang: 'en-GB'};

									  (function() {
										var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
										po.src = 'https://apis.google.com/js/plusone.js';
										var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
									  })();
									</script>
								</div>
							</div>
													
							<!-- Add to home screen modal -->
							<!-- Visible only on small devices (iphone ipad etc) -->
							<a href="#athsModal" role="button" class="btn btn-default visible-xs visible-sm" data-toggle="modal">
							<span class="glyphicon glyphicon-phone"></span> Add To Home Screen</a>
							<br>
							
							<div class="modal fade" id="athsModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button class="close" data-dismiss="modal">&times;</button>
											
											<h4 class="modal-title"><b>Terra Battle Private Room Finder</b></h4>
										</div>
										<div class="modal-body">
											<p>Please add this web app to your mobile device's home screen<br>This will enhance your experience</p>
											
											<hr>
											
											<p><strong class="text-muted">Step 1: </strong><small>Press this button at the buttom of Safari  </small><img src="images/aths_icon.jpg" alt="Terra Battle iphone safari button"/></p>
											<p><strong class="text-muted">Step 2: </strong><small>Press this button to add app icon to your home screen  </small><img src="images/aths.jpg" style="width:60px; height:80px;" alt="Terra Battle iphone app icon"/></p>
											<p><strong class="text-muted">Step 3: </strong><small>Move the icon wherever you want, just like any other apps, ENJOY!  </small><img src="images/apple-touch-icon.png" style="width:80px; height:80px;" alt="Terra Battle iphone touch icon"/></p>
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
									
							<!-- Room type image radio button -->		
							<div class="row" id="moreInfo">
								<div class="col-sm-6">
									<form class="form-horizontal well" role="form">
										<div class="row">
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Artemis I</button>
												<input type="radio" name="room_type" id="artemis_I" class="hidden" value="Artemis I" />
											</div>
											
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Artemis II</button>
												<input type="radio" name="room_type" id="artemis_II" class="hidden" value="Artemis II" >
											</div>
											
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Artemis III</button>
												<input type="radio" name="room_type" id="artemis_III" class="hidden" value="Artemis III" >
											</div>
										</div>
										
										<div class="row">
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Chaos I</button>
												<input type="radio" name="room_type" id="chaos_I" class="hidden" value="Chaos I" >
											</div>
											
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Chaos II</button>
												<input type="radio" name="room_type" id="chaos_II" class="hidden" value="Chaos II" >
											</div>
											
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Chaos III</button>
												<input type="radio" name="room_type" id="chaos_III" class="hidden" value="Chaos III" >
											</div>
										</div>
										
										<div class="row">
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Valkyrie I</button>
												<input type="radio" name="room_type" id="valkyrie_I" class="hidden" value="Valkyrie I" >
											</div>
											
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Valkyrie II</button>
												<input type="radio" name="room_type" id="valkyrie_II" class="hidden" value="Valkyrie II" >
											</div>
											
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Valkyrie III</button>
												<input type="radio" name="room_type" id="valkyrie_III" class="hidden" value="Valkyrie III" >
											</div>
										</div>
										
										<div class="row">
											<div class="col-xs-4">
												<button type="button" class="btn btn-primary btn-radio btn-stage-custom">Lamia</button>
												<input type="radio" name="room_type" id="lamia" class="hidden" value="Lamia" >
											</div>
										</div>
										
										<div class="row form-group">
											<label class="col-lg-2 control-label" for="inputName">Room #</label>
											<div class="col-lg-5">
												<input class="form-control" id="inputName" name="room_num" placeholder="e.g. 12345" type="text" maxlength="5" >
											</div>
										</div>
										
										<div class="row form-group">
											<label class="col-lg-2 control-label" for="inputMessage">Note (optional)</label>
											<div class="col-lg-10">
												<textarea class="form-control" name="note" id="inputMessage" placeholder="e.g. Please have your sword members ready" rows="3"  maxlength="50"></textarea>
											</div>
										</div>
										
										<div class="row form-group">
											<div class="col-lg-2 pull-right">
												<button class="btn btn-large btn-success pull-right" type="submit" name="add_room" id="alertMe" >Add Room</button>
											</div>
										</div>
									</form>
								</div> <!-- end col-sm-6 -->
						
								<!-- Step by step list -->
								<div class="col-sm-6">
									<ol class="list-group">
										<li class="list-group-item">
											<p><b>Step 1:</b> Open a private room in Terra Battle Co-op and obtain a room number</p>
										</li>
										<li class="list-group-item">
											<p><b>Step 2:</b> Fill out the form on the left with the room type and room number</p>
										</li>
										<li class="list-group-item">
											<p><b>Step 3:</b> Optional - Add a short note (please keep this clean at all times)</p>
										</li>
										<li class="list-group-item">
											<p><b>Step 4:</b> Your room number appears at bottom of the list for others to join, enjoy!</p>
										</li>
										<li class="list-group-item">
											<p><b>Step 5:</b> Optional - Set how often room list refreshes using "Refresh Freq" button</p>
										</li>
									</ol>
									
									<!-- Suggestion modal -->
									<a href="#suggestionModal" role="button" class="btn btn-warning btn-custom" data-toggle="modal" >
									<span class="glyphicon glyphicon-hand-up"></span> Suggestion? Click Here!</a>
									
									<div class="modal fade" id="suggestionModal">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button class="close" data-dismiss="modal">&times;</button>
													
													<h4 class="modal-title"><b>Leave me a comment or suggestion</b></h4>
												</div>
												<div class="modal-body">
													<p>Do you have an idea to make this app better?<br>Let me know by filling this form.</p>
													
													<hr>
													
													<p><small class="text-muted">Include your name and email if you want a reply.</small></p>
													
													<?php echo '<form class="form-horizontal" enctype="multipart/form-data" method="post" action="suggestion.php" >'; ?>
														<div class="form-group">
															<label class="col-lg-2 control-label" for="inputName">Name</label>
															<div class="col-lg-10">
																<input name="name" class="form-control" id="inputName" placeholder="Name" type="text" maxlength="20">
															</div>
														</div>
														
														<div class="form-group">
															<label class="col-lg-2 control-label" for="inputEmail">Email</label>
															<div class="col-lg-10">
																<input name="email" class="form-control" id="inputEmail" placeholder="Email" type="email" maxlength="50">
															</div>
														</div>
														
														<div class="form-group">
															<label class="col-lg-2 control-label" for="inputMessage">Message*</label>
															<div class="col-lg-10">
																<textarea name="message" class="form-control" id="inputMessage" placeholder="Message" rows="3" maxlength="500"></textarea>
																<input name="submit" class="btn btn-success pull-right" type="submit">
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									
									
									<!-- Gift Code modal -->
									<a href="#giftCodeModal" role="button" class="btn btn-danger btn-custom" data-toggle="modal" >
									<span class="glyphicon glyphicon-gift"></span> Subscribe for Gift Codes!</a>
									
									<div class="modal fade" id="giftCodeModal">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button class="close" data-dismiss="modal">&times;</button>
													
													<h4 class="modal-title"><b>Terra Battle Gift Code Subscription</b></h4>
												</div>
												


												<!-- Suggest new gift code -->
												<div class="modal-body">
													<h4>RW64HrNpinyKdwRr</h4>
													<p>1 x Energy</p>
													<hr>
													<h4>Leave your name and email to subscribe to the gift code email list</h4>
													<p>New gift codes will be automatically emailed to you</p>
													<br>
													
													<?php echo '<form class="form-horizontal" enctype="multipart/form-data" method="post" action="giftcode.php" >'; ?>
														<div class="form-group">
															<label class="col-lg-2 control-label" for="inputName">Name*</label>
															<div class="col-lg-10">
																<input name="name" class="form-control" id="inputName" placeholder="Name" type="text" maxlength="20">
															</div>
														</div>
														
														<div class="form-group">
															<label class="col-lg-2 control-label" for="inputEmail">Email*</label>
															<div class="col-lg-10">
																<input name="email" class="form-control" id="inputEmail" placeholder="Email" type="email" maxlength="50">
																<br>
																<input name="submit" class="btn btn-success pull-right" type="submit">
															</div>
														</div>
														
													</form>
													<p>Don't forget to check your junk box and add do-not-reply@terrarooms.com to your safe email list</p>
												</div>
											</div>
										</div>
									</div>
									
									
									
								</div> <!-- end col-sm-6 -->
							</div>

							<!-- GREEN SUCCESS alert after button is pressed -->
							<div class="alert alert-success alert-block fade in" id="successAlert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								
								<h4>Success!</h4>
								<div id="success"></div>
								<!--<p>Your room has been added to the list. Good luck with your battle!</p>-->
							</div> <!-- end SUCCESS alert -->
							
							<!-- RED FAIL alert after button is pressed -->
							<div class="alert alert-danger alert-block fade in" id="failAlert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								
								<h4>Fail!</h4>
								<div id="fail"></div>
								<!-- <p>There is a problem adding your room to the list. Please try again!</p> -->
							</div> <!-- end FAIL alert -->
							
							<hr>
							<div class="row" id="moreInfo">					
								<!-- Room list goes here -->
								<div class="col-sm-12">
									
									<!-- Refresh frequency dropdown list -->
									<div class="btn-group dropup">
									  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true" data-original-title="Specify how often room list refreshes" rel="tooltip" data-placement="bottom">
										Refresh Freq (<?php echo $refreshFreqTime ?>)
										<span class="glyphicon glyphicon-time"></span>
									  </button>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
											<li role="presentation" value="5" ><a role="menuitem" tabindex="-1" href="index.php?freq=5000">5 Seconds</a></li>
											<li role="presentation" value="10"><a role="menuitem" tabindex="-1" href="index.php?freq=10000">10 Seconds</a></li>
											<li role="presentation" value="20"><a role="menuitem" tabindex="-1" href="index.php?freq=20000">20 Seconds</a></li>
											<li role="presentation" value="30"><a role="menuitem" tabindex="-1" href="index.php?freq=30000">30 Seconds</a></li>
											<li class="divider"></li>
											<li role="presentation" value="60"><a role="menuitem" tabindex="-1" href="index.php?freq=60000">1 Minute (Default)</a></li>
										  </ul>
									</div>
									
									<h3>Private Room List:</h3>
									<p>New rooms goes to the bottom of list. Rooms will be automatically removed after 15 minutes.</p>
									
									<div class="list-group" id="roomList" >
									</div>
									
									<!-- AJAX to update room list on an interval set by user -->
<?php
									echo '
									<script>
										getRoomAjax();
										
										window.setInterval(function() {
											getRoomAjax();
										}, ' .$_SESSION["refreshFreq"]. ');
										
										function getRoomAjax() {
											var xmlhttp;    
											if (window.XMLHttpRequest) {
												// new browsers
												xmlhttp=new XMLHttpRequest();
											} else {
												// old browsers
											  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
											}
											xmlhttp.onreadystatechange=function() {
												if (xmlhttp.readyState==4 && xmlhttp.status==200) {
													document.getElementById("roomList").innerHTML=xmlhttp.responseText;
												}
											}
											xmlhttp.open("GET","displayList.php",true);
											xmlhttp.send();
										}
									</script>
									';
?>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- end bigCallout -->
			</div> <!-- end container -->
    </form>
	
	
    <footer>
        <div class="container" >
            <div class="row">
                <div class="col-sm-4">
                    <h6>Copyright &copy; 2015<br>Louie Cheung</h6>
                </div>  
				
                <div class="col-sm-4 center-block">
                    <h6>This web app is coded using Bootstrap 3 Framework, <br>with mobile friendly in mind.</h6>
                    <p></p>
                </div>  
<!--                
                
                <div class="col-sm-2">
                    <h6>Navigation</h6>
                    <ul class="unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Links</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div> 
                
                <div class="col-sm-2">
                    <h6>Follow Us</h6>
                    <ul class="unstyled">
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Google Plus</a></li>
                    </ul>
                </div>
-->                
                <div class="col-sm-2 pull-right">
                    <h6>Coded with <span class="glyphicon glyphicon-heart"></span> by Louie Cheung</h6>
                </div> 
            </div>
        </div>
    </footer>
   
	</body>
</html>
	
<?php 	
	if (!empty ($success_flag)) {
		echo "<script>$('<p>" .$success_flag. "</p>').appendTo('#success')</script>";
		echo "<script>$('#successAlert').slideDown();</script>";
	} elseif (!empty ($fail_flag)) {
		echo "<script>$('<p>" .$fail_flag. "</p>').appendTo('#fail')</script>";
		echo "<script>$('#failAlert').slideDown();</script>";
	}
?>
        
   