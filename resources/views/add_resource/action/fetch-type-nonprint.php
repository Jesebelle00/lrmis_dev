<?php
    header('Content-Type: application/json');

    include "config.php";

    $query = 'SELECT id, type_name FROM type_name WHERE cat_id = 2';
    $result = $link->query($query);

    $non_print_types = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $non_print_types[] = [
                'id' => $row['id'],
                'type_name' => $row['type_name']
            ];
        }
    }
    echo json_encode($non_print_types);
    $link->close();
?>

