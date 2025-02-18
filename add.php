<?php
// add.php - Add new music track
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $file = $_FILES['file'];
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        $file_path = 'uploads/' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $file_path);
        
        $stmt = $pdo->prepare("INSERT INTO music (title, artist, genre, file_path) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $artist, $genre, $file_path]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Song</title>
</head>
<body>
    <h1>Add New Song</h1>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="artist" placeholder="Artist" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="file" name="file" accept="audio/*" required>
        <button type="submit">Add Song</button>
    </form>
</body>
</html>
