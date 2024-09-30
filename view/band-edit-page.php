<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Band Name</title>
    </head>
    <body>
        <a href="<?= $showBandListPath; ?>">
            <button type="submit">Back To Band List</button>
        </a>
        <h1>Edit Band Name</h1>
        <form action="<?= BAND_CONTROLLER_PATH . '?page=edit-band&record-id=' . $recordId . '&band-id=' . $bandId; ?>" method="POST">
            Band Name* : <input type="text" name="band_name" value="<?= $bandName ? $bandName : $bandOldName; ?>" required />
            <button type="submit" name="action" value="save">Save</button>
        </form>
        <p style="color: #ff0000;">
            <?= $err; ?>
        </p>
    </body>
</html>
