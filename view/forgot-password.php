<?php 
  include_once "../includes/session.php";
  include_once "../includes/utilities.php";
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php include_once "header.html"; ?>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <?php include_once "theme.html"; ?>
  <main class="form-signin w-100 m-auto">
    <form class="needs-validation" action="../controller/forgot-password-controller.php" method="POST" novalidate>
        <a href="sign-in.php" class="btn"><i class="bi bi-arrow-left"></i></a>
        <h1 class="h3 mb-3 fw-normal">Forgot Password</h1>
        <p class="text-muted mb-3">
            To reset your password, please follow these steps:
            <ol>
                <li>Enter your registered email address below.</li>
                <li>Check your inbox for a 6-digit one-time password (OTP).</li>
                <li>Enter the received OTP on the next page.</li>
                <li>Create and confirm your new password.</li>
                <li>Log in with your new credentials.</li>
            </ol>
        </p>

        <?php 
          if (isset($_SESSION["invalid_email_address"])) {
            dangerAlert("Sorry, your email address is invalid. Please try again.");
            unset($_SESSION["invalid_email_address"]);
          } else if (isset($_SESSION["otp_expired"])) {
            dangerAlert("Sorry, your verification code has expired. Please request a new code to proceed.");
            unset($_SESSION["otp_expired"]);
          }
        ?>

        <div class="form-floating">
          <input type="email" name="email-address" class="form-control" id="email-address" placeholder="Email address" required>
          <label for="email-address">Email address</label>
        </div>
        <button class="btn btn-primary w-100 py-2" name="submit-button" type="submit">Send OTP</button>
    </form>
  </main>

  <?php include_once "footer.html"; ?>

</body>
</html>
