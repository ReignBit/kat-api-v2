<?php

include_once("controllers/base.php");

include_once("models/guild.php");
include_once("models/member.php");

class GuildController extends BaseController
{
    public static $endpoints = array(
            "/guilds$/" => "handleDefaultRequest",                                                              // guilds
            "/guilds\/\d{18}$/" => "handleRequestGuildSingle",                                                  // guilds/123456789012345678
            "/guilds\/\d{18}\/members$/" => "handleRequestGuildMemberAll",                                      // guilds/123456789012345678/members
            "/guilds\/\d{18}\/members\/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/" => "handleRequestGuildMemberSingle"    // guilds/123456789012345678/members/10b7a335-b9de-11ec-8b24-107b44a150b7
        );

    static function handleDefaultRequest()
    {
        return Guild::all();
    }

    static function handleRequestGuildSingle($id)
    {
        return Guild::get($id);
    }
    
    static function handleRequestGuildMemberAll($gid)
    {
        return Member::all($gid);
    }

    static function handleRequestGuildMemberSingle($gid, $uuid)
    {
        return Member::get($gid, $uuid);
    }

    
}

?>
