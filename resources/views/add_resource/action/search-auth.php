<?php
include 'config.php';

$term = $_GET['term'] ?? '';
$term = trim($term);

if (!empty($term)) {
    $stmt = $link->prepare("SELECT id, name FROM author WHERE name LIKE ? LIMIT 10");
    $searchTerm = "%{$term}%";
    $stmt->bind_param("s", $searchTerm);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="auth-suggestion-item" data-id="' . $row['id'] . '">' . $row['name'] . '</div>';
            }
        } else {
            echo '<p class="no-results">No results found. Add the author first.</p>';
        }
    } else {
        error_log("Database error: " . $stmt->error);
        echo '<p class="error-message">Unable to fetch authors. Please try again later.</p>';
    }

    $stmt->close();
} else {
    echo '<p class="error-message">Please enter a valid search term.</p>';
}

$link->close();
?>
