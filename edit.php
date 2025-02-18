<?php
require 'db.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM music WHERE id = ?");
$stmt->execute([$id]);
$track = $stmt->fetch();

if (!$track) {
    die("Music track not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    
    $stmt = $pdo->prepare("UPDATE music SET title = ?, artist = ?, genre = ? WHERE id = ?");
    $stmt->execute([$title, $artist, $genre, $id]);
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song</title>
</head>
<body>
    <h1>Edit Song</h1>
    <form action="edit.php?id=<?= $id ?>" method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($track['title']) ?>" required>
        <input type="text" name="artist" value="<?= htmlspecialchars($track['artist']) ?>" required>
        <input type="text" name="genre" value="<?= htmlspecialchars($track['genre']) ?>" required>
        <button type="submit">Update Song</button>
    </form>
</body>
</html>
