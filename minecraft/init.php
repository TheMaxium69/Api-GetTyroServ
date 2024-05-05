<?php

function getPlayer($pseudo) {

    require "./env.php";

    $usercacheTableau = getFile($usercacheFile);

    $playerSelected = null;

    foreach ($usercacheTableau as $userOne){
        if ($userOne['name'] == $pseudo){
            $playerSelected = [
                "uuid"=>$userOne['uuid'],
                "name"=>$userOne['name'],
            ];
        }
    }

    if ($playerSelected == null){
        $message = "no player";
    } else {
        $message = $playerSelected;
    }

    return $message;
}

function getPlayerStats($pseudo) {

    require "./env.php";

    $usercacheTableau = getFile($usercacheFile);

    $playerStatsSelected = null;

    foreach ($usercacheTableau as $userOne){
        if ($userOne['name'] == $pseudo){
            $uuid = $userOne['uuid'];

            $userWorldStats = getFile($worldStats . $uuid . ".json");

            $playerStatsSelected = [
                "world1" => $userWorldStats
            ];


        }
    }

    if ($playerStatsSelected == null){
        $message = "no stats";
    } else {
        $message = $playerStatsSelected;
    }

    return $message;
}