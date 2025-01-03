<?php

include 'config.php';

session_start();

$encoder_id = $_SESSION['profile_id'];
$station_id = $_SESSION['station_id'];

$query1 = "SELECT id, name FROM library WHERE station_id = ?";
$stmt1 = $link->prepare($query1);

if (!$stmt1) {
    die("Error preparing query: " . $link->error);
}

$stmt1->bind_param("i", $station_id);

if (!$stmt1->execute()) {
    die("Error executing query: " . $stmt1->error);
}

$stmt1->bind_result($library_id, $library_name);
$stmt1->fetch();
$stmt1->close();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}

$search = isset($_POST['search-nonprint']) ? trim($_POST['search-nonprint']) : '';
$selectedId = isset($_POST['selected-id-nonprint']) ? trim($_POST['selected-id-nonprint']) : '';
$qty = isset($_POST['qty']) ? trim($_POST['qty']) : '';
$subjects = isset($_POST['subject-nonprint']) ? $_POST['subject-nonprint'] : [];
$status = isset($_POST['status-nonprint']) ? trim($_POST['status-nonprint']) : '';
$type = isset($_POST['non-print_type']) ? trim($_POST['non-print_type']) : '';
$source = isset($_POST['np_source']) ? trim($_POST['np_source']) : '';
$authorID = isset($_POST['authorIDsNonprint']) ? $_POST['authorIDsNonprint'] : [];
$brand = isset($_POST['brand']) ? trim($_POST['brand']) : '';
$brandID = isset($_POST['brand-selected-id']) ? trim($_POST['brand-selected-id']) : '';
$code = isset($_POST['code']) ? trim($_POST['code']) : '';
$size = isset($_POST['size']) ? trim($_POST['size']) : '';
$url = isset($_POST['link']) ? trim($_POST['link']) : '';
$dateAcquired = isset($_POST['acqrd']) ? trim($_POST['acqrd']) : '';
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : '';

// Validation
if (empty($selectedId) || empty($search) || empty($qty) || empty($subjects) || empty($status) || empty($type) || empty($source) || empty($authorID) || empty($dateAcquired)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all required inputs.']);
    exit();
}

$response = [
    'status' => 'success',
    'message' => 'Non-Print Added Successfully!',
    'inputs' => [
        'Encoder' => $encoder_id,
        'library_id' => $library_id,
        'search' => $search,
        'selectedId' => $selectedId,
        'qty' => $qty,
        'subjects' => $subjects,
        'status' => $status,
        'type' => $type,
        'source' => $source,
        'authorID' => $authorID,
        'brand' => $brand,
        'brandID' => $brandID,
        'code' => $code,
        'size' => $size,
        'url' => $url,
        'dateAcquired' => $dateAcquired,
        'remarks' => $remarks
    ]
];

echo json_encode($response);

    $link->close();
?>
