<?php
include 'config.php';

$term = $_GET['term'] ?? '';
$term = $link->real_escape_string($term);

$sql = "
    SELECT 
        lr.id, 
        lr.type_id, 
        lr.title_id, 
        ti.id AS title_id, 
        ti.name 
    FROM 
        lr 
    JOIN 
        title ti 
    ON 
        lr.title_id = ti.id 
    WHERE 
        lr.type_id = 1 
        AND ti.name LIKE '%$term%'
    LIMIT 10;
";

$result = $link->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="suggestion-item" data-id="' . $row['title_id'] . '">' . $row['name'] . '</div>';
        }
    } else {
        echo '<p>No results found. Add the title first.</p>';
    }
} else {
    error_log("SQL Error: " . $link->error);
    echo '<p>Unable to process your request. Please try again later.</p>';
}

$link->close();
?>
