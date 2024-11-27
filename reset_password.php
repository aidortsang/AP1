<?php 
include "bdd_con.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $token = $_POST['token']; // Get the token
    $new_password = validate($_POST['new_password']); // Get new password
    $confirm_password = validate($_POST['confirm_password']); // Get confirmed password

    // Check if passwords match
    if (empty($new_password) || empty($confirm_password)) {
        $error = "Both password fields are required.";
    } else if ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash the new password
        // Update password in the database
        $sql = "UPDATE users SET password='$hashed_password', reset_token=NULL WHERE reset_token='$token'";

        if (mysqli_query($conn, $sql)) {
            $success = "Your password has been reset successfully.";
        } else {
            $error = "Failed to reset password.";
        }
    }
}

// Get the token from the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $error = "Invalid reset link.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <form action="reset_password.php" method="post">
        <h2>Reset Password</h2>
        <!-- Display success or error messages -->
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <?php if (isset($success)) { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>

        <!-- Hidden input to pass the token -->
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <!-- Password fields -->
        <label>New Password</label>
        <input type="password" name="new_password" placeholder="Enter new password"><br>
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm new password"><br>

        <!-- Submit button -->
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
