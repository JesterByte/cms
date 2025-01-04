<?php 
  include_once "../includes/session.php";
  include_once "../includes/utilities.php";

  if (!isset($_SESSION["user_id"])) {
    redirect("../controller/forgot-password-controller.php");
  }
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
        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#forgot-password-cancellation-modal"><i class="bi bi-arrow-left"></i></a>
        <h1 class="h3 mb-3 fw-normal">Forgot Password</h1>
        <p class="text-muted mb-3">
            To reset your password, please follow these steps:
            <ol>
                <li>Create and confirm your new password.</li>
                <li>Log in with your new credentials.</li>
            </ol>
        </p>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        <div class="form-floating">
          <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Confirm password" required>
          <label for="confirm-password">Confirm password</label>
        </div>
        <button class="btn btn-primary w-100 py-2" name="submit-button" id="submit-button" type="submit">Update password</button>
    </form>
  </main>

  <?php include_once "footer.html"; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm-password');
        const submitButton = document.getElementById('submit-button');

        function validatePasswords() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Check if passwords match and are not empty
            if (password && confirmPassword && password === confirmPassword) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        // Attach input event listeners to both password fields
        passwordInput.addEventListener('input', validatePasswords);
        confirmPasswordInput.addEventListener('input', validatePasswords);
    });
  </script>


</body>
</html>
