<?php 
  session_start();
  require_once "../utils/helpers.php";
  require_once "../content/reservation-requests.php";

  if (!isset($_SESSION["user_id"])) {
    serverRedirect("../");
  }

  function displayLotReservationsTable($reservationsTable) {
    foreach ($reservationsTable as $reservationRow) {
      $encodedGraveId = encodeUrlParameter($reservationRow["reserved_lot"]);

      startRow();
      rowData($reservationRow["created_at"]);
      rowData($reservationRow["full_name"]);
      rowData($reservationRow["formatted_reserved_lot"]);
      rowLinkGroup("btn-success", '<i class="bi bi-check"></i>', "Verify", "../reservation-verification/?grave_id=$encodedGraveId", "btn-danger", '<i class="bi bi-x"></i>', "Decline", "#");
      endRow();  

    }
  }

  function displayBurialReservationsTable($reservationsTable) {
    foreach ($reservationsTable as $reservationRow) {
      startRow();
      rowData($reservationRow["created_at"]);
      rowData($reservationRow["full_name"]);
      rowData($reservationRow["formatted_burial_lot"]);
      rowLinkGroup("btn-success", '<i class="bi bi-check"></i>', "Verify", "../reservation-verification", "btn-danger", '<i class="bi bi-x"></i>', "Decline", "#");
      endRow();  
    }
  }


  function lotReservationsTableHead() {
    echo '
    <th>Date of Reservation</th>
    <th>Reservee</th>
    <th>Reserved Lot</th>
    <th>Action</th>';
  }

  function burialReservationsTableHead() {
    echo '
    <th>Date of Reservation</th>
    <th>Reservee</th>
    <th>Selected Lot</th>
    <th>Burial Date</th>
    <th>Action</th>';
  }

  function isActiveLink($type) {
    if (isset($_GET["type"]) && $_GET["type"] == $type) {
      echo "active";
    } else {
      echo "";
    }
  }

  function rowLinkGroup($color1 = "", $icon1 = "", $textContent1 = "", $link1 = "#", $color2 = "", $icon2 = "", $textContent2 = "", $link2 = "#") {
    echo "<td>" . 
    '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
      <a href="' . $link1 . '" class="btn ' . $color1 . '">' . $icon1 . " " . $textContent1 . '</a>
      <a href="' . $link2 . '" class="btn ' . $color2 . '">' . $icon2 . " " . $textContent2 . '</a>
    </div>' . 
    "</td>";
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "Reservation Requests";
      include_once "../components/head.php";   
    ?>

    <style>
      #map {
        height: 600px;
        width: 100%;
      }
    </style>
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
            <div class="btn-group">
              <a href="?type=lot" class="btn btn-primary <?= isActiveLink("lot") ?>" aria-current="page"><i class="bi bi-square-fill"></i> Lot</a>
              <a href="?type=burial" class="btn btn-primary <?= isActiveLink("burial"); ?>"><i class="bi bi-umbrella-fill"></i> Burial</a>
            </div>          
          </div>

          <!-- DataTable -->
          <div class="table-responsive rounded shadow">
            <table id="reservationRequestsTable" class="table table-striped table-hover table-bordered text-center" style="width:100%">
              <thead>
                <tr>
                  <?php 
                    if (isset($_GET["type"]) && $_GET["type"] == "lot") {
                      lotReservationsTableHead();
                    } else if (isset($_GET["type"]) && $_GET["type"] == "burial") {
                      burialReservationsTableHead();
                    } else {
                      lotReservationsTableHead();
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if ((isset($_GET["type"])) && $_GET["type"] == "lot") {
                    displayLotReservationsTable($lotReservationsTable);
                  } else if (isset($_GET["type"]) && $_GET["type"] == "burial") {
                    displayBurialReservationsTable($burialReservationsTable);
                  } else {
                    displayLotReservationsTable($lotReservationsTable);
                  }          
                ?>
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

    <?php include_once "../components/modals/modal-sign-out.html"; ?>

    <script>
      $(document).ready(function() {
        $('#reservationRequestsTable').DataTable({
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
    
    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([14.871318, 120.976566], 18); // Use your latitude and longitude

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 20
            }).addTo(map);

            // Function to draw rectangles for graves
            function drawGrave(grave) {
                const graveWidth = 0.000009; // Approx. 1 meter in longitude degrees
                const graveHeight = 0.000018; // Approx. 2 meters in latitude degrees

                // Calculate end latitude and longitude based on starting coordinates and grave size
                var startLat = grave.latitude_start;
                var startLng = grave.longitude_start;
                var endLat = grave.latitude_end;
                var endLng = grave.longitude_end;

                // Determine the color based on grave status
                let color;
                switch (grave.status) {
                    case 'Available':
                        color = 'green';
                        break;
                    case 'Reserved':
                        color = 'yellow';
                        break;
                    case 'Sold':
                        color = 'red';
                        break;
                    case 'Sold and Occupied':
                        color = 'gray';
                        break;
                    default:
                        color = 'blue'; // Default color for unknown status
                }

                // Create a rectangle (polygon) for the grave lot
                var rectangle = L.rectangle([[startLat, startLng], [endLat, endLng]], {
                    color: color,
                    weight: 1,
                    fillOpacity: 0.5
                }).addTo(map);

                // Add a popup to the rectangle showing the status
                rectangle.bindPopup("<b>Status:</b> " + grave.status);
            }

            // Fetch grave data from PHP file (using AJAX)
            fetch('../content/reservation-requests-map.php')
                .then(response => response.json())
                .then(data => {
                    // Iterate through graves and draw rectangles
                    data.forEach(grave => {
                        drawGrave(grave);
                    });
                })
                .catch(error => console.error('Error fetching grave data:', error));

        });
    </script>

  </body>
</html>
