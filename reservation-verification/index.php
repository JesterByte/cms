<?php 
session_start();
require_once "../utils/helpers.php";
require_once "../content/reservation-verification.php";

if (!isset($_SESSION["user_id"])) {
    serverRedirect("../");
}

$graveId = isset($_GET['grave_id']) ? decodeUrlParameter($_GET['grave_id']) : null;

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "Reservation Verification";
      include_once "../components/head.php";   
    ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

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
            <h1 class="h2">
                <?= $pageTitle ?>
            </h1>
          </div>

          <div class="row">
            <div class="col d-flex justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../reservation-requests">Reservation Requests</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $pageTitle; ?></li>
                    </ol>
                </nav>
            </div>
          </div>

          <div class="row shadow rounded py-3">
            <!-- Map Section -->
            <div class="col-md-8">
              <div class="card h-100">
                <div class="card-header bg-primary text-white">
                  <h5 class="card-title mb-0">Grave Location</h5>
                </div>
                <div class="card-body">
                  <div id="map" class="rounded border" style="min-height: 500px;">
                    <p class="text-muted text-center mt-5">Loading map...</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Form Section -->
            <div class="col-md-4">
              <div class="card h-100">
                <div class="card-header bg-secondary text-white">
                  <h5 class="card-title mb-0">Verify Reservation</h5>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate id="verifyForm" method="post" action="../process/process-verify-reservation.php">
                    <input type="hidden" name="grave_id" value="<?= htmlspecialchars($graveId) ?>">

                    <!-- Lot Type -->
                    <div class="mb-3">
                      <label for="lotType" class="form-label">Lot Type <span class="text-danger">*</span></label>
                      <select class="form-select" id="lotType" name="lot_type" required>
                        <option value="Supreme">Supreme</option>
                        <option value="Special">Special</option>
                        <option value="Standard">Standard</option>
                      </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                      <button type="button" data-bs-toggle="modal" data-bs-target="#reservationVerificationModal" class="btn btn-primary">Submit</button>
                      <a href="../reservation-requests" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>

                  <!-- Informational Message -->
                  <div class="mt-3 alert alert-info" role="alert">
                    <strong>Important:</strong> Once you submit the verification, the customer who requested this reservation will be notified about the identified lot's pricing. Please ensure that all details are correct before proceeding.
                  </div>
                </div>
              </div>
            </div>
          </div>

        </main>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/modal-autofocus.js"></script>
    <script src="../assets/js/form-validation.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([14.871318, 120.976566], 18); // Use your latitude and longitude

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
          maxZoom: 20
        }).addTo(map);

        const latitudeStart = <?= json_encode($reservationCoordinates["latitude_start"]); ?>;
        const latitudeEnd = <?= json_encode($reservationCoordinates["latitude_end"]); ?>;
        const longitudeStart = <?= json_encode($reservationCoordinates["longitude_start"]); ?>;
        const longitudeEnd = <?= json_encode($reservationCoordinates["longitude_end"]); ?>;

        if (latitudeStart && longitudeStart && latitudeEnd && longitudeEnd) {
          var bounds = [[latitudeStart, longitudeStart], [latitudeEnd, longitudeEnd]];
          L.rectangle(bounds, { color: 'blue', weight: 1 }).addTo(map);
          map.fitBounds(bounds);
        } else {
          console.error('Invalid grave coordinates');
        }
      });
    </script>

    <?php 
      include_once "../components/modals/modal-sign-out.html"; 
      include_once "../components/modals/modal-confirm-reservation-verification.html";
    ?>

  </body>
</html>