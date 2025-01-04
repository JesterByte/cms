<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Payments";
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

        <!-- Payments Table -->
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Payment ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Data Row 1 -->
              <tr>
                <td>#001</td>
                <td>John Doe</td>
                <td>₱1,500.00</td>
                <td>2024-01-15</td>
                <td>Completed</td>
                <td>
                  <a href="view-payment.php?id=1" class="btn btn-info btn-sm">View</a>
                  <a href="delete-payment.php?id=1" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 2 -->
              <tr>
                <td>#002</td>
                <td>Jane Smith</td>
                <td>₱2,000.00</td>
                <td>2024-02-05</td>
                <td>Pending</td>
                <td>
                  <a href="view-payment.php?id=2" class="btn btn-info btn-sm">View</a>
                  <a href="delete-payment.php?id=2" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>

        <!-- Add New Payment Button -->
        <div class="d-flex justify-content-end">
          <a href="add-payment.php" class="btn btn-primary">Add New Payment</a>
        </div>

      </main>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <?php include_once "dashboard-footer.php"; ?>
</body>
</html>
