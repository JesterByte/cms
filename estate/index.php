<?php 
  session_start();
  require_once "../utils/helpers.php";
  require_once "../content/pricing.php";

  if (!isset($_SESSION["user_id"])) {
    serverRedirect("../");
  }

  function displayEstatePricingTable($estatePricingTable) {
    foreach ($estatePricingTable as $estatePricingRow) {
      startRow();
      rowData($estatePricingRow["estate"]);
      rowData($estatePricingRow["sqm"]);
      rowData($estatePricingRow["number_of_lots"]);
      rowData(formatToPeso($estatePricingRow["lot_price"]));
      rowData(formatToPeso($estatePricingRow["total_purchase_price"]));
      rowData(formatToPeso($estatePricingRow["cash_sale_10_discount"]));
      rowData(formatToPeso($estatePricingRow["cash_sale_5_discount"]));
      rowData(formatToPeso($estatePricingRow["down_payment_20"]));
      rowData(formatToPeso($estatePricingRow["balance"]));
      rowData(formatToPeso($estatePricingRow["monthly_amortization_1yr"]));
      rowData(formatToPeso($estatePricingRow["monthly_amortization_2yrs_10_interest"]));
      rowData(formatToPeso($estatePricingRow["monthly_amortization_3yrs_15_interest"]));
      rowData(formatToPeso($estatePricingRow["monthly_amortization_4yrs_20_interest"]));
      rowData(formatToPeso($estatePricingRow["monthly_amortization_5yrs_25_interest"]));
      endRow();
    }
  }

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "Estate Pricing";
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateEstatePricingModal"><i class="bi bi-arrow-repeat"></i> Update Pricing</button>

          </div>

          <!-- DataTable -->
          <div class="table-responsive rounded shadow">
            <table id="phasePricingTable" class="table table-striped table-hover table-bordered text-center" style="width:100%">
              <thead>
                <tr>
                  <th rowspan="4">Estate</th>
                  <th rowspan="4">SQM</th>
                  <th rowspan="4">Number of Lot(s)</th>
                  <th rowspan="4">Lot Price</th>
                  <th rowspan="4">Total Purchase Price (VAT & MCF Included)</th>
                  <th rowspan="1">Option 1</th>
                  <th rowspan="1">Option 2</th>
                  <th rowspan="1" colspan="7">Option 3 (Installment)</th>
                </tr>
                <tr>
                  <th rowspan="1">Cash Sale</th>
                  <th rowspan="1">6 Months</th>
                  <th rowspan="3">20% Down Payment</th>
                  <th rowspan="3">Balance</th>
                  <th>1 Year</th>
                  <th>2 Years</th>
                  <th>3 Years</th>
                  <th>4 Years</th>
                  <th>5 Years</th>
                </tr>
                <tr>
                  <th rowspan="2">10% Discount</th>
                  <th rowspan="2">5% Discount</th>
                  <th rowspan="1">No Interest</th>
                  <th rowspan="1">10% Interest</th>
                  <th rowspan="1">15% Interest</th>
                  <th rowspan="1">20% Interest</th>
                  <th rowspan="1">25% Interest</th>
                </tr>
                <tr>
                  <th colspan="5">Monthly Amortization</th>
                </tr>
              </thead>
              <tbody>
                <?= displayEstatePricingTable($estatePricingTable); ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

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

    <?php 
      include_once "../components/modals/modal-sign-out.html"; 
      include_once "../components/modals/modal-update-pricing.html";
    ?>

    <script>
      const priceUpdated = <?= echoSessionToast("estate_price_updated"); ?>;

      if (priceUpdated === true) {
        showToast("Price updated successfully!", "Operation Complete");
        unsetToast();
      }
    </script>

    <script>
      modalAutofocus("updateEstatePricingModal", "estateSelect");
    </script>

    <script>
      $(document).ready(function() {
        $('#phasePricingTable').DataTable({
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
