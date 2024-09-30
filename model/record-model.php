<?php
    require_once 'database.php'; 

    class RecordModel extends Database
    {
        public function addRecord($recordName, $userId)
        {
            try {
                $sql = 'INSERT INTO tb_record (record_name, user_id)
                        VALUES (?, ?)';
                $insert = $this->mySqli->prepare($sql);
                $insert->bind_param('si', $recordName, $userId);
                $insert->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }

        public function getRecordId($recordName)
        {
            $sql = 'SELECT record_id
                    FROM tb_record
                    WHERE record_name = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('s', $recordName);
            $select->execute();

            $recordExists = $select->get_result()->fetch_array();

            return $recordExists['record_id'];
        }

        public function getRecordName($recordId)
        {
            $sql = 'SELECT record_name
                    FROM tb_record
                    WHERE record_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('s', $recordId);
            $select->execute();

            $recordExists = $select->get_result()->fetch_array();

            return $recordExists['record_name'];
        }

        public function getAllRecord()
        {
            $sql = 'SELECT r.record_id,
                           r.record_name,
                           COUNT(DISTINCT b.band_id) AS total_band,
                           COUNT(a.album_id) AS total_album
                    FROM tb_record AS r
                        LEFT JOIN tb_band AS b 
                            ON r.record_id = b.record_id
                        LEFT JOIN tb_album AS a
                            ON b.band_id = a.band_id
                    GROUP BY r.record_id';
            $select = $this->mySqli->prepare($sql);
            $select->execute();

            $results = $select->get_result();

            return $results;
        }

        public function editRecord($recordName, $recordId)
        {
            try {
                $sql = 'UPDATE tb_record
                        SET record_name = ?
                        WHERE record_id = ?';
                $update = $this->mySqli->prepare($sql);
                $update->bind_param('si', $recordName, $recordId);
                $update->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }
        
        public function delRecord($recordId)
        {
            try {
                $sql = 'DELETE FROM tb_record
                        WHERE record_id = ?';
                $del = $this->mySqli->prepare($sql);
                $del->bind_param('i', $recordId);
                $del->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }
    }
