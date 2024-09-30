<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Band</title>
    </head>
    <body>
        <a href="<?= $showBandListPath; ?>">
            <button type="submit">Back To Band List</button>
        </a>
        <h1>Add Band</h1>
        <form action="<?= $addBandPath; ?>" method="post">
            Band Name* : <input type="text" name="band_name" value="<?= $bandName; ?>" required />
            <button type="submit" name="action" value="add-band">Add Band</button>
        </form>
        <p style="color: #ff0000;">
            <?= $err; ?>
        </p>
    </body>
</html>
