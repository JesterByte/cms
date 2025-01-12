<?php 
  session_start();
  require_once "../utils/helpers.php";
  require_once "../utils/sanitizer.php";
  require_once "../content/customers.php";

  if (!isset($_SESSION["user_id"])) {
    serverRedirect("../");
  }

  function displayCustomersTable($customersTable) {
    foreach ($customersTable as $customersRow) {
      startRow();
      rowData($customersRow["full_name"]);
      rowData($customersRow["username"]);
      rowData($customersRow["email"]);
      rowData($customersRow["contact_number"]);
      rowData($customersRow["address"]);
      rowData(displayDateTime($customersRow["created_at"]));
      endRow();  
    }
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "Customers";
      include_once "../components/head.php";   
    ?>
  </head>
  <body>
    <?php 
      include_once "../components/theme.html"; 
      include_once "../components/symbols.html";
      include_once "../components/navbar.html";
    ?>
    
    <div class="container-fluid">
      <div class="row">
        <?php include_once "../components/sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= $pageTitle ?></h1>
            <!-- <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi"><use xlink:href="#calendar3"/></svg>
                This week
              </button>
            </div> -->
          </div>

          <!-- DataTable -->
          <div class="table-responsive rounded shadow">
            <table id="customersTable" class="table table-striped table-hover table-bordered text-center" style="width:100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email Address</th>
                  <th>Contact Number</th>
                  <th>Address</th>
                  <th>Joined At</th>
                </tr>
              </thead>
              <tbody>
                <?= displayCustomersTable($customersTable); ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <?php include_once "../components/modals/modal-sign-out.html"; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/modal-autofocus.js"></script>

    <script>
      $(document).ready(function() {
        $('#customersTable').DataTable({
          dom: 'Bfrtip',
          buttons: [
            'colvis', 'copy', 'csv', 'excel', {
              extend: 'pdfHtml5',
              orientation: 'landscape',
              pageSize: 'A4',
              exportOptions: {
                columns: ':visible',
                modifier: {
                  page: 'current'
                }
              },
              customize: function (doc) {
                doc.defaultStyle.fontSize = 8; // Set default font size for all text
                doc.styles.tableHeader.fontSize = 10; // Set font size for table headers
                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split(''); // Auto adjust column widths
                doc.content[1].layout = {
                  hLineWidth: function (i, node) {
                    return (i === 0 || i === node.table.body.length) ? 2 : 1; // Set horizontal line width
                  },
                  vLineWidth: function (i, node) {
                    return (i === 0 || i === node.table.widths.length) ? 2 : 1; // Set vertical line width
                  },
                  hLineColor: function (i, node) {
                    return (i === 0 || i === node.table.body.length) ? 'black' : 'gray'; // Set horizontal line color
                  },
                  vLineColor: function (i, node) {
                    return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray'; // Set vertical line color
                  }
                };
              }
            }, 'print'
          ]
        });
      });
    </script>
  </body>
</html>
