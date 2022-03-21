<?php
/**
 * Created by PhpStorm.
 * User: El Niño
 * Date: 01/10/2017
 * Time: 19:29
 */

class Db
{
    /** @var PDO $conn */
    protected static $conn;

    public static function getConnection()
    {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO(sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_DATABASE), DB_USER, DB_PASS);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "DB connection failed: " . $e->getMessage();

                return false;
            }
        }

        return self::$conn;
    }

    public function query($stmt, $mode = PDO::ATTR_DEFAULT_FETCH_MODE, $arg3 = null, $ctorargs = [])
    {
        $return = self::$conn->query($stmt, $mode, $arg3, $ctorargs);

        $this->disconnect();

        return $return;
    }

    public function disconnect()
    {
        self::$conn = null;
    }
}