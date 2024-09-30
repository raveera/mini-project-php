<?php
    require_once 'database.php';

    class SongModel extends Database
    {
        // check by albumid and songName
        public function getSongName($songName, $albumId)
        {
            $sql = 'SELECT song_name
                    FROM tb_song
                    WHERE song_name = ?
                        AND album_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('si', $songName, $albumId);
            $select->execute();

            $results = $select->get_result()->fetch_array();

            return $results['song_name'];
        }

        public function addSong($songName, $albumId)
        {
            try {
                $sql = 'INSERT INTO tb_song (song_name, album_id)
                        VALUES (?, ?)';
                $insert = $this->mySqli->prepare($sql);
                $insert->bind_param('si', $songName, $albumId);
                $insert->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }
    }
    