<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <?php 
    $pageTitle = "Map";
    include_once "dashboard-header.php"; 
  ?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <style>
    /* Make the map responsive and fill the container */
    #map {
      height: 500px;
      width: 100%;
    }
  </style>

  <style>
    .info.legend {
  background: white;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
  font-size: 14px;
  line-height: 18px;
  color: #333;
}

  </style>
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

        <!-- Map Section -->
        <div id="map"></div>

      </main>
    </div>
  </div>

  <?php include_once "dashboard-footer.php"; ?>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="https://unpkg.com/@turf/turf@6.5.0/turf.min.js"></script>

  <script>
  $(document).ready(function() {
    // Initialize the map at the specified coordinates
    const map = L.map('map').setView([14.871186, 120.977913], 19); // Initial view

    // Add the OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors',
      maxZoom: 20,
    }).addTo(map);

    // Grave dimensions (adjust as needed)
    const graveWidth = 0.000009; // Approx. 1 meter in longitude degrees (at equator)
    const graveHeight = 0.000018; // Approx. 2 meters in latitude degrees
    // const graveWidth = 0.0000045; // Approx. 1 meter in longitude degrees (at equator)
    // const graveHeight = 0.000009; // Approx. 2 meters in latitude degrees


    // Small spacing between graves (in degrees)
    const spacing = 0.000005;  // Adjust as needed

    // Function to create a column of graves
    function createGraveColumn(startLat, startLng, numGraves) {
      // Loop to create the graves in a column
      for (let i = 0; i < numGraves; i++) {
        const lat = startLat + (i * (graveHeight + spacing)); // Add spacing between graves
        const lng = startLng;

        // Define the bounds for each rectangle (grave)
        const bounds = [
          [lat - graveHeight / 2, lng - graveWidth / 2], // Bottom-left corner
          [lat + graveHeight / 2, lng + graveWidth / 2]  // Top-right corner
        ];

        // Add the rectangle for the grave to the map
        L.rectangle(bounds, {
          color: "#8B0000",   // Dark red color for graves
          weight: 2,
          fillColor: "#800000", // Fill color for graves
          fillOpacity: 0.5
        }).addTo(map);
      }
    }

    // Status options and their colors
    const statuses = {
      "Available": "#28a745",  // Green
      "Reserved": "#ffc107",   // Yellow
      "Sold": "#dc3545",       // Red
      "Sold and Occupied": "#6c757d" // Gray
    };

    // Function to get a random status
    function getRandomStatus() {
      const keys = Object.keys(statuses);
      return keys[Math.floor(Math.random() * keys.length)];
    }

    // Function to create a column of graves
    function createGraveColumn(startLat, startLng, numGraves) {
      // Loop to create the graves in a column
      for (let i = 0; i < numGraves; i++) {
        const lat = startLat + (i * (graveHeight + spacing)); // Add spacing between graves
        const lng = startLng;

        // Define the bounds for each rectangle (grave)
        const bounds = [
          [lat - graveHeight / 2, lng - graveWidth / 2], // Bottom-left corner
          [lat + graveHeight / 2, lng + graveWidth / 2]  // Top-right corner
        ];

        // Get a random status and its corresponding color
        const status = getRandomStatus();
        const color = statuses[status];

        // Add the rectangle for the grave to the map
        const grave = L.rectangle(bounds, {
          color: color,   // Border color based on status
          weight: 2,
          fillColor: color, // Fill color based on status
          fillOpacity: 0.5
        }).addTo(map);

        // Add a popup to show the status of the grave
        grave.bindPopup(`Status: ${status}`);
      }
    }

    // function createGraveColumn(startLat, startLng, numGraves, phaseId, columnId) {
    //   const graves = [];

    //   for (let i = 0; i < numGraves; i++) {
    //     const lat = startLat + (i * (graveHeight + spacing));
    //     const lng = startLng;

    //     const bounds = [
    //       [lat - graveHeight / 2, lng - graveWidth / 2],
    //       [lat + graveHeight / 2, lng + graveWidth / 2]
    //     ];

    //     const graveId = `P${phaseId}-C${columnId}G${i + 1}`;
    //     const status = getRandomStatus();

    //     graves.push({
    //       graveId: graveId,
    //       latitudeStart: bounds[0][0],
    //       longitudeStart: bounds[0][1],
    //       latitudeEnd: bounds[1][0],
    //       longitudeEnd: bounds[1][1],
    //       status: status
    //     });
    //   }

    //   // Send graves to the server
    //   $.ajax({
    //     url: 'insert_graves.php',
    //     method: 'POST',
    //     contentType: 'application/json',
    //     data: JSON.stringify(graves),
    //     success: function(response) {
    //       console.log(response);
    //     },
    //     error: function(err) {
    //       console.error('Error:', err);
    //     }
    //   });
    // }

    // Define the coordinates for the line (you can add more points here)
