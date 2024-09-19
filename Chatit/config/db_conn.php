<?php 
function dbConn()
{
    try {
        $conn = new PDO("mysql:localhost=" . DB_USER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        throw new Exception($e->getMessage(), 1);
    }
}
?>