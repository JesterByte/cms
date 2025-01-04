<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Dashboard";
    include_once "dashboard-header.php"; 
  ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
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

        <!-- Dashboard Overview Section -->
        <div class="row">
          <!-- Quick Summary Cards -->
          <div class="col-lg-3 col-md-6">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Total Reservations</h5>
                <p class="h2">150</p>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Revenue Today</h5>
                <p class="h2">&#8369;12,000</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Pending Payments</h5>
                <p class="h2">25</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Available Plots</h5>
                <p class="h2">30</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Chart Section -->
        <div class="row">
          <!-- Example Chart (Revenue over the past month) -->
          <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm">
              <div class="card-header">
                <h5>Revenue Trend (Last 30 Days)</h5>
              </div>
              <div class="card-body">
                <canvas id="revenueChart"></canvas>
              </div>
            </div>
          </div>

          <!-- Example Chart (Number of Reservations over time) -->
          <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm">
              <div class="card-header">
                <h5>Reservations Trend (Last 30 Days)</h5>
              </div>
              <div class="card-body">
                <canvas id="reservationChart"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activities Section -->
        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-header">
                <h5>Recent Activities</h5>
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">Activity</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2024-12-27</td>
                      <td>Reservation made for Plot #32</td>
                      <td><span class="badge bg-success">Completed</span></td>
                    </tr>
                    <tr>
                      <td>2024-12-26</td>
                      <td>Payment received for Plot #21</td>
                      <td><span class="badge bg-info">Processed</span></td>
                    </tr>
                    <tr>
                      <td>2024-12-25</td>
                      <td>New reservation request for Plot #15</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                    </tr>
                    <tr>
                      <td>2024-12-24</td>
                      <td>Burial service scheduled for Plot #19</td>
                      <td><span class="badge bg-success">Completed</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <?php include_once "dashboard-footer.php"; ?>

  <!-- Include Bootstrap JS and Chart.js for charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Chart JS Initialization -->
  <script>
    var ctx1 = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['2024-12-01', '2024-12-05', '2024-12-10', '2024-12-15', '2024-12-20', '2024-12-25'], 
        datasets: [{
          label: 'Revenue (₱)',
          data: [12000, 13500, 11000, 14500, 12000, 18000],
          borderColor: 'rgba(75, 192, 192, 1)',
          tension: 0.1,
          fill: false
        }]
      }
    });

    var ctx2 = document.getElementById('reservationChart').getContext('2d');
    var reservationChart = new Chart(ctx2, {
      type: 'line',
      data: {
        labels: ['2024-12-01', '2024-12-05', '2024-12-10', '2024-12-15', '2024-12-20', '2024-12-25'],
        datasets: [{
          label: 'Reservations',
          data: [5, 7, 6, 8, 9, 12],
          borderColor: 'rgba(54, 162, 235, 1)',
          tension: 0.1,
          fill: false
        }]
      }
    });
  </script>

</body>
</html>
