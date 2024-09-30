<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Record Name</title>
    </head>
    <body>
        <a href="<?= RECORD_CONTROLLER_PATH; ?>">
            <button type="submit">Back To Record List</button>
        </a>
        <h1>Edit Record Name</h1>
        <form action="<?= RECORD_CONTROLLER_PATH . '?page=edit-record&record-id=' . $recordId; ?>" method="post">
            Record Name* : <input type="text" name="record_name" value="<?= $recordName ? $recordName : $recordOldName; ?>" required />
            <button type="submit" name="action" value="edit">Save</button>
        </form>
        <p style="color: #ff0000;">
            <?= $err; ?>
        </p>
    </body>
</html>
