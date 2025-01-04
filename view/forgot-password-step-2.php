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
                <li>Check your inbox for a 6-digit one-time password (OTP).</li>
                <li>Enter the received OTP on the next page.</li>
                <li>Create and confirm your new password.</li>
                <li>Log in with your new credentials.</li>
            </ol>
        </p>

        <?php 
          if (isset($_SESSION["invalid_otp"])) {
            dangerAlert("Sorry, your OTP is invalid. Please try again.");
            unset($_SESSION["invalid_otp"]);
          }
        ?>

        <div id="countdown" class="mb-3 text-danger"></div>
        <div class="form-floating">
          <input type="text" name="otp" class="form-control" id="otp" inputmode="numeric" maxlength="6" pattern="^\d{6}$" placeholder="OTP" required>
          <label for="otp">OTP</label>
        </div>
        <button class="btn btn-primary w-100 py-2" name="submit-button" type="submit">Submit</button>
    </form>
  </main>

  <?php include_once "footer.html"; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const otpInput = document.getElementById('otp');

      otpInput.addEventListener('input', function () {
        // Remove any non-digit characters
        this.value = this.value.replace(/\D/g, '');

        // Trim the value to 6 digits
        if (this.value.length > 6) {
          this.value = this.value.slice(0, 6);
        }
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const otpInput = document.getElementById('otp');
        const submitButton = document.querySelector('button[name="submit-button"]');
        const countdownElement = document.getElementById('countdown');
        const otpGenerationTime = <?php echo isset($_SESSION["otp_generation_time"]) ? $_SESSION["otp_generation_time"] : 'null'; ?>;
        const now = Math.floor(Date.now() / 1000);
        const otpValidityDuration = 5 * 60; // 5 minutes in seconds

        if (otpGenerationTime && (now - otpGenerationTime) < otpValidityDuration) {
            const timeElapsed = now - otpGenerationTime;
            const timeRemaining = otpValidityDuration - timeElapsed;

            function updateCountdown() {
                const currentTime = Math.floor(Date.now() / 1000);
                const timeLeft = otpValidityDuration - (currentTime - otpGenerationTime);

                if (timeLeft > 0) {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    countdownElement.textContent = `Time remaining: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                } else {
                    submitButton.disabled = true;
                    countdownElement.textContent = 'The OTP has expired. Please request a new one.';
                    clearInterval(countdownInterval);
                }
            }

            updateCountdown();
            const countdownInterval = setInterval(updateCountdown, 1000);
        } else {
            submitButton.disabled = true;
            countdownElement.textContent = 'The OTP has expired. Please request a new one.';
        }

        otpInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });
    });
  </script>

</body>
</html>
