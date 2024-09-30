<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Song</title>
</head>
<body>
    <h1>Add Song</h1>
    <form action="" method="post">
        Song Name* : <input type="text" name="song-name" value="" required />
        <button type="submit" name="action" value="add" >Add</button>
    </form>
    <p style="color: #ff0000">
        <?= $err ?>
    </p>
</body>
</html>
