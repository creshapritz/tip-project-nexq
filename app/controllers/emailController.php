<?php
session_start();

require_once '../models/email.php';
include_once '../services/emailServices.php';

$email = $_POST['email'] ?? null;

if (empty($email)) {
    echo json_encode([
        'success' => false,
        'message' => 'Email is required'
    ]);
    exit;
}

try {
    if ($email) {
        $emailModel = new Email($conn);
        $result = $emailModel->email($email);
        $_SESSION['ticket_info'] = [
            "success" => true,
            "message" => "Ticket created successfully",
            "ticket_no" => $result['ticket_no'],
            "email" => $email,
            "appointment_time" => $result['appointment_time'],
            "people_ahead" => $result['people_ahead']
        ];
        header('Location: ../../home.php');
        sendEmailConfirmation($result['ticket_no'], $email, $result['appointment_time']);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Email is required"
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>