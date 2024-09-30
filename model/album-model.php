<?php
    require_once 'database.php'; 

    class AlbumModel extends Database 
    {
        public function getAlbumId($albumName, $bandId)
        {
            $sql = 'SELECT album_id 
                    FROM tb_album
                    WHERE album_name = ? 
                        AND band_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('si', $albumName, $bandId);
            $select->execute();

            $results = $select->get_result()->fetch_array();

            return $results['album_id'];
        }

        public function getAlbumName($albumId)
        {
            $sql = 'SELECT album_name 
                    FROM tb_album
                    WHERE album_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('i', $albumId);
            $select->execute();

            $results = $select->get_result()->fetch_array();

            return $results['album_name'];
        }

        public function addAlbum($albumName, $bandId, $recordId)
        {
            try {
                $sql = 'INSERT INTO tb_album (album_name, band_id, record_id)
                        VALUES (?, ?, ?)';
                $insert = $this->mySqli->prepare($sql);
                $insert->bind_param('sii', $albumName, $bandId, $recordId);
                $insert->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }

        public function getAllAlbum($bandId)
        {
            $sql = 'SELECT album_id, album_name FROM tb_album
                    WHERE band_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('i', $bandId);
            $select->execute();

            $results = $select->get_result();

            return $results;
        }

        public function updateAlbum($albumName, $albumId, $recordId)
        {
            try {
                $sql = 'UPDATE tb_album
                        SET album_name = ?,
                            record_id = ?
                        WHERE album_id = ?';
                $update = $this->mySqli->prepare($sql);
                $update->bind_param('sii', $albumName, $recordId, $albumId);
                $update->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }

        public function delAlbumByRecordId($recordId)
        {
            try {
                $sql = 'DELETE FROM tb_album
                        WHERE record_id = ?';
                $del = $this->mySqli->prepare($sql);
                $del->bind_param('i', $recordId);
                $del->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }

        public function delAlbumByBandId($bandId)
        {
            try {
                $sql = 'DELETE FROM tb_album 
                        WHERE band_id = ?';
                $del = $this->mySqli->prepare($sql);
                $del->bind_param('i', $bandId);
                $del->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }

        public function delAlbum($albumId)
        {
            try {
                $sql = 'DELETE FROM tb_album
                        WHERE album_id = ?';
                $del = $this->mySqli->prepare($sql);
                $del->bind_param('i', $albumId);
                $del->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }
    }
