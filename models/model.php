<?php

class Model
{
    protected static $conn;
    protected static $tableName;

    function __construct()
    {
        
    }

    static function ensureConn()
    {
        if (static::$conn == null)
        {
            try
            {
                $options = [
                    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES      => false
                ];

                static::$conn = new PDO(
                    "mysql:host=".DB_HOSTNAME.";dbname=".DB_DBNAME.";charset=utf8mb4",
                    DB_USERNAME,
                    DB_PASSWORD,
                    $options
                );
            }
            catch (PDOException $e)
            {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
    }

    static function fetchAll()
    {
        static::ensureConn();
        $stmt = static::$conn->prepare("SELECT * FROM ".static::$tableName.";");
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    static function fetchAllWhere($key, $value)
    {
        static::ensureConn();
        $stmt = static::$conn->prepare("SELECT * FROM ".static::$tableName." WHERE $key = ?;");
        $stmt->execute([$value]);
        return $stmt->fetchAll();
        
    }

    static function fetchWhere($key, $value)
    {
        static::ensureConn();
        $stmt = static::$conn->prepare("SELECT * FROM ".static::$tableName." WHERE $key = ? LIMIT 1;");
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    static function fetch($key, $value)
    {
        static::ensureConn();
        $stmt = static::$conn->prepare("SELECT * FROM ".static::$tableName." WHERE $key = ? LIMIT 1;");
        $stmt->execute([$value]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    static function fetchMultiple($pairs)
    {
        $str = "";
        foreach ($pairs as $columnName => $value) {
            $str .= " AND $columnName = $value";
        }
        $stmt = static::$conn->prepare("SELECT * FROM ".static::$tableName." WHERE 1 ". $str ." LIMIT 1;");
        $stmt->execute([$value]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>