<?php
session_start();
include '../config.php';

$current_station_id = $_SESSION['station_id'] ?? null;

// Fetch the current station type
$query = "SELECT stationtype_id FROM station WHERE id = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("i", $current_station_id);
$stmt->execute();
$stmt->bind_result($current_station_type_id);

if (!$stmt->fetch()) {
    die("Error: No station found with the given ID.");
}
$stmt->close();

// Define the hierarchy
$station_hierarchy = [
    1 => ['name' => 'Region', 'next_id' => 2],   // Central Office -> Region
    2 => ['name' => 'Division', 'next_id' => 3], // Region -> Division
    3 => ['name' => 'District', 'next_id' => 4], // Division -> District
    4 => ['name' => 'School', 'next_id' => 5],   // District -> School
    5 => ['name' => 'School', 'next_id' => null] // School -> No further additions
];

// Validate station type
if (!array_key_exists($current_station_type_id, $station_hierarchy)) {
    die("Invalid station type or permission denied.");
}

// Determine the station type to add
$next_station_type_id = $station_hierarchy[$current_station_type_id]['next_id'];
if (is_null($next_station_type_id)) {
    $form_title = "Cannot Add New Station";
    $disable_form = true;
} else {
    $form_title = "Add " . $station_hierarchy[$current_station_type_id]['name'];
    $disable_form = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4"><?php echo htmlspecialchars($form_title); ?></h1>
    
    <?php if ($disable_form): ?>
        <div class="alert alert-warning">You cannot add new stations.</div>
    <?php else: ?>
        <div class="alert-container"></div> <!-- For dynamic success/error messages -->
        <form id="add-station-form">
            <div class="mb-3">
                <label for="station_name" class="form-label">Station Name</label>
                <input type="text" class="form-control" id="station_name" name="station_name" placeholder="Enter station name" required>
            </div>
            <div class="mb-3">
                <label for="geoloc" class="form-label">Geolocation (Optional)</label>
                <input type="text" class="form-control" id="geoloc" name="geoloc" placeholder="Enter geolocation">
            </div>
            <button type="submit" class="btn btn-primary">Add Station</button>
        </form>
    <?php endif; ?>
</div>
<script>
    $(document).ready(function () {
        $("#add-station-form").on("submit", function (e) {
            e.preventDefault(); // Prevent form submission

            const formData = {
                station_name: $("#station_name").val().trim(),
                geoloc: $("#geoloc").val().trim(),
            };

            $.ajax({
                url: "add-station-action.php",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        // Display success message
                        $(".alert-container").html(
                            `<div class="alert alert-success">${response.message}</div>`
                        );
                        $("#add-station-form")[0].reset();
                    } else {
                        // Display error message
                        $(".alert-container").html(
                            `<div class="alert alert-danger">${response.message}</div>`
                        );
                    }
                },
                error: function (xhr, status, error) {
                    $(".alert-container").html(
                        `<div class="alert alert-danger">An error occurred: ${error}</div>`
                    );
                },
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
