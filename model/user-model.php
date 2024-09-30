<?php
    require 'database.php';

    class UserModel extends Database
    {
        public function getUser($username, $password)
        {
            $sql = 'SELECT user_id, 
                           name,
                           username
                    FROM tb_user 
                    WHERE username = ? 
                        AND password = ?';
            $select = $this->mySqli->prepare($sql);
            $select->bind_param('ss', $username, $password);
            $select->execute();

            $result = $select->get_result()->fetch_array();

            return $result['user_id'];
        }

        public function createUser($username, $password, $name)
        {
            $sql = 'INSERT INTO tb_user (username, password, name) 
                    VALUES (?, ?, ?)';
            $insert = $this->mySqli->prepare($sql);
            $insert->bind_param('sss', $username, $password, $name);
            $insert->execute();

            return $this->mySqli->insert_id;
        }
    }
