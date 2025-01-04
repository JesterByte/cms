<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php include_once "header.html"; ?>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <?php include_once "theme.html"; ?>
  <main class="form-signin w-100 m-auto">
    <form class="needs-validation" action="../controller/sign-in-controller.php" method="POST" novalidate>
      
      <div class="row">
        <div class="col d-flex justify-content-center">
          <img src="../assets/img/green_haven_memorial_park_logo.png" alt="" width="300" height="150">
        </div>
      </div>
      <h1 class="h3 my-3 fw-normal text-center">Green Haven <br> Memorial Park</h1>

      <div class="form-floating">
        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
        <label for="username">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>

      <div class="row my-3">
        <div class="col d-flex justify-content-end">
          <a href="forgot-password.php">Forgot password?</a>
        </div>
      </div>

      <!-- <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="remember-me">
        <label class="form-check-label" for="remember-me">
          Remember me
        </label>
      </div> -->
      <button class="btn btn-primary w-100 py-2" name="submit-button" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-body-secondary">&copy; 2024 ACLC College of Santa Maria, CS41A, Group 1, School Year 2024–2025</p>
    </form>
  </main>

  <?php include_once "footer.html"; ?>

</body>
</html>
