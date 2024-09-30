<?php
    require_once 'database.php'; 

    class BandModel extends Database 
    {
        public function getRecordByBandId($bandId)
        {
            $sql = 'SELECT record_id FROM tb_band
                    WHERE band_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('i', $bandId);
            $select->execute();

            $results = $select->get_result()->fetch_array();

            return $results['record_id'];
        }

        public function getBandId($bandName, $recordId)
        {
            $sql = 'SELECT band_id 
                    FROM tb_band
                    WHERE band_name = ?
                        AND record_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('si', $bandName, $recordId);
            $select->execute();

            $bandNameList = $select->get_result()->fetch_array();

            return $bandNameList['band_id'];
        }

        public function getBandName($bandId)
        {
            $sql = 'SELECT band_name
                    FROM tb_band
                    WHERE band_id = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('i', $bandId);
            $select->execute();

            $results = $select->get_result()->fetch_array();

            return $results['band_name'];
        }

        public function addBand($bandName, $recordId)
        {
            try {
                $sql = 'INSERT INTO tb_band (band_name, record_id)
                        VALUES (?, ?)';
                $insert = $this->mySqli->prepare($sql);
                $insert->bind_param('si', $bandName, $recordId);
                $insert->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }

        public function getAllBand($recordId)
        {
            $sql = 'SELECT r.record_id,
                           b.band_id,
                           b.band_name,
                           COUNT(a.album_id) AS total_album
                    FROM tb_record AS r
                        INNER JOIN tb_band AS b 
                            ON r.record_id = b.record_id
                        LEFT JOIN tb_album AS a 
                            ON a.band_id = b.band_id
                    WHERE r.record_id = ?
                    GROUP BY b.band_id';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('i', $recordId);
            $select->execute();

            $results = $select->get_result();

            return $results;
        }

        public function updateBand($bandName, $bandId)
        {
            try {
                $sql = 'UPDATE tb_band
                        SET band_name = ?
                        WHERE band_id = ?';
                $update = $this->mySqli->prepare($sql);
                $update->bind_param('si', $bandName, $bandId);
                $update->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }

        public function delBandByRecordId($recordId)
        {
            try {
                $sql = 'DELETE FROM tb_band 
                        WHERE record_id = ?';
                $del = $this->mySqli->prepare($sql);
                $del->bind_param('i', $recordId);
                $del->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }
        
        public function delBand($bandId)
        {
            try {
                $sql = 'DELETE FROM tb_band
                        WHERE band_id = ?';
                $del = $this->mySqli->prepare($sql);
                $del->bind_param('i', $bandId);
                $del->execute();
            } catch (Exception $e) {
                echo 'Err -> ' . $e;
                exit();
            }
        }
    }
