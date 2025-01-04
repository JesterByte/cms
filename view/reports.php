<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Reports";
    include_once "dashboard-header.php"; 
  ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6H2oFz5e8fF1z3J96F3d6f8c8N4yN1aFkQjTxskl5gaU1CVVJ6Q47eDO5M" crossorigin="anonymous">
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

        <!-- Reports Overview Section -->
        <div class="row">
          <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
              <div class="card-header">Interment Report</div>
              <div class="card-body">
                <h5 class="card-title">Interments this Month</h5>
                <p class="card-text">View and download a report of all interments this month.</p>
                <a href="interment-report.php" class="btn btn-light">View Report</a>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
              <div class="card-header">Payment Report</div>
              <div class="card-body">
                <h5 class="card-title">Payments this Month</h5>
                <p class="card-text">View and download a report of all payments made this month.</p>
                <a href="payment-report.php" class="btn btn-light">View Report</a>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
              <div class="card-header">Reservation Report</div>
              <div class="card-body">
                <h5 class="card-title">Upcoming Reservations</h5>
                <p class="card-text">View and download a report of all upcoming reservations.</p>
                <a href="reservation-report.php" class="btn btn-light">View Report</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Custom Date Range Report -->
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">Custom Date Range Report</div>
              <div class="card-body">
                <h5 class="card-title">Generate Report by Date Range</h5>
                <form action="generate-report.php" method="POST">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                      </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                      <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <?php include_once "dashboard-footer.php"; ?>
</body>
</html>
