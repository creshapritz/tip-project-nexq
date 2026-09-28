<?php
require_once __DIR__ . '/../../config/dbConfig.php';
date_default_timezone_set('Asia/Manila');

class Email {
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function email($email){
        //generating ticket
        $sql = "SELECT COUNT(*) FROM email WHERE DATE(timestamp) = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
        $count = $stmt->fetchColumn();
        //$ticketNumber = "SAO-" . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $ticketNumber = $count + 1;

        //getting people ahead and calculating serving time
        $sql = "SELECT COUNT(*) FROM email WHERE DATE(timestamp) = CURDATE() AND status IN ('Waiting', 'Serving')";
        $stmt = $this->conn->prepare($sql);
        $stmt-> execute();
        $peopleAhead = $stmt->fetchColumn();
        $waitingMinutes = $peopleAhead * 4;
        $appointmentTime = date('Y-m-d h:i A', strtotime("+$waitingMinutes Minutes"));

        //inserting it into database
        $sqlInsert = "INSERT INTO email (email, ticket_no, appointment_time) VALUES (:email, :ticket_no, :appointment_time)";
        $stmt = $this->conn->prepare($sqlInsert);
        $stmt-> execute([':email' => $email, ':ticket_no' => $ticketNumber, ":appointment_time" => $appointmentTime]);

        // Return the generated information
        return [
            'ticket_no' => $ticketNumber,
            'appointment_time' => $appointmentTime,
            'people_ahead' => $peopleAhead
        ];
    }
}
?>