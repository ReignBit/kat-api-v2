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
        return new Guild(static::fetch("id", $id));
    }

    static function create($id, $prefix)
    {
        return static::insert(array('id' => $id, 'prefix' => $prefix));
    }

}


?>
