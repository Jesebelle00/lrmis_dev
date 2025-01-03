<?php
    header('Content-Type: application/json');

    include "config.php";

    $query = 'SELECT id, type_name FROM type_name WHERE cat_id = 1';
    $result = $link->query($query);

    $print_types = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $print_types[] = [
                'id' => $row['id'],
                'type_name' => $row['type_name']
            ];
        }
    }
    echo json_encode($print_types);
    $link->close();
?>