<?php
class DbConnect
{

    public function connect()
    {
        try 
        {
            $conn = new PDO("mysql:host=localhost;dbname=accident", 'root', '');
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
        }
        catch( PDOException $e) 
        {
            echo 'Database Error: ' . $e->getMessage();
        }        

    }
}


?>