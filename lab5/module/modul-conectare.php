<?php
    $link = mysqli_connect("localhost", "root", "", "lab5");
    if (!$link)
        die("Nu ma pot conecta la server! Citeste o carte!");
        

    $mysql_server = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "lab5";
    
    function DB_Connect( $close_connection = false)
	{
        global $mysql_server, $mysql_user, $mysql_password, $mysql_database;
		static $connection;

		if($close_connection)
		{
			mysqli_close($connection);
			$connection = false;
			return false;
		}
		if(!isset($connection) || $connection === false)
		{
			$connection = @mysqli_connect($mysql_server, $mysql_user, $mysql_password, $mysql_database);
		}
		if($connection === false) {
            print "Nu pot realiza conectarea MySQL.\n";
			die();
            return false;
        }
		mysqli_query($connection, 'SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8";');
        return $connection;
    }

	function DB_Close(){
		return DB_Connect(true);
	}
 ?>
