<?php
include_once("evadmin/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
	$login_id = $dbConn->real_escape_string(trim($_POST['login_id']));
    $pswd = $dbConn->real_escape_string(trim($_POST['pswd']));
    $cpswd = $dbConn->real_escape_string(trim($_POST['cpswd']));
    $player_name = $dbConn->real_escape_string(trim($_POST['player_name']));
    $gender = $dbConn->real_escape_string(trim($_POST['gender']));
    $dob = $dbConn->real_escape_string(trim($_POST['dob']));
    $state = $dbConn->real_escape_string(trim($_POST['state']));
    $academy = $dbConn->real_escape_string(trim($_POST['academy']));
    $bai_id = $dbConn->real_escape_string(trim($_POST['bai_id']));
    $mobile = $dbConn->real_escape_string(trim($_POST['mobile']));
    $email = $dbConn->real_escape_string(trim($_POST['email']));
    $aadhar = $dbConn->real_escape_string(trim($_POST['aadhar']));
    $other = $dbConn->real_escape_string(trim($_POST['other']));

    // Initialize an array to collect errors
    $errors = [];

    // Validations
	if (empty($login_id)) {
        $errors[] = "Login ID / Profile Name is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $login_id)) {
        $errors[] =  "Login ID must be 3-20 characters long and can only contain letters, numbers, and underscores";
    }
    
    if (empty($errors)) {
        $result = $dbConn->query("select * from player_registrations where login_id = '".$login_id."' ");
        if ($result->num_rows >= 1 ) {
            $errors[] = "Login ID / Profile Name is already registered. Please choose another";
        }
	}
	if (empty($pswd)) {
        $errors[] = "Password is required.";
    } else if(strlen($pswd) < 6){
        $errors[] = "Password must be minimum 6 characters";
	}
    if (empty($cpswd)) {
        $errors[] = "Confirm Password is required";
    }
	if (!empty($pswd) && !empty($cpswd) && $pswd != $cpswd) {
        $errors[] = "Password and Confirm Password are not matching";
    }
    if (empty($player_name)) {
        $errors[] = "Player Name is required.";
    }  

    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }
    if (empty($dob)) {
        $errors[] = "Date of Birth is required.";
    } else {
		if (strtotime($dob) > time()) {
            $errors[] = "Date of Birth cannot be a future";
        }
    }
    if (empty($state)) {
        $errors[] = "State is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $errors[] = "Mobile Number must be exactly 10 digits";
    }

    if ( !empty($aadhar) && !preg_match("/^[0-9]{12}$/", $aadhar)) {
        $errors[] = "Aadhar Number must be exactly 12 digits";
    }

	if (empty($academy) && empty($bai_id) && empty($aadhar) && empty($other)) {
		$errors[] = "Any one of ID (Academy / BAI Id / Aadhar / Other ID) is required";
	}
	
    // If no errors, insert data into the database
    if (empty($errors)) {

        $sql = "INSERT INTO player_registrations (login_id, pswd, player_name, `state`, gender, dob, email, mobile, academy, bai_id, aadhar, other) 
                VALUES ('$login_id', '".urlencode(base64_encode($pswd))."', '$player_name', '$state', '$gender', '$dob', '$email', '$mobile', '$academy', '$bai_id', '$aadhar', '$other')";

        if ($dbConn->query($sql) === TRUE) {
			header("location:reg-success.php");
			exit;
        } else {
            $errors[] = "Error: " . $sql . "<br>" . $dbConn->error;
        }
    } 

    // Close the connection
    $dbConn->close();
} else {
	$login_id = $player_name = $state = $gender = $dob = $email = $mobile = $academy = $bai_id = $aadhar = $other ="";
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
	<?php include("head.php"); ?>
	<body class="home-two">
        <?php include("header.php"); ?>      
		<!-- Contact Section Start -->
		<div class="contact-page-section sec-spacer">
        	<div class="container">
			<h3 class="title-bg">Player Registration</h3>
        		<div class="contact-comment-section">
        			
                    <div id="form-message"><?php
						if (!empty($errors)) {
							echo "<p style='color:red;'>";
							foreach ($errors as $error) 
								echo $error."; ";
							echo "</p>";
						}
					?></div>
					<form id="contact-form" method="post" action="">
						<fieldset>
							<div class="row">                                      								
								<div class="col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Login ID / Profile Name *</label>
										<input name="login_id" id="login_id" required class="form-control" type="text" value="<?php echo $login_id;?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Password *</label>
										<input name="pswd" id="pswd" class="form-control" type="password" autocomplete="off" required value="" minlength="6" >
									</div>
								</div>
								<div class="col-md-4 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Confirm Password *</label>
										<input name="cpswd" id="cpswd" class="form-control" type="password" autocomplete="off" required value="" minlength="6" >
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Player Name (as per BAI ID) *</label>
										<input name="player_name" id="player_name" required class="form-control" type="text" value="<?php echo $player_name;?>">
									</div>
								</div>					
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Gender *</label>
										<select class="form-control" id="gender" name="gender" required>
											<option value="">Choose...</option>
											<option value="1" <?php if($gender == 1 ) echo "selected";?>>Male</option>
											<option value="2" <?php if($gender == 2 ) echo "selected";?>>Female</option>
										</select>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Date of Birth *</label>
										<input name="dob" id="dob" class="form-control" type="date" value="<?php echo $dob;?>" required min={new Date().toISOString().split('T')[0]}>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>State (as per BAI ID) *</label>
										<input name="state" id="state" required class="form-control" type="text" value="<?php echo $state;?>">
									</div>
								</div>                            
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Academy</label>
										<input name="academy" id="academy" class="form-control" type="text" value="<?php echo $academy;?>">
									</div>
								</div>  
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>BAI ID</label>
										<input name="bai_id" id="bai_id" class="form-control" type="text" value="<?php echo $bai_id;?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Mobile Number *</label>
										<input name="mobile" id="mobile" class="form-control" type="text" required value="<?php echo $mobile;?>">
									</div>
								</div> 		
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Email *</label>
										<input name="email" id="email" class="form-control" type="email" required value="<?php echo $email;?>">
									</div>
								</div>                                     
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Aadhar</label>
										<input name="aadhar" id="aadhar" class="form-control" type="text" value="<?php echo $aadhar;?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Other Id Proof (if Adhar or BAI ID do not exist)</label>
										<input name="other" id="other" class="form-control" type="text" value="<?php echo $other;?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">         
									<div class="form-group ">
										<input class="btn-send marginSpl" type="submit" value="Register">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12 pull-right">  
									Existing members can sign in by <a href="login.php">clicking here</a>
								</div>
								<style>
									ul { list-style-type: disc; /* Use "circle", "square", or "none" for variations */ }
									ul ul { list-style-type: circle; margin-left:20px;/* Nested lists with different bullets */ }
									h8 { color: #f11b22; font-weight: bold;}
								</style>    
								<div class=" col-md-12 col-sm-12 col-xs-12">	                                    
                                    <div class="container mt-4 pull-left">
                                        <h8>Note :-</h8>
                                        <ul>
                                            <li>Please note that each player has to register separately to create his/her profile</li>
                                            <li>Profile is mandatory to register for tournaments</li>
                                            <li>
                                                Tournament registration can happen as follows:
                                                <ul>
                                                    <li>Players select the tournament they want to participate</li>
                                                    <li>Player will login using the profile ID and Password</li>
                                                    <li>Events that the player is eligible to play will be populated</li>
                                                    <li>Player selects the events, makes the payment to complete tournament registration</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>						
                                </div>
							</div>    
						</fieldset>
					</form>						
        		</div>
        	</div>
        </div>
        <!-- Contact Section End -->
		
        <?php include("footer.php"); ?>