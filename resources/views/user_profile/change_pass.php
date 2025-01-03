<?php
session_start();
require_once 'config.php';

$response = [
    'success' => false,
    'message' => 'Password change failed. Please try again.'
];

try {
    if (!isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        throw new Exception('Invalid input.');
    }

    if (!isset($_SESSION['profile_id'])) {
        throw new Exception('User not logged in.');
    }

    $userId = $_SESSION['profile_id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        throw new Exception('New passwords do not match.');
    }

    $link->begin_transaction();

    $stmt = $link->prepare("SELECT password FROM user WHERE profile_id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare statement for password fetch: ' . $link->error);
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($hashedCurrentPassword);
    $stmt->fetch();
    $stmt->close();

    if (!$hashedCurrentPassword || !password_verify($currentPassword, $hashedCurrentPassword)) {
        throw new Exception('Current password is incorrect.');
    }

    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $link->prepare("UPDATE user SET password = ? WHERE profile_id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare statement for password update: ' . $link->error);
    }

    $stmt->bind_param("si", $newHashedPassword, $userId);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        throw new Exception('Password update failed.');
    }

    $link->commit();

    $response['success'] = true;
    $response['message'] = 'Password changed successfully.';
} catch (Exception $e) {
    $link->rollback();
    $response['message'] = 'Error: ' . $e->getMessage();
} finally {
    echo json_encode($response);
}
?>
