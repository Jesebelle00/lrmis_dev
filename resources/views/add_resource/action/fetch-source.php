<?php
    header('Content-Type: application/json');

    include "config.php";

    $query = 'SELECT id, name FROM source';
    $result = $link->query($query);

    $print_sources = [];

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $print_sources[] = [
                    'id' => $row['id'],
                    'name' => $row['name']
                ];
            }
        }
    } else {
        echo json_encode(['error' => 'Query failed: ' . $link->error]);
        exit;
    }

    echo json_encode($print_sources);

    $link->close();
?>
