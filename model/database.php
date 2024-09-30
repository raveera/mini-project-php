<?php 
	
 	class Database
	{
		protected $mySqli;

		function __construct()
		{
			$this->connectDB();
		}

		function connectDB()
		{
			$dbHost = 'localhost';
			$dbUser = 'root';
			$dbPassword = 'root';
			$dbName = 'mini_project';

			$mySqli = new mysqli(
				$dbHost,
				$dbUser,
				$dbPassword,
				$dbName
			);
					
			if ($mySqli->connect_error) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				exit();	
			// } else {
			// 	echo 'Connect Success <br>';
			}
			
			$this->mySqli = $mySqli;
		}

	}