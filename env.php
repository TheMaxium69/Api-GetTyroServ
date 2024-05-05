<?php

/********************
 *
 *  MINECRAFT
 *
 ******************** */


$minecraftUrl = "C:\Users\mxmto\Developpement\Minecraft\Instance/tyroserv/TyroServ-S3/";

// usercache.json
$usercacheFile = $minecraftUrl . "usercache.json";

// usernamecache.json
$usernamecacheFile = $minecraftUrl . "usernamecache.json";

// World/Stats
$worldStats = [
    [
        "name" => "defaultMap",
        "url" => $minecraftUrl . "world/stats/",
    ],
    [
        "name" => "devMap",
        "url" => $minecraftUrl . "TyroModV3-Map/stats/",
    ]
];


/********************
 *
 *  PLUGIN FACTION
 *
 ******************** */

$f_plugurl = $minecraftUrl . "plugins/Factions/data/";

// factions.json
$f_factionsFile = $f_plugurl ."factions.json";

// players.json
$f_playersFile = $f_plugurl . "players.json";


/********************
 *
 *  PLUGIN ESSENTIAL
 *
 ******************** */


$e_plugurl = $minecraftUrl . "plugins/Essentials/";

$e_userdataDir = $e_plugurl . "userdata/";

/********************
 *
 *  PLUGIN LUCKPERMS
 *
 ******************** */

$l_plugurl = $minecraftUrl . "plugins/LuckPerms/json-storage/";

$l_userDir = $l_plugurl . "users/";
$l_groupsDir = $l_plugurl . "groups/";


?>