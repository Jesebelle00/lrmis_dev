<?php
include 'config.php';

$sql = "SELECT id, name FROM status";

$result = $link->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row['id'],
            'name' => $row['name']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>
