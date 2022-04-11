<?php
include_once("model.php");

class Member extends Model
{
    protected static $tableName = "SnowflakeRelationship";

    public $gid;
    public $snowflake;
    public $uuid;

    function __construct($sql)
    {
        $this->gid = $sql["gid"];
        $this->snowflake = $sql["snowflake"];
        $this->uuid = $sql["uuid"];
        parent::__construct();
    }

    static function all($gid)
    {

        $result = static::fetchAllWhere("gid", $gid);
        $objs = array();
        foreach ($result as $sql) {
            array_push($objs, new Member($sql));
        }
        return $objs;
    }

    static function get($gid, $uuid)
    {
        $result = static::fetchWhere("uuid",$uuid);
        $obj = new Member($result);
        return $obj;
    }
}


?>