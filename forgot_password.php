<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "bdd_con.php"; // Database connection

    // Function to validate email input
    function validate($data) {
        $data = trim($data); // Remove extra spaces
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    $email = validate($_POST['email']); // Sanitize email input

    // Check if email is empty
    if (empty($email)) {
        $error = "Email is required";
    } else {
        // Query to check if email exists in the database
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        // If email exists
        if (mysqli_num_rows($result) === 1) {
            $token = bin2hex(random_bytes(50)); // Generate a unique token
            $updateToken = "UPDATE users SET reset_token='$token' WHERE email='$email'";
            
            if (mysqli_query($conn, $updateToken)) {
                // Send email with reset link
                $resetLink = "http://yourdomain.com/reset_password.php?token=$token";
                $subject = "Password Reset Request";
                $message = "Click the link below to reset your password:\n$resetLink";
                $headers = "From: no-reply@yourdomain.com";

                if (mail($email, $subject, $message, $headers)) {
                    $success = "Password reset link has been sent to your email.";
                } else {
                    $error = "Failed to send email.";
                }
            } else {
                $error = "Error generating reset link.";
            }
        } else {
            $error = "Email not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <form action="forgot_password.php" method="post">
        <h2>Forgot Password</h2>
        <!-- Display success or error messages -->
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <?php if (isset($success)) { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>
        
        <!-- Email input -->
        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email"><br>

        <!-- Submit button -->
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
