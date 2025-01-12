<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grave Routing to Nearest Path</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf"></script>
    <style>
        #map {
            height: 100vh;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        // Initialize the map
        const map = L.map('map').setView([14.5995, 120.9842], 18); // Adjust to your cemetery's location

        // Add OSM tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Define a square path (forming a closed loop)
        const squarePath = turf.lineString([
            [120.9835, 14.5995],
            [120.9835, 14.6000],
            [120.9840, 14.6000],
            [120.9840, 14.5995],
            [120.9835, 14.5995] // Closing the loop
        ]);

        // Sample grave lots inside the square
        const graveLots = [
            { id: 1, coordinates: [120.9836, 14.5996] },
            { id: 2, coordinates: [120.9837, 14.5997] },
            { id: 3, coordinates: [120.9838, 14.5998] },
            { id: 4, coordinates: [120.9839, 14.5999] }
        ];

        // Draw the square path on the map
        L.polyline(squarePath.geometry.coordinates.map(([lon, lat]) => [lat, lon]), {
            color: 'blue',
            weight: 3
        }).addTo(map);

        // Function to classify and determine distance for each grave lot
        graveLots.forEach((lot) => {
            const lotPoint = turf.point(lot.coordinates);
            const snapped = turf.nearestPointOnLine(squarePath, lotPoint);
            const distance = snapped.properties.dist; // Distance in meters

            // Determine color based on distance
            let color;
            if (distance <= 0.011) {
                color = 'gold';
            } else if (distance > 0.011 && distance <= 0.03) {
                color = 'green';
            } else {
                color = 'gray';
            }

            // Draw the rectangle for the grave lot
            L.rectangle([
                [lot.coordinates[1] - 0.00001, lot.coordinates[0] - 0.00001],
                [lot.coordinates[1] + 0.00001, lot.coordinates[0] + 0.00001]
            ], {
                color: color,
                fillColor: color,
                fillOpacity: 0.7
            }).addTo(map);

            // Draw a line from the grave lot to the nearest path point
            L.polyline([
                [lot.coordinates[1], lot.coordinates[0]], // Grave lot
                [snapped.geometry.coordinates[1], snapped.geometry.coordinates[0]] // Nearest path point
            ], {
                color: 'red',
                dashArray: '5, 5'
            }).addTo(map);

            // Add a popup to show distance and classification
            L.circleMarker([lot.coordinates[1], lot.coordinates[0]], {
                radius: 5,
                color: 'black',
                fillColor: color,
                fillOpacity: 1
            }).bindPopup(`Lot ID: ${lot.id}<br>Distance: ${distance.toFixed(2)} meters<br>Classification: ${color === 'gold' ? 'Supreme' : color === 'green' ? 'Special' : 'Standard'}`).addTo(map);
        });
    </script>
</body>
</html>
