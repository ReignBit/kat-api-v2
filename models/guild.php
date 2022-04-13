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
        return array_map(fn ($sql) => new Guild($sql), static::fetchAll());
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
