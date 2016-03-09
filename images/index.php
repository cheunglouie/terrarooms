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
    </head>

    <body>
<?php
	// Google analytics
	// include_once("analyticstracking.php");

	// Connect to the database 
	// require_once('connectvars.php');
	
	if ($_GET['flag']=="success") {
		$success_flag = $_GET['msg'];
	} elseif ($_GET['flag']=="fail") {
		$fail_flag = $_GET['msg'];
	} else {
		$success_flag = "";
		$fail_flag = "";
	}
	
	
	// $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	
	// Process POST request
	// if (isset ($_POST['add_room'])) {
		// if (isset ($_POST['room_num']) and !empty ($_POST['room_num'])) {
			// if (isset ($_POST['room_type']) and !empty ($_POST['room_type'])) {
				// if ($_POST['room_num'] > 10000 and $_POST['room_num'] <= 99999) {
					// $room_num = mysqli_real_escape_string($dbc, trim($_POST['room_num']));
					// $note = mysqli_real_escape_string($dbc, trim($_POST['note']));
					// $room_type = mysqli_real_escape_string($dbc, trim($_POST['room_type']));
					
					// Insert room info to database
					// $query = "INSERT INTO rooms (room_num, note, room_type, datetime)" .
								// "VALUES ('$room_num', '$note', '$room_type', now())";
					// mysqli_query($dbc, $query) or die (mysqli_error($dbc));
					// $success_flag = "Your room has been added to the list. Good luck with your battle!";
					// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
				// } else {
					// $fail_flag = "Room number is invalid";
					// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
				// }
			// } else {
				// $fail_flag = "Room type is required";
				// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
			// }
		// } else {
			// $fail_flag = "Room number is required";
			// echo '<script>window.location.href = "redirect.php?url=' .$_SERVER['REQUEST_URI']. '&msg='.$msg.'"</script>';
		// }
	// }
	
// ADD player select interval time
// ADD FILTER

	// Retrieve room info from database
	// $query = "SELECT * FROM rooms where datetime >= DATE_SUB(now(), INTERVAL 15 MINUTE) ORDER BY datetime ASC";
	// $data = mysqli_query($dbc, $query) or die (mysqli_error($dbc));
	
	// Populating $rooms array
	// $rooms = array();
	
	// while ($rows = mysqli_fetch_array($data)) {
		// $rooms[] = $rows;
	// }   
?>

	<form enctype="multipart/form-data" method="post" action="index.php" >
		<div class="container" id="main">
			<div class="row" id="bigCallout">
				<div class="col-12">                
					<!-- Add form here -->
					<div class="well">
						<div class="page-header">
							<h1>Terra Battle <small>Private Room Finder</small></h1>
						</div>
						<div class="row" id="moreInfo">
							<div class="col-sm-6">
								<form class="form-horizontal well" role="form">
									<div class="row">
										<div class="col-xs-4">
											<img src="images/artemis_I.jpg" class="img-responsive img-radio">
											<button type="button" class="btn btn-primary btn-radio">Artemis I</button>
											<input type="radio" name="room_type" id="artemis_I" class="hidden" value="Artemis I" />
										</div>
										
										<div class="col-xs-4">
											<img src="images/artemis_II.jpg" class="img-responsive img-radio">
											<button type="button" class="btn btn-primary btn-radio">Artemis II</button>
											<input type="radio" name="room_type" id="artemis_II" class="hidden" value="Artemis II" >
										</div>
										
										<div class="col-xs-4">
											<img src="images/artemis_III.jpg" class="img-responsive img-radio">
											<button type="button" class="btn btn-primary btn-radio">Artemis III</button>
											<input type="radio" name="room_type" id="artemis_III" class="hidden" value="Artemis III" >
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-4">
											<img src="images/chaos_I.jpg" class="img-responsive img-radio">
											<button type="button" class="btn btn-primary btn-radio">Chaos I</button>
											<input type="radio" name="room_type" id="chaos_I" class="hidden" value="Chaos I" >
										</div>
										
										<div class="col-xs-4">
											<img src="images/chaos_II.jpg" class="img-responsive img-radio">
											<button type="button" class="btn btn-primary btn-radio">Chaos II</button>
											<input type="radio" name="room_type" id="chaos_II" class="hidden" value="Chaos II" >
										</div>
										
										<div class="col-xs-4">
											<img src="images/chaos_III.jpg" class="img-responsive img-radio">
											<button type="button" class="btn btn-primary btn-radio">Chaos III</button>
											<input type="radio" name="room_type" id="chaos_III" class="hidden" value="Chaos III" >
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-lg-2 control-label" for="inputName">Room #</label>
										<div class="col-lg-5">
											<input class="form-control" id="inputName" name="room_num" placeholder="e.g. 12345" type="text" maxlength="5" >
										</div>
									</div>
									
									<br><br>
									
									<div class="form-group">
										<label class="col-lg-2 control-label" for="inputMessage">Note (optional)</label>
										<div class="col-lg-10">
											<textarea class="form-control" name="note" id="inputMessage" placeholder="e.g. Please have your sword members ready" rows="3"  maxlength="50"></textarea>
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
										<p><b>Step 2:</b> Fill out the form on the left with the room number and select the stage</p>
									</li>
									<li class="list-group-item">
										<p><b>Step 3:</b> Optional - add a short note (please keep this clean at all times)</p>
									</li>
									<li class="list-group-item">
										<p><b>Step 4:</b> Your room number appears at bottom of the list for others to join, enjoy!</p>
									</li>
								</ol>
								
								<hr>
								
								<!-- Comment modal -->
								<a href="#myModal" role="button" class="btn btn-warning" data-toggle="modal">
								<span class="glyphicon glyphicon-hand-up"></span> Suggestion? Click Here!</a>
								
								<div class="modal fade" id="myModal">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button class="close" data-dismiss="modal">&times;</button>
												
												<h4 class="modal-title"><b>Terra Battle Private Room Finder</b></h4>
											</div>
											<div class="modal-body">
												<h4>Leave me a comment or suggestion</h4>
												
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
															<input name="submit" class="btn btn-success pull-right" type="submit"></button>
														</div>
													</div>
												</form>
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
								<h3>Private Room List:</h3>
								<p>New rooms goes to the bottom of list. Rooms will be automatically removed after 15 minutes.</p>
								
								<div class="list-group">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end bigCallout -->
			
		</div> <!-- end container -->
    </form>
	
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <h6>Copyright &copy; 2015<br>Louie Cheung</h6>
                </div>  
<!--                
                <div class="col-sm-4">
                    <h6>About Us</h6>
                    <p>Lots of text here</p>
                </div>  
                
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
	

        
   