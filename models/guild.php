<?php
include_once("model.php");

class Guild extends Model
{
    protected static $tableName = "Guild";

    public $id;
    public $prefix;

    function __construct($sql)
    {

        $this->id = $sql['id'];
        $this->prefix = $sql['prefix'];
        parent::__construct();
    }

    function edit($data)
    {
        if(isset($data['prefix'])) { $this->prefix = $data['prefix']; }
        return $this;
    }

    function save()
    {
        return static::update("id", $this->id, array("prefix" => $this->prefix));
    }

    static function all()
    {
        return array_map(fn ($sql) => new Guild($sql), static::fetchAll());
    }

    static function get($id)
    {
        $result = static::fetch("id", $id);
        if ($result)
        {
            return new Guild($result);
        }
        else
        {
            return false;
        }
    }

    static function create($id, $prefix)
    {
        $result = static::insert(array('id' => $id, 'prefix' => $prefix));
        return $result;
    }

}


?>
