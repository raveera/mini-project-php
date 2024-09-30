<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Band List</title>
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

        a {
            text-decoration: none;
        }
    </style>
    <script src="/js/comfirm-del.js"></script>
    <body>
        <a href="<?= RECORD_CONTROLLER_PATH; ?>">
            <button type="submit">Back To Record List</button>
        </a>
        <h1>Band List </h1>
        <a href="<?= $addBandPath; ?>">
            <button type="submit">Add Band</button>
        </a>
        <table style="width: 100%; margin-top: 5px;">
            <tr>
                <th style="width: 50%">Band name</th>
                <th style="width: 20%">Total Album</th>
                <th style="width: 30%">Action</th>
            </tr>
            <?php 
                foreach ($bandList as $band) :
                    $recordId = $band['record_id'];
                    $bandId = $band['band_id'];
                    $bandName = $band['band_name'];
                    $totalAlbum = $band['total_album'];
                    $showAlbumListPath = ALBUM_CONTROLLER_PATH . '?page=album-list&band-id=' . $bandId;
                    $editBandPath = BAND_CONTROLLER_PATH . '?page=edit-band&record-id=' . $recordId . '&band-id=' . $bandId;
                    $delBandPath = BAND_CONTROLLER_PATH . '?page=del-band&record-id=' . $recordId . '&band-id=' . $bandId;
            ?>
            <tr>
                <td><?= $bandName; ?></td>
                <td><?= $totalAlbum; ?></td>
                <td>
                    <a href="<?= $showAlbumListPath; ?>">
                        <button type="submit">Show Album</button>
                    </a>
                    <a href="<?= $editBandPath; ?>">
                        <button type="submit">Change Band Name</button>
                    </a>
                    <button type="submit" onclick="confirmDel('<?= $delBandPath; ?>')" >Del</button>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
