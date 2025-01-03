<?php
    session_start();
    require_once 'config.php';

    $response = [
        'success' => false,
        'message' => 'Failed to update contact information. Please try again.'
    ];

    try {
        if (!isset($_SESSION['profile_id'])) {
            throw new Exception('User not logged in.');
        }

        if (empty($_POST['email'])) {
            throw new Exception('Email is required.');
        }

        $userId = $_SESSION['profile_id'];
        $anyChangesMade = false; 
        $contacts = [
            'email' => [
                'value' => $_POST['email'],
                'id' => $_POST['email_id'] ?? null,
                'type_id' => 1
            ],
            'fax' => [
                'value' => $_POST['fax'] ?? '',
                'id' => $_POST['fax_id'] ?? null,
                'type_id' => 2
            ],
            'instant_messaging' => [
                'value' => $_POST['instant_messaging'] ?? '',
                'id' => $_POST['instant_messaging_id'] ?? null,
                'type_id' => 3
            ],
            'mobile_number' => [
                'value' => $_POST['mobile_number'] ?? '',
                'id' => $_POST['mobile_number_id'] ?? null,
                'type_id' => 4
            ],
            'phone' => [
                'value' => $_POST['phone'] ?? '',
                'id' => $_POST['phone_id'] ?? null,
                'type_id' => 5
            ],
            'social_media' => [
                'value' => $_POST['social_media'] ?? '',
                'id' => $_POST['social_media_id'] ?? null,
                'type_id' => 6
            ]
        ];

        $link->begin_transaction();

        foreach ($contacts as $key => $contact) {
            if ($key === 'email' || isset($contact['id'])) {
                if (empty($contact['id'])) {
                    // Insert new record
                    $stmt = $link->prepare("INSERT INTO contact_detail (contacttype_id, value, profile_id) VALUES (?, ?, ?)");
                    if (!$stmt) {
                        throw new Exception('Failed to prepare insert statement: ' . $link->error);
                    }
                    $stmt->bind_param("isi", $contact['type_id'], $contact['value'], $userId);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        $anyChangesMade = true;
                    }
                } else {
                    // Update existing record, allow empty value
                    $stmt = $link->prepare("UPDATE contact_detail SET value = ? WHERE profile_id = ? AND id = ?");
                    if (!$stmt) {
                        throw new Exception('Failed to prepare update statement: ' . $link->error);
                    }
                    $stmt->bind_param("sii", $contact['value'], $userId, $contact['id']);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        $anyChangesMade = true;
                    }
                }
                $stmt->close();
            }
        }

        $link->commit();

        $response['success'] = true;
        if ($anyChangesMade) {
            $response['message'] = 'Contact information updated successfully.';
        } else {
            $response['message'] = 'No changes were made to the contact information.';
        }

    } catch (Exception $e) {
        $link->rollback();
        $response['message'] = 'Error: ' . $e->getMessage();
    } finally {
        echo json_encode($response);
    }
?>
