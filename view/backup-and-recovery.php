<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Backup & Recovery";
    include_once "dashboard-header.php"; 
  ?>
</head>
<body>
  <?php 
    include_once "theme.html";
    include_once "dashboard-symbols.php"; 
    include_once "navbar.html";
  ?>
  
  <div class="container-fluid">
    <div class="row">
      <?php include_once "sidebar.php"; ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2"><?php echo $pageTitle; ?></h1>
        </div>

        <!-- Backup Section -->
        <section class="mb-4">
          <h3>Backup</h3>
          <p>Use the button below to create a backup of the system's database and files. It is recommended to perform regular backups to ensure data safety.</p>
          
          <div class="d-flex justify-content-start">
            <button class="btn btn-success" id="backupBtn">Create Backup</button>
          </div>

          <div id="backupStatus" class="mt-3"></div>
        </section>

        <!-- Recovery Section -->
        <section>
          <h3>Recovery</h3>
          <p>Use the form below to recover a backup. Select a backup file and restore it to the system.</p>
          
          <form id="recoveryForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="backupFile" class="form-label">Select Backup File</label>
              <input type="file" class="form-control" id="backupFile" name="backupFile" required>
            </div>

            <button type="submit" class="btn btn-primary" id="restoreBtn">Restore Backup</button>
          </form>

          <div id="recoveryStatus" class="mt-3"></div>
        </section>

      </main>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Example Scripts for Backup and Recovery -->
  <script>
    // Backup Button Click
    document.getElementById("backupBtn").addEventListener("click", function() {
      document.getElementById("backupStatus").innerHTML = "Backup is being created... Please wait.";
      
      // Call your PHP backup function here (AJAX, for example)
      setTimeout(function() {
        document.getElementById("backupStatus").innerHTML = "Backup created successfully!";
      }, 2000); // Simulate backup process
    });

    // Recovery Form Submission
    document.getElementById("recoveryForm").addEventListener("submit", function(event) {
      event.preventDefault();

      var formData = new FormData(this);
      document.getElementById("recoveryStatus").innerHTML = "Restoring backup... Please wait.";
      
      // Simulate file upload for recovery
      setTimeout(function() {
        document.getElementById("recoveryStatus").innerHTML = "Backup restored successfully!";
      }, 3000); // Simulate recovery process
    });
  </script>

  <?php include_once "dashboard-footer.php"; ?>

</body>
</html>
