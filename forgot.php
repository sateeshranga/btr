<?php
include_once("evadmin/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $login_id = $dbConn->real_escape_string(trim($_POST['login_id']));

    // Initialize an array for errors
    $errors = [];

    // Validate email and password
    if (empty($login_id)) {
        $errors[] = "Login ID / Profile Name is required.";
    }

    if (empty($errors)) {
        // Check if user exists and verify password
        $query = "SELECT * FROM player_registrations WHERE login_id = '$login_id' ";
        $result = $dbConn->query($query);

        if ($result->num_rows == 1 ) {
			$user = $result->fetch_assoc();
			$email = $user['email'];
			// Generate a unique token
			$token = bin2hex(random_bytes(50));

			// Insert token into the database
			$dbConn->query("INSERT INTO password_resets (email, token) VALUES ('$email', '$token')");
	
			// Create reset link
			$resetLink = BASE_URL ."reset_password.php?token=" . $token;
	
			// Send email
			$to = $email;
			$subject = "Password Reset Request";
			$message = "Click on the link below to reset your password:\n\n" . $resetLink;
			$headers = "From: no-reply@btronline.in";
	
			if (mail($to, $subject, $message, $headers)) {
				$errors[] = "Password reset link has been sent to your registed email.".$resetLink;
			} else {
				$errors[] = "Failed to send email. Please try again.";
			}
            //Password reset link
        } else {
            $errors[] = "No player registered with the given Login ID / Profile Name.";
        }
    }
    // Close the connection
    $dbConn->close();
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
			<h3 class="title-bg">Reset Password</h3>
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
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Login ID / Profile Name*</label>
										<input name="login_id" id="login_id" class="form-control" type="login_id">
									</div>
								</div>
                                <div class="col-md-12 col-sm-12 col-xs-12 align-center">         
									<div class="form-group mb-0 pull-left width100p">
										<input class="btn-send" type="submit" value="Send Reset Link">
									</div>
								</div>
							</div>
                            <div class="col-md-6 col-sm-6 col-xs-12 rightLoginImageContainer">
                              <img src="img/table-banner.jpg"/>
                            </div>
						</fieldset>
					</form>						
        		</div>
        	</div>
        </div>
        <!-- Contact Section End -->
        <?php include("footer.php"); ?>