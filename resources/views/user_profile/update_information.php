<?php
session_start();
require_once 'config.php';

$response = [
    'success' => false,
    'message' => 'Failed to update profile information. Please try again.'
];

try {
    if (!isset($_SESSION['profile_id'])) {
        throw new Exception('User not logged in.');
    }

    if (!isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['tin'])) {
        throw new Exception('Invalid input.');
    }

    $userId = $_SESSION['profile_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $tin = $_POST['tin'];

    $link->begin_transaction();

    // Update profile table
    $stmt = $link->prepare("UPDATE profile SET first_name = ?, last_name = ?, tin = ? WHERE id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare statement for profile update: ' . $link->error);
    }
    $stmt->bind_param("sssi", $firstName, $lastName, $tin, $userId);
    $stmt->execute();
    $profileAffectedRows = $stmt->affected_rows;
    $stmt->close();

    // Update user table
    $stmt = $link->prepare("UPDATE user SET name = ? WHERE profile_id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare statement for user update: ' . $link->error);
    }
    $stmt->bind_param("si", $username, $userId);
    $stmt->execute();
    $userAffectedRows = $stmt->affected_rows;
    $stmt->close();

    // Check if any rows were affected
    if ($profileAffectedRows === 0 && $userAffectedRows === 0) {
        throw new Exception('No changes were made.');
    }

    $link->commit();

    $response['success'] = true;
    $response['message'] = 'Profile information updated successfully.';
} catch (Exception $e) {
    $link->rollback();
    $response['message'] = $e->getMessage();
} finally {
    echo json_encode($response);
}
?>
