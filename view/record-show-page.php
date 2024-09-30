<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
        <h1>
            Record List 
            <a href="<?= USER_CONTROLLER_PATH . '?page=logout'; ?>">
                <button type="submit">Logout</button>
            </a>
        </h1>
        <a href="<?= $addRecordPath; ?>">
            <button type="submit">Add Record List</button>
        </a>
        <table style="width: 100%; margin-top: 5px;">
            <tr>
                <th style="width: 50%">Record name</th>
                <th style="width: 10%">Total Band</th>
                <th style="width: 10%">Total Album</th>
                <th style="width: 30%">Action</th>
            </tr>
            <?php 
                foreach ($recordList as $record) :
                    $recordId = $record['record_id'];
                    $recordName = $record['record_name'];
                    $totalBand = $record['total_band'];
                    $totalAlbum = $record['total_album'];
                    $showBandListPath = BAND_CONTROLLER_PATH . '?record-id=' . $recordId;
                    $editRecordPath = RECORD_CONTROLLER_PATH . '?page=edit-record&record-id=' . $recordId;
                    $delRecordPath = RECORD_CONTROLLER_PATH . '?page=del-record&record-id=' . $recordId;
            ?>
            <tr>
                <td><?= $recordName; ?></td>
                <td><?= $totalBand; ?></td>
                <td><?= $totalAlbum; ?></td>
                <td>
                    <a href="<?= $showBandListPath; ?>">
                        <button>Show Band</button>
                    </a>
                    <a href="<?= $editRecordPath; ?>">
                        <button>Change Record Name</button>
                    </a>
                    <button type="submit" onclick="confirmDel('<?= $delRecordPath; ?>')">Del</button>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
