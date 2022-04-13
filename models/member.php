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

        return array_map(fn ($sql) => new Member($sql), static::fetchAll());

    }

    static function get($gid, $uuid)
    {
        return new Member(static::fetchWhere("uuid",$uuid));
    }
}


?>