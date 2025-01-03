<?php
    include 'config.php';

    $sql = "
    SELECT 
        sg.id AS subjectgradelevel_id, 
        s.title AS subject_title, 
        g.shortcode AS gradelevel_shortcode
    FROM 
        subject_grade_level sg
    JOIN 
        subject s ON sg.subject_id = s.id
    JOIN 
        grade_level g ON sg.gradelevel_id = g.id
    ";

    $result = $link->query($sql);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'id' => $row['subjectgradelevel_id'],
                'title' => $row['subject_title'],
                'shortcode' => $row['gradelevel_shortcode']
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>
