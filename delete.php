<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the file path before deleting the record
    $stmt = $pdo->prepare("SELECT file_path FROM music WHERE id = ?");
    $stmt->execute([$id]);
    $track = $stmt->fetch();

    if ($track && file_exists($track['file_path'])) {
        unlink($track['file_path']); // Delete the file from the server
    }

    // Delete the track from the database
    $stmt = $pdo->prepare("DELETE FROM music WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit;
}
?>
