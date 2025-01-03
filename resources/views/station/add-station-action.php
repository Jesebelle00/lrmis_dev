<?php
session_start();
include '../config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $station_name = trim($_POST['station_name'] ?? '');
        $geoloc = trim($_POST['geoloc'] ?? '');
        $encoded_by =$_SESSION['usertype_id'] ?? null;
        $current_station_id = $_SESSION['station_id'] ?? null;

        if (!$encoded_by || !$current_station_id) {
            throw new Exception("User not authenticated or station not set.");
        }

        if (empty($station_name)) {
            throw new Exception("Station name is required.");
        }

        // Query station type
        $query = "SELECT stationtype_id FROM station WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("i", $current_station_id);
        $stmt->execute();
        $stmt->bind_result($current_station_type_id);
        if (!$stmt->fetch()) {
            throw new Exception("Station not found.");
        }
        $stmt->close();

        // Check hierarchy
        $station_hierarchy = [
            1 => ['name' => 'Region', 'next_id' => 2],
            2 => ['name' => 'Division', 'next_id' => 3],
            3 => ['name' => 'District', 'next_id' => 4],
            4 => ['name' => 'School', 'next_id' => 5],
            5 => ['name' => 'School', 'next_id' => null]
        ];

        if (!isset($station_hierarchy[$current_station_type_id])) {
            throw new Exception("Invalid station type or permission denied.");
        }

        $next_station_type_id = $station_hierarchy[$current_station_type_id]['next_id'];
        if (is_null($next_station_type_id)) {
            throw new Exception("This station type cannot add new stations.");
        }

        // Insert station
        $link->begin_transaction();
        $query_station = "INSERT INTO station (stationtype_id, parent_station, geoloc, date_update, encoded_by) VALUES (?, ?, ?, NOW(), ?)";
        $stmt_station = $link->prepare($query_station);
        $stmt_station->bind_param("iisi", $next_station_type_id, $current_station_id, $geoloc, $encoded_by);

        if (!$stmt_station->execute()) {
            throw new Exception($stmt_station->error);
        }

        $new_station_id = $stmt_station->insert_id;

        $query_station_name = "INSERT INTO station_name (station_id, station_name) VALUES (?, ?)";
        $stmt_station_name = $link->prepare($query_station_name);
        $stmt_station_name->bind_param("is", $new_station_id, $station_name);

        if (!$stmt_station_name->execute()) {
            throw new Exception($stmt_station_name->error);
        }

        $link->commit();
        echo json_encode(['status' => 'success', 'message' => "Successfully added a new {$station_hierarchy[$current_station_type_id]['name']}!"]);
        exit;
    } catch (Exception $e) {
        $link->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    } finally {
        $stmt_station->close();
        $stmt_station_name->close();
        $link->close();
    }
}
?>
