<?php
session_start();

$ticket = $_SESSION['ticket_info'] ?? null;

if (!$ticket) {
    header('Location: index.php');
    exit;
}
?>

<?php include 'layout/head.php'; ?>
<body>
    <?php include 'layout/header.php'; ?>

    <main>
        <div class="ticket-info">
            <h2>Hello!</h2>
            <p><strong>Your Queue Number</strong> <?php echo htmlspecialchars($ticket['ticket_no']); ?></p>
            <!--<p><strong>Email:</strong> <?php echo htmlspecialchars($ticket['email']); ?></p>-->
            <p><strong>ESTIMATED WAIT TIME</strong> <?php echo htmlspecialchars($ticket['appointment_time']); ?></p>
            <p><strong>People Ahead:</strong> <?php echo htmlspecialchars($ticket['people_ahead']); ?></p>
        </div>
    </main>

    <?php include 'layout/footer.php'; ?>
</body>
</html>