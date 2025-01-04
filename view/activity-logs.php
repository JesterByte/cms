<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Activity Logs";
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

        <!-- Activity Logs Table -->
        <section>
          <h3>Recent Activities</h3>
          <p>Below are the most recent activities performed in the system. This includes actions like user logins, data updates, and other system events.</p>
          
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">User</th>
                <th scope="col">Activity</th>
                <th scope="col">Details</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example log entry -->
              <tr>
                <td>2024-12-27 10:45 AM</td>
                <td>John Doe (Admin)</td>
                <td>Login</td>
                <td>Successful login from IP: 192.168.1.100</td>
              </tr>
              <tr>
                <td>2024-12-26 03:22 PM</td>
                <td>Jane Smith (Manager)</td>
                <td>Data Update</td>
                <td>Updated the details of plot #12</td>
              </tr>
              <tr>
                <td>2024-12-26 09:10 AM</td>
                <td>John Doe (Admin)</td>
                <td>Backup</td>
                <td>Backup of the database was successfully created</td>
              </tr>
              <!-- Add more log entries as needed -->
            </tbody>
          </table>
        </section>

      </main>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <?php include_once "dashboard-footer.php"; ?>

</body>
</html>
