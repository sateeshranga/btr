<?php
include_once("evadmin/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $token = $dbConn->real_escape_string(trim($_POST['token']));
    $password = $dbConn->real_escape_string(trim($_POST['password']));
    $confirmPassword = $dbConn->real_escape_string(trim($_POST['confirm_password']));

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }  else if(strlen($password) < 6){
        $errors[] = "Password must be minimum 6 characters.";
	}

    // Find the email associated with the token
    $result = $dbConn->query("SELECT * FROM password_resets WHERE token = '$token' AND created_at > NOW() - INTERVAL 1 HOUR");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Hash the new password
        $hashedPassword = base64_encode($password);

        // Update the user's password
        // echo "UPDATE player_registrations SET pswd = '$hashedPassword' WHERE email = '$email'";
        $dbConn->query("UPDATE player_registrations SET pswd = '$hashedPassword' WHERE email = '$email'");

        // Delete the token
        $dbConn->query("DELETE FROM password_resets WHERE token = '$token'");

        $errors[] = "Password has been reset successfully.";
    } else {
        $errors[] = "Invalid or expired reset link.";
    }

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
        		<div class="contact-comment-section">
                    <h3>Reset Password</h3>
                    <div id="form-message"><?php
						if (!empty($errors)) {
							echo "<p style='color:red;'>";
							foreach ($errors as $error) 
								echo $error."; ";
							echo "</p>";
						}
					?></div>
					<form method="post" action="">
                        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                        
        		</div>
        	</div>
        </div>
        <!-- Contact Section End -->
        <?php include("footer.php"); ?>