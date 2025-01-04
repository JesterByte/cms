<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "User Management";
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

        <!-- Add New User Button -->
        <div class="d-flex justify-content-end mb-3">
          <a href="add-user.php" class="btn btn-primary">Add New User</a>
        </div>

        <!-- User Table -->
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">User ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example User Row 1 -->
              <tr>
                <td>#101</td>
                <td>John Doe</td>
                <td>Administrator</td>
                <td>Active</td>
                <td>
                  <a href="edit-user.php?id=101" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-user.php?id=101" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example User Row 2 -->
              <tr>
                <td>#102</td>
                <td>Jane Smith</td>
                <td>Manager</td>
                <td>Inactive</td>
                <td>
                  <a href="edit-user.php?id=102" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-user.php?id=102" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Add more user rows as needed -->
            </tbody>
          </table>
        </div>

      </main>
    </div>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <?php include_once "dashboard-footer.php"; ?>
</body>
</html>
