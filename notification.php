<?php
$stmt = $pdo->prepare("INSERT INTO notifications (id_client, message) VALUES (?, ?)");
$stmt->execute([$id_client, "Votre réservation a été confirmée."]);

$stmt = $pdo->prepare("SELECT * FROM notifications WHERE id_client = ? ORDER BY date_creation DESC");
$stmt->execute([$id_client]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($notifications as $notification) {
    echo "<p>" . htmlentities($notification['message']) . "</p>";
}
?>