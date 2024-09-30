<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Album Name</title>
</head>
<body>
    <a href="<?= $showAlbumListPath; ?>">
        <button type="submit">Back to Album List</button>
    </a>
    <h1>Add Album Name</h1>
    <form action="" method="post">
        Album Name* : <input type="text" name="album_name" value="<?= $albumName; ?>" required />
        <button type="submit" name="action" value="add" >Add Album</button>
    </form>
    <p style="color: #ff0000">
        <?= $err; ?>
    </p>
</body>
</html>
