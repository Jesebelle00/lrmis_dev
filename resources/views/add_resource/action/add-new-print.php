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

$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$selectedId = isset($_POST['selected-id']) ? trim($_POST['selected-id']) : '';
$qty = isset($_POST['qty']) ? trim($_POST['qty']) : '';
$subjects = isset($_POST['subject']) ? $_POST['subject'] : [];
$status = isset($_POST['status']) ? trim($_POST['status']) : '';
$type = isset($_POST['print_type']) ? trim($_POST['print_type']) : '';
$source = isset($_POST['print_source']) ? trim($_POST['print_source']) : '';
$authorID = isset($_POST['authorIDs']) ? $_POST['authorIDs'] : [];
$publisher = isset($_POST['publisher']) ? trim($_POST['publisher']) : '';
$publisherID = isset($_POST['pub-selected-id']) ? trim($_POST['pub-selected-id']) : '';
$volume = isset($_POST['volume']) ? trim($_POST['volume']) : '';
$copyright = isset($_POST['copyright']) ? trim($_POST['copyright']) : '';
$pages = isset($_POST['pages']) ? trim($_POST['pages']) : '';
$dateAcquired = isset($_POST['acqrd']) ? trim($_POST['acqrd']) : '';
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : '';

// Validation
if (empty($selectedId) || empty($search) ||  empty($qty) || empty($subjects) || empty($status) || empty($type) || empty($source) || empty($authorID) || empty($dateAcquired)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all required inputs.']);
    exit();
}

$response = [
    'status' => 'success',
    'message' => 'Print Added Successfully!',
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
        'publisher' => $publisher,
        'publisherID' => $publisherID,
        'volume' => $volume,
        'copyright' => $copyright,
        'pages' => $pages,
        'dateAcquired' => $dateAcquired,
        'remarks' => $remarks
    ]
];

echo json_encode($response);

    // // Generate a GUID
    // function generateGUID() {
    //     return strtoupper(bin2hex(random_bytes(16)));
    // }

    // // Function to check if a GUID exists in a specific table
    // function checkIfIDExists($link, $table, $column, $id) {
    //     $stmt = $link->prepare("SELECT COUNT(*) as count FROM $table WHERE $column = ?");
    //     $stmt->bind_param("s", $id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $row = $result->fetch_assoc();
    //     $stmt->close();

    //     return $row['count'] > 0;
    // }

    // // Generate unique GUIDs for all necessary tables
    // function getUniqueGUID($link, $table, $column) {
    //     do {
    //         $guid = generateGUID();
    //     } while (checkIfIDExists($link, $table, $column, $guid));
    //     return $guid;
    // }

    // // Generate GUIDs
    // $lrID = getUniqueGUID($link, 'lr', 'id');
    // $acquisitionID = getUniqueGUID($link, 'acquisition', 'id');
    // $lrPrintID = getUniqueGUID($link, 'lr_print', 'id');

    // // Begin transaction
    // $link->begin_transaction();

    // try {
    //     // Insert into lr
    //     $stmt = $link->prepare("INSERT INTO lr (id, type_id, title_id, date_upload, encoder_id) VALUES (?, ?, ?, NOW(), ?)");
    //     $stmt->bind_param("ssss", $lrID, $type, $search, $encoder_id);
    //     $stmt->execute();
    //     $stmt->close();

    //     // Insert into lr_print
    //     $stmt = $link->prepare("INSERT INTO lr_print (id, lr_id, publisher, volume, copyrightyear, pages, date_update, updated_by) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");
    //     $stmt->bind_param("sssssss", $lrPrintID, $lrID, $publisher, $volume, $copyright, $pages, $encoder_id);
    //     $stmt->execute();
    //     $stmt->close();

    //     // Insert into acquisition
    //     $stmt = $link->prepare("INSERT INTO acquisition (id, library_id, lr_id, src_id, date_acquired, qty, cost, date_encoded, status_id) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    //     $stmt->bind_param("ssssssss", $acquisitionID, $libraryID, $lrID, $source, $dateAcquired, $qty, $cost, $status);
    //     $stmt->execute();
    //     $stmt->close();

    //     // Insert into masterlist (loop based on quantity)
    //     $stmt = $link->prepare("INSERT INTO masterlist (id, acquisition_id, accession, encoder_id, remarks) VALUES (?, ?, ?, ?, ?)");
    //     for ($i = 0; $i < $qty; $i++) {
    //         $masterlistID = getUniqueGUID($link, 'masterlist', 'id'); 
    //         $accession = ''; // Empty for now
    //         $stmt->bind_param("sssss", $masterlistID, $acquisitionID, $accession, $encoder_id, $remarks);
    //         $stmt->execute();
    //     }
    //     $stmt->close();

    //     // Insert into lr_subject_grade_level (loop for each subject)
    //     $stmt = $link->prepare("INSERT INTO lr_subject_grade_level (id, lr_id, subjectgradelevel_id) VALUES (?, ?, ?)");
    //     foreach ($subjects as $subjectID) {
    //         $subjectGradeLevelID = getUniqueGUID($link, 'lr_subject_grade_level', 'id'); 
    //         $stmt->bind_param("sss", $subjectGradeLevelID, $lrID, $subjectID);
    //         $stmt->execute();
    //     }
    //     $stmt->close();

    //     // Commit transaction
    //     $link->commit();

    //     echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully.']);
    // } catch (Exception $e) {
    //     $link->rollback();
    //     echo json_encode(['status' => 'error', 'message' => 'Transaction failed: ' . $e->getMessage()]);
    // }

    $link->close();
?>
