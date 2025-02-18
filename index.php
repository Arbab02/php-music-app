<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Music List</h1>
    <a href="add.php">Add New Song</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Genre</th>
            <th>Action</th>
        </tr>
        <?php foreach ($tracks as $track): ?>
        <tr>
            <td><?= htmlspecialchars($track['title']) ?></td>
            <td><?= htmlspecialchars($track['artist']) ?></td>
            <td><?= htmlspecialchars($track['genre']) ?></td>
            <td>
                <a href="edit.php?id=<?= $track['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $track['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
