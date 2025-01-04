<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Reservations";
    include_once "dashboard-header.php"; 
  ?>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />
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
          <!-- Button to trigger reservation modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">
            <i class="bi bi-plus-circle"></i> Add Reservation
          </button>
        </div>

        <div id="calendar"></div>
      </main>
    </div>
  </div>

  <!-- Reservation Modal -->
  <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-bg-primary">
          <h5 class="modal-title" id="reservationModalLabel">Add New Reservation</h5>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body">
        <form action="process-reservation.php" method="POST">
          <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="first_name" required>
          </div>
          <div class="mb-3">
            <label for="middleName" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middleName" name="middle_name">
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" required>
          </div>
          <div class="mb-3">
            <label for="nameSuffix" class="form-label">Suffix</label>
            <select class="form-control" id="nameSuffix" name="name_suffix">
              <option value=""></option>
              <option value="Jr.">Jr.</option>
              <option value="Sr.">Sr.</option>
              <option value="II">II</option>
              <option value="III">III</option>
              <option value="IV">IV</option>
              <option value="V">V</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="streetAddress" class="form-label">Street Address</label>
            <input type="text" class="form-control" id="streetAddress" name="street_address" required>
          </div>
          <div class="mb-3">
            <label for="barangay" class="form-label">Barangay</label>
            <input type="text" class="form-control" id="barangay" name="barangay">
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
          </div>
          <div class="mb-3">
            <label for="province" class="form-label">State/Province</label>
            <input type="text" class="form-control" id="province" name="province" required>
          </div>
          <div class="mb-3">
            <label for="postalCode" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="postalCode" name="postal_code">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Reservation</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  <?php include_once "dashboard-footer.php"; ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                {
                    title: 'Reservation 1',
                    start: '2024-12-25'
                },
                {
                    title: 'Reservation 2',
                    start: '2024-12-27',
                    end: '2024-12-28'
                }
            ],
            eventClick: function(event) {
                alert('Event: ' + event.title + '\nStart: ' + event.start.format());
            },
            editable: true,
            droppable: true
        });
    });
  </script>
</body>
</html>
