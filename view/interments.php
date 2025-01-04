<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Interments";
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

        <!-- Interments Table -->
        <div class="table-responsive">
          <table id="intermentsTable" class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Interment ID</th>
                <th scope="col">Name of Deceased</th>
                <th scope="col">Plot</th>
                <th scope="col">Interment Date</th>
                <th scope="col">Interment Type</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Data Row 1 -->
              <tr>
                <td>#001</td>
                <td>John Doe</td>
                <td>A1</td>
                <td>2024-01-15</td>
                <td>Burial</td>
                <td>
                  <a href="edit-interment.php?id=1" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=1" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 2 -->
              <tr>
                <td>#002</td>
                <td>Jane Smith</td>
                <td>B1</td>
                <td>2024-02-05</td>
                <td>Cremation</td>
                <td>
                  <a href="edit-interment.php?id=2" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=2" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 3 -->
              <tr>
                <td>#003</td>
                <td>Michael Lee</td>
                <td>A2</td>
                <td>2024-03-10</td>
                <td>Burial</td>
                <td>
                  <a href="edit-interment.php?id=3" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=3" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 4 -->
              <tr>
                <td>#004</td>
                <td>Sara Taylor</td>
                <td>B2</td>
                <td>2024-04-18</td>
                <td>Cremation</td>
                <td>
                  <a href="edit-interment.php?id=4" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=4" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 5 -->
              <tr>
                <td>#005</td>
                <td>Emily Davis</td>
                <td>A3</td>
                <td>2024-05-22</td>
                <td>Burial</td>
                <td>
                  <a href="edit-interment.php?id=5" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=5" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 6 -->
              <tr>
                <td>#006</td>
                <td>David Clark</td>
                <td>B3</td>
                <td>2024-06-13</td>
                <td>Cremation</td>
                <td>
                  <a href="edit-interment.php?id=6" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=6" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 7 -->
              <tr>
                <td>#007</td>
                <td>Laura Adams</td>
                <td>A4</td>
                <td>2024-07-30</td>
                <td>Burial</td>
                <td>
                  <a href="edit-interment.php?id=7" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=7" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 8 -->
              <tr>
                <td>#008</td>
                <td>Chris Martin</td>
                <td>B4</td>
                <td>2024-08-15</td>
                <td>Cremation</td>
                <td>
                  <a href="edit-interment.php?id=8" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=8" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 9 -->
              <tr>
                <td>#009</td>
                <td>Olivia Moore</td>
                <td>A5</td>
                <td>2024-09-05</td>
                <td>Burial</td>
                <td>
                  <a href="edit-interment.php?id=9" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=9" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              <!-- Example Data Row 10 -->
              <tr>
                <td>#010</td>
                <td>William Lee</td>
                <td>B5</td>
                <td>2024-10-01</td>
                <td>Cremation</td>
                <td>
                  <a href="edit-interment.php?id=10" class="btn btn-warning btn-sm">Edit</a>
                  <a href="delete-interment.php?id=10" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Add New Interment Button -->
        <div class="d-flex justify-content-end">
          <a href="add-interment.php" class="btn btn-primary">Add New Interment</a>
        </div>

      </main>
    </div>
  </div>

  <?php include_once "dashboard-footer.php"; ?>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Initialize DataTable and set limit to 10 rows per page
    $(document).ready(function() {
      $('#intermentsTable').DataTable({
        "pageLength": 10
      });
    });
  </script>

</body>
</html>
