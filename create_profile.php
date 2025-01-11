<?php
include_once("evadmin/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $login_id = $dbConn->real_escape_string(trim($_POST['login_id']));
    $pswd = $dbConn->real_escape_string(trim($_POST['pswd']));
    $cpswd = $dbConn->real_escape_string(trim($_POST['cpswd']));
    
    // Initialize an array to collect errors
    $errors = [];

    // Validations
    if (empty($login_id)) {
        $errors[] = "Login ID / Profile Name is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $login_id)) {
        $errors[] =  "Login ID must be 3-20 characters long and can only contain letters, numbers, and underscores";
    }
    
    if (empty($errors)) {
        $result = $dbConn->query("select * from profile_registrations where login_id = '".$login_id."' ");
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
	
    // If no errors, insert data into the database
    if (empty($errors)) {        
        $sql = "INSERT INTO profile_registrations (login_id, pswd) VALUES ('$login_id', '".urlencode(base64_encode($pswd))."')";
        // echo $sql; exit;
        if ($dbConn->query($sql) === TRUE) {
            header("location:player-registration.php?id=".urlencode(base64_encode( $dbConn->insert_id)));
        } else {
            $errors[] = "Error: " . $sql . "<br>" . $dbConn->error;
        }    
    } 
    // Close the connection
    $dbConn->close();
} else {
	$login_id = "";
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<style>
    ul { list-style-type: disc; /* Use "circle", "square", or "none" for variations */ }
    ul ul { list-style-type: circle; margin-left:20px;/* Nested lists with different bullets */ }
    h8 { color: #f11b22; font-weight: bold;}
</style>    
	<?php include("head.php"); ?>
	<body class="home-two">
        <?php include("header.php"); ?>      
		<!-- Contact Section Start -->
		<div class="contact-page-section sec-spacer">
        	<div class="container">
        		<div class="contact-comment-section">
        			<h3>New Profile Creation</h3>
                    <div id="form-message"><?php
						if (!empty($errors)) {
							echo "<p style='color:red;'>";
							foreach ($errors as $error) 
								echo $error."; ";
							echo "</p>";
						}
					?></div>
					<form id="contact-form" method="post" action="" ons>
						<fieldset>                            
                            <div class="row">                                
                                <div class=" col-md-6 col-sm-12 col-xs-12">                                      							    
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Login ID / Profile Name *</label>
                                            <input name="login_id" id="login_id" required class="form-control" type="text" value="<?php echo $login_id;?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Password *</label>
                                            <input name="pswd" id="pswd" class="form-control" type="password" required value="" minlength="6" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Confirm Password *</label>
                                            <input name="cpswd" id="cpswd" class="form-control" type="password" required value="" minlength="6" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 pull-right">  
                                        Existing members can sign in by <a href="login.php">clicking here</a>
                                    </div>       
                                    <div class="col-md-4 col-sm-6 col-xs-12">         
                                        <div class="form-group ">
                                            <input class="btn-send" type="submit" value="Create Profile">
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-sm-12 col-xs-12">	                                    
                                    <div class="container mt-4">
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