var lineCoords = [
    [14.8717651, 120.9774831],
    [14.8714008, 120.9774496], // You can add additional points here if needed
];

// Create and add the line (polyline) to the map
var polyline = L.polyline(lineCoords, { color: 'red' }).addTo(map);

    const columnSpacing = 0.0000135;

    // Phase 1 (Should contain approximately 446 graves)
    const startLat1 = 14.8715855;
    const startLng1 = 120.9770541;
    const numGraves1 = 6;
    createGraveColumn(startLat1, startLng1, numGraves1, 1, 1);

    const startLat2 = 14.8714285;
    const startLng2 = startLng1 + columnSpacing;
    const numGraves2 = 13;
    createGraveColumn(startLat2, startLng2, numGraves2, 1, 2);
   
    const startLat3 = 14.8714275;
    const startLng3 = startLng2 + columnSpacing;
    const numGraves3 = 13;
    createGraveColumn(startLat3, startLng3, numGraves3, 1, 3);

    const startLat4 = 14.8714235;
    const startLng4 = startLng3 + columnSpacing;
    const numGraves4 = 13;
    createGraveColumn(startLat4, startLng4, numGraves4, 1, 4);

    const startLat5 = 14.8714205;
    const startLng5 = startLng4 + columnSpacing;
    const numGraves5 = 14;
    createGraveColumn(startLat5, startLng5, numGraves5, 1, 5);

    const startLat6 = 14.8714155;
    const startLng6 = startLng5 + columnSpacing;
    const numGraves6 = 14;
    createGraveColumn(startLat6, startLng6, numGraves6, 1, 6);  

    const startLat7 = 14.8714155;
    const startLng7 = startLng6 + columnSpacing;
    const numGraves7 = 14;
    createGraveColumn(startLat7, startLng7, numGraves7, 1, 7);  

    const startLat8 = 14.8714155;
    const startLng8 = startLng7 + columnSpacing;
    const numGraves8 = 14;
    createGraveColumn(startLat8, startLng8, numGraves8, 1, 8);  

    const startLat9 = 14.8714090;
    const startLng9 = startLng8 + columnSpacing;
    const numGraves9 = 15;
    createGraveColumn(startLat9, startLng9, numGraves9, 1, 9);  

    const startLat10 = 14.8714090;
    const startLng10 = startLng9 + columnSpacing;
    const numGraves10 = 15;
    createGraveColumn(startLat10, startLng10, numGraves10, 1, 10);

    const startLat11 = 14.8714090;
    const startLng11 = startLng10 + columnSpacing;
    const numGraves11 = 15;
    createGraveColumn(startLat11, startLng11, numGraves11, 1, 11);

    const startLat12 = 14.8714120;
    const startLng12 = startLng11 + columnSpacing;
    const numGraves12 = 15;
    createGraveColumn(startLat12, startLng12, numGraves12, 1, 12);

    const startLat13 = 14.8714120;
    const startLng13 = startLng12 + columnSpacing;
    const numGraves13 = 15;
    createGraveColumn(startLat13, startLng13, numGraves13, 1, 13);

    const startLat14 = 14.8714100;
    const startLng14 = startLng13 + columnSpacing;
    const numGraves14 = 15;
    createGraveColumn(startLat14, startLng14, numGraves14, 1, 14);

    const startLat15 = 14.8714100;
    const startLng15 = startLng14 + columnSpacing;
    const numGraves15 = 15;
    createGraveColumn(startLat15, startLng15, numGraves15, 1, 15);

    const startLat16 = 14.8714100;
    const startLng16 = startLng15 + columnSpacing;
    const numGraves16 = 15;
    createGraveColumn(startLat16, startLng16, numGraves16, 1, 16);

    const startLat17 = 14.8714100;
    const startLng17 = startLng16 + columnSpacing;
    const numGraves17 = 15;
    createGraveColumn(startLat17, startLng17, numGraves17, 1, 17);

    const startLat18 = 14.8714100;
    const startLng18 = startLng17 + columnSpacing;
    const numGraves18 = 15;
    createGraveColumn(startLat18, startLng18, numGraves18, 1, 18);

    const startLat19 = 14.8714100;
    const startLng19 = startLng18 + columnSpacing;
    const numGraves19 = 15;
    createGraveColumn(startLat19, startLng19, numGraves19, 1, 19);

    const startLat20 = 14.8714100;
    const startLng20 = startLng19 + columnSpacing;
    const numGraves20 = 15;
    createGraveColumn(startLat20, startLng20, numGraves20, 1, 20);

    const startLat21 = 14.8714100;
    const startLng21 = startLng20 + columnSpacing;
    const numGraves21 = 15;
    createGraveColumn(startLat21, startLng21, numGraves21, 1, 21);

    const startLat22 = 14.8714100;
    const startLng22 = startLng21 + columnSpacing;
    const numGraves22 = 16;
    createGraveColumn(startLat22, startLng22, numGraves22, 1, 22);

    const startLat23 = 14.8714100;
    const startLng23 = startLng22 + columnSpacing;
    const numGraves23 = 16;
    createGraveColumn(startLat23, startLng23, numGraves23, 1, 23);

    const startLat24 = 14.8714100;
    const startLng24 = startLng23 + columnSpacing;
    const numGraves24 = 16;
    createGraveColumn(startLat24, startLng24, numGraves24, 1, 24);

    const startLat25 = 14.8714100;
    const startLng25 = startLng24 + columnSpacing;
    const numGraves25 = 16;
    createGraveColumn(startLat25, startLng25, numGraves25, 1, 25);

    const startLat26 = 14.8714100;
    const startLng26 = startLng25 + columnSpacing;
    const numGraves26 = 16;
    createGraveColumn(startLat26, startLng26, numGraves26, 1, 26);

    const startLat27 = 14.8714100;
    const startLng27 = startLng26 + columnSpacing;
    const numGraves27 = 16;
    createGraveColumn(startLat27, startLng27, numGraves27, 1, 27);

    const startLat28 = 14.8714100;
    const startLng28 = startLng27 + columnSpacing;
    const numGraves28 = 16;
    createGraveColumn(startLat28, startLng28, numGraves28, 1, 28);

    const startLat29 = 14.8714100;
    const startLng29 = startLng28 + columnSpacing;
    const numGraves29 = 16;
    createGraveColumn(startLat29, startLng29, numGraves29, 1, 29);

    const startLat30 = 14.8714100;
    const startLng30 = startLng29 + columnSpacing;
    const numGraves30 = 16;
    createGraveColumn(startLat30, startLng30, numGraves30, 1, 30);

    const startLat31 = 14.8715800;
    const startLng31 = startLng30 + columnSpacing;
    const numGraves31 = 9;
    createGraveColumn(startLat31, startLng31, numGraves31, 1, 31);

    // Phase 2 (Should contain approximately 462 graves)
    // const startLat31 = 14.8713950;
    // const startLng31 = startLng30 + columnSpacing + columnSpacing;
    // const numGraves31 = 18;
    // createGraveColumn(startLat31, startLng31, numGraves31, 2, 31);

    // const startLat32 = 14.8713950;
    // const startLng32 = startLng31 + columnSpacing;
    // const numGraves32 = 18;
    // createGraveColumn(startLat32, startLng32, numGraves32, 2, 32);

    // const startLat33 = 14.8713950;
    // const startLng33 = startLng32 + columnSpacing;
    // const numGraves33 = 18;
    // createGraveColumn(startLat33, startLng33, numGraves33, 2, 33);

    // const startLat34 = 14.8713950;
    // const startLng34 = startLng33 + columnSpacing;
    // const numGraves34 = 18;
    // createGraveColumn(startLat34, startLng34, numGraves34, 2, 34);

    // const startLat35 = 14.8713950;
    // const startLng35 = startLng34 + columnSpacing;
    // const numGraves35 = 18;
    // createGraveColumn(startLat35, startLng35, numGraves35, 2, 35);

    // const startLat36 = 14.8713810;
    // const startLng36 = startLng35 + columnSpacing;
    // const numGraves36 = 19;
    // createGraveColumn(startLat36, startLng36, numGraves36, 2, 36);

    // const startLat37 = 14.8713810;
    // const startLng37 = startLng36 + columnSpacing;
    // const numGraves37 = 19;
    // createGraveColumn(startLat37, startLng37, numGraves37, 2, 37);

    // const startLat38 = 14.8713810;
    // const startLng38 = startLng37 + columnSpacing;
    // const numGraves38 = 19;
    // createGraveColumn(startLat38, startLng38, numGraves38, 2, 38);

    // const startLat39 = 14.8713810;
    // const startLng39 = startLng38 + columnSpacing;
    // const numGraves39 = 19;
    // createGraveColumn(startLat39, startLng39, numGraves39, 2, 39);

    // const startLat40 = 14.8713810;
    // const startLng40 = startLng39 + columnSpacing;
    // const numGraves40 = 19;
    // createGraveColumn(startLat40, startLng40, numGraves40, 2, 40);

    // const startLat41 = 14.8713810;
    // const startLng41 = startLng40 + columnSpacing;
    // const numGraves41 = 19;
    // createGraveColumn(startLat41, startLng41, numGraves41, 2, 41);

    // const startLat42 = 14.8713710;
    // const startLng42 = startLng41 + columnSpacing;
    // const numGraves42 = 20;
    // createGraveColumn(startLat42, startLng42, numGraves42, 2, 42);

    // const startLat43 = 14.8713710;
    // const startLng43 = startLng42 + columnSpacing;
    // const numGraves43 = 20;
    // createGraveColumn(startLat43, startLng43, numGraves43, 2, 43);

    // const startLat44 = 14.8713710;
    // const startLng44 = startLng43 + columnSpacing;
    // const numGraves44 = 20;
    // createGraveColumn(startLat44, startLng44, numGraves44, 2, 44);

    // const startLat45 = 14.8713710;
    // const startLng45 = startLng44 + columnSpacing;
    // const numGraves45 = 20;
    // createGraveColumn(startLat45, startLng45, numGraves45, 2, 45);

    // const startLat46 = 14.8713710;
    // const startLng46 = startLng45 + columnSpacing;
    // const numGraves46 = 20;
    // createGraveColumn(startLat46, startLng46, numGraves46, 2, 46);

    // const startLat47 = 14.8713710;
    // const startLng47 = startLng46 + columnSpacing;
    // const numGraves47 = 20;
    // createGraveColumn(startLat47, startLng47, numGraves47, 2, 47);

    // const startLat48 = 14.8713610;
    // const startLng48 = startLng47 + columnSpacing;
    // const numGraves48 = 21;
    // createGraveColumn(startLat48, startLng48, numGraves48, 2, 48);

    // const startLat49 = 14.8713710;
    // const startLng49 = startLng48 + columnSpacing;
    // const numGraves49 = 21;
    // createGraveColumn(startLat49, startLng49, numGraves49, 2, 49);

    // const startLat50 = 14.8713810;
    // const startLng50 = startLng49 + columnSpacing;
    // const numGraves50 = 21;
    // createGraveColumn(startLat50, startLng50, numGraves50, 2, 50);

    // const startLat51 = 14.8713810;
    // const startLng51 = startLng50 + columnSpacing;
    // const numGraves51 = 21;
    // createGraveColumn(startLat51, startLng51, numGraves51, 2, 51);

    // Phase 2
    // const startLat16 = 14.8710658;
    // const startLng16 = 120.9770750;
    // const numGraves16 = 10;
    // createGraveColumn(startLat16, startLng16, numGraves16);

    // const startLat17 = 14.8710558;
    // const startLng17 = 120.9771210;
    // const numGraves17 = 10;
    // createGraveColumn(startLat17, startLng17, numGraves17);

    // const startLat18 = 14.8710458;
    // const startLng18 = 120.9771670;
    // const numGraves18 = 10;
    // createGraveColumn(startLat18, startLng18, numGraves18);

    // const startLat19 = 14.8710358;
    // const startLng19 = 120.9772130;
    // const numGraves19 = 10;
    // createGraveColumn(startLat19, startLng19, numGraves19);

    // const startLat20 = 14.8710058;
    // const startLng20 = 120.9772590;
    // const numGraves20 = 11;
    // createGraveColumn(startLat20, startLng20, numGraves20);

    // const startLat21 = 14.8709958;
    // const startLng21 = 120.9773050;
    // const numGraves21 = 11;
    // createGraveColumn(startLat21, startLng21, numGraves21);

    // const startLat22 = 14.8709758;
    // const startLng22 = 120.9773510;
    // const numGraves22 = 12;
    // createGraveColumn(startLat22, startLng22, numGraves22);

    // const startLat23 = 14.8709658;
    // const startLng23 = 120.9773970;
    // const numGraves23 = 12;
    // createGraveColumn(startLat23, startLng23, numGraves23);

    // const startLat24 = 14.8709558;
    // const startLng24 = 120.9774430;
    // const numGraves24 = 12;
    // createGraveColumn(startLat24, startLng24, numGraves24);

    // const startLat25 = 14.8709358;
    // const startLng25 = 120.9774890;
    // const numGraves25 = 13;
    // createGraveColumn(startLat25, startLng25, numGraves25);

    // const startLat26 = 14.8709158;
    // const startLng26 = 120.9775350;
    // const numGraves26 = 14;
    // createGraveColumn(startLat26, startLng26, numGraves26);

    // const startLat27 = 14.8709058;
    // const startLng27 = 120.9775810;
    // const numGraves27 = 14;
    // createGraveColumn(startLat27, startLng27, numGraves27);

    // const startLat28 = 14.8708858;
    // const startLng28 = 120.9776270;
    // const numGraves28 = 15;
    // createGraveColumn(startLat28, startLng28, numGraves28);

    // const startLat29 = 14.8708758;
    // const startLng29 = 120.9776730;
    // const numGraves29 = 15;
    // createGraveColumn(startLat29, startLng29, numGraves29);

    // const startLat30 = 14.8708558;
    // const startLng30 = 120.9777190;
    // const numGraves30 = 15;
    // createGraveColumn(startLat30, startLng30, numGraves30);

    // const startLat31 = 14.8708458;
    // const startLng31 = 120.9777650;
    // const numGraves31 = 14;
    // createGraveColumn(startLat31, startLng31, numGraves31);

    // Phase 3
    // const startLat32 = 14.8708058;
    // const startLng32 = 120.9778450;
    // const numGraves32 = 16;
    // createGraveColumn(startLat32, startLng32, numGraves32);

    // const startLat33 = 14.8707958;
    // const startLng33 = 120.9778910;
    // const numGraves33 = 17;
    // createGraveColumn(startLat33, startLng33, numGraves33);

    // const startLat34 = 14.8707758;
    // const startLng34 = 120.9779370;
    // const numGraves34 = 19;
    // createGraveColumn(startLat34, startLng34, numGraves34);

    // const startLat35 = 14.8707458;
    // const startLng35 = 120.9779830;
    // const numGraves35 = 20;
    // createGraveColumn(startLat35, startLng35, numGraves35);

    // const startLat36 = 14.8707158;
    // const startLng36 = 120.9780290;
    // const numGraves36 = 21;
    // createGraveColumn(startLat36, startLng36, numGraves36);

    // const startLat37 = 14.8706858;
    // const startLng37 = 120.9780750;
    // const numGraves37 = 22;
    // createGraveColumn(startLat37, startLng37, numGraves37);

    // const startLat38 = 14.8706558;
    // const startLng38 = 120.9781210;
    // const numGraves38 = 23;
    // createGraveColumn(startLat38, startLng38, numGraves38);

    // const startLat39 = 14.8706258;
    // const startLng39 = 120.9781670;
    // const numGraves39 = 19;
    // createGraveColumn(startLat39, startLng39, numGraves39);

    // const startLat40 = 14.8705958;
    // const startLng40 = 120.9782130;
    // const numGraves40 = 14;
    // createGraveColumn(startLat40, startLng40, numGraves40);

    // const startLat41 = 14.8705658;
    // const startLng41 = 120.9782590;
    // const numGraves41 = 7;
    // createGraveColumn(startLat41, startLng41, numGraves41);

    // // Phase 4
    // const startLat42 = 14.8713973;
    // const startLng42 = 120.9778424;
    // const numGraves42 = 19;
    // createGraveColumn(startLat42, startLng42, numGraves42);

    // const startLat43 = 14.8713773;
    // const startLng43 = 120.9778884;
    // const numGraves43 = 20;
    // createGraveColumn(startLat43, startLng43, numGraves43);

    // const startLat44 = 14.8713073;
    // const startLng44 = 120.9779344;
    // const numGraves44 = 22;
    // createGraveColumn(startLat44, startLng44, numGraves44);

    // const startLat45 = 14.8712873;
    // const startLng45 = 120.9779804;
    // const numGraves45 = 21;
    // createGraveColumn(startLat45, startLng45, numGraves45);

    // const startLat46 = 14.8712873;
    // const startLng46 = 120.9780264;
    // const numGraves46 = 15;
    // createGraveColumn(startLat46, startLng46, numGraves46);

    // const startLat47 = 14.8712873;
    // const startLng47 = 120.9780724;
    // const numGraves47 = 8;
    // createGraveColumn(startLat47, startLng47, numGraves47);





    // Add legend to the map
const legend = L.control({ position: "bottomright" });

legend.onAdd = function () {
  const div = L.DomUtil.create("div", "info legend");

  // Status options and colors
  const statuses = {
    "Available": "#28a745", // Green
    "Reserved": "#ffc107",  // Yellow
    "Sold": "#dc3545",      // Red
    "Sold and Occupied": "#6c757d" // Gray
  };

  // Create legend content
  div.innerHTML = "<h4>Grave Status</h4>";
  for (const status in statuses) {
    div.innerHTML +=
      `<i style="background:${statuses[status]}; width: 18px; height: 18px; display: inline-block; margin-right: 5px;"></i>` +
      `${status}<br>`;
  }

  return div;
};

legend.addTo(map);
  });
</script>


</body>
</html>
