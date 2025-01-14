<?php
include_once("evadmin/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $login_id = $dbConn->real_escape_string(trim($_POST['login_id']));
    $password = $dbConn->real_escape_string(trim($_POST['logpswd']));

    // Initialize an array for errors
    $errors = [];

    // Validate login_id and password
    if (empty($login_id)) {
        $errors[] = "Invalid login_id address";
    }

    if (strlen($password) < 6) {
        $errors[] = "Invalid Password";
    }

    if (empty($errors)) {
        // Check if user exists and verify password
        $query = "SELECT * FROM player_registrations WHERE login_id = '$login_id' ";
        $result = $dbConn->query($query);

        if ($result->num_rows == 1 ) {
			$user = $result->fetch_assoc();
            // Assuming passwords are hashed, verify the hash
            if (urlencode(base64_encode($password)) == $user['pswd']) {
				$_SESSION['btr_user'] = $user;
                $dbConn->query("update player_registrations set last_login = '".date("Y-m-d H:i:s")."' WHERE player_id =".$user['player_id']);

                // You can redirect to the dashboard or another page
                header("Location: dashboard.php");
            } else {
                $errors[] = "Invalid login details";
            }
        } else {
            $errors[] = "No player registered with the given details";
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
            <h3 class="title-bg">Player Login</h3>
        		<div class="contact-comment-section">
               
                    <div id="form-message"><?php
						if (!empty($errors)) {
							echo "<p style='color:red;'>";
							foreach ($errors as $error) 
								echo $error."; ";
							echo "</p>";
						}
					?></div>
					<form id="login-form" method="post" action="">
						<fieldset>							
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Login ID / Profile Name *</label>
										<input name="login_id" id="login_id" class="form-control" type="login_id" required>
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Password *</label>
										<input name="logpswd" id="logpswd" class="form-control" type="password" required>
										<a href="forgot.php" class="resetLink">Reset Login Details</a>
									</div>
								</div>
                                <div class="col-md-12 col-sm-12 col-xs-12 align-center">         
									<div class="form-group mb-0 pull-left width100p">
										<input class="btn-send" type="submit" value="Login">
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