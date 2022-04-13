<?php
include_once("model.php");

class Guild extends Model
{
    protected static $tableName = "Guild";

    public $id = 0;
    public $prefix = "";

    function __construct($sql)
    {

        $this->id = $sql['id'];
        $this->prefix = $sql['prefix'];
        parent::__construct();
    }

    static function all()
    {

        $result = static::fetchAll();
        $guilds = array();
        foreach ($result as $sql) {
            array_push($guilds, new Guild($sql));
        }
        return $guilds;
    }

    static function get($id)
    {

        $result = static::fetch("id", $id);
        
        $obj = new Guild($result);
        return $obj;
    }

    static function create($id, $prefix)
    {
        return static::insert(array('id' => $id, 'prefix' => $prefix));
    }

}


?>