<?php
    include 'config.php';

    $term = $_GET['term'];
    $term = $link->real_escape_string($term);

    $sql = "SELECT id, name FROM publisher WHERE name LIKE '%$term%' LIMIT 10";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="pub-suggestion-item" data-id="' . $row['id'] . '">' . $row['name'] . '</div>';
        }
    } else {
        echo '<p style="color:red;">No results found. Add the publisher first.</p>';
    }

    $link->close();
?>