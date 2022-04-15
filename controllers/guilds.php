<?php
include_once("views/view.php");
include_once("views/guilds/guilds.php");
include_once("views/guilds/guild.php");

include_once("controllers/controller.php");



include_once("middleware/basicauth.php");
include_once("middleware/json.php");

class GuildController extends Controller
{
    // Mapping of url paths to Views
    public static $endpoints = array(
            "/guilds$/" => "GuildsView",                                                          // guilds
            "/guilds\/\d+$/" => "GuildView",                                                  // guilds/123456789012345678
            "/guilds\/\d+\/members$/" => "MembersView",                                  // guilds/123456789012345678/members
            "/guilds\/\d+\/members\/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/" => "MemberView"    // guilds/123456789012345678/members/10b7a335-b9de-11ec-8b24-107b44a150b7
        );

    public static $middleware = array(
        "BasicAuthMiddleware",
        "JsonMiddleware",
    );

    
}
?>
