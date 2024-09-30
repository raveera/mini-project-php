<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Album List</title>
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
        <a href="<?= BAND_CONTROLLER_PATH . '?page=band-list&record-id=' . $recordId;?>">
            <button type="submit">Back to Band List</button>
        </a>
        <a href="<?= RECORD_CONTROLLER_PATH . '?page=record-list'; ?>">
            <button type="submit">Back to Record List</button>
        </a>
        <h1>Album List</h1>
        <a href="<?= ALBUM_CONTROLLER_PATH . '?page=add-album&band-id=' . $bandId; ?>">
            <button type="submit">Add Album</button>
        </a>
        <table style="width: 100%; margin-top: 5px;">
            <tr>
                <th style="width: 50%">Album Name</th>
                <th style="width: 20%">total Song</th>
                <th style="width: 30%">Action</th>
            </tr>
            <?php 
                foreach ($albumList as $album) :
                    $albumId = $album['album_id'];
                    $albumName = $album['album_name'];
                    $showSongListPath = SONG_CONTROLLER_PATH . '?page=song-list&album-id=' . $albumId;
                    $editAlbumPath = ALBUM_CONTROLLER_PATH . '?page=edit-album&band-id=' . $bandId . '&album-id=' . $albumId;
                    $delAlbumPath = ALBUM_CONTROLLER_PATH . '?page=del-album&band-id=' . $bandId . '&album-id=' . $albumId;
            ?>
            <tr>
                <td><?= $albumName; ?></td>
                <td></td>
                <td>
                    <a href="<?= $showSongListPath ?>">
                        <button type="submit">Show Song</button>
                    </a>
                    <a href="<?= $editAlbumPath; ?>">
                        <button type="submit">Change Album Name</button>
                    </a>
                    <button type="submit" onclick="confirmDel('<?= $delAlbumPath; ?>')" >Del Album</button>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
