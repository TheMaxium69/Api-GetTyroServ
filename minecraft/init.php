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

            foreach ($worldStats as $worldOne){

                $userWorldStats = getFile($worldOne['url'] . $uuid . ".json");
                if ($userWorldStats == "Le fichier JSON n'existe pas."){
                    $userWorldStats = "none";
                }

                $playerStatsSelected[$worldOne['name']] = $userWorldStats;

            }
        }
    }

    if ($playerStatsSelected == null){
        $message = "no stats";
    } else {
        $message = $playerStatsSelected;
    }

    return $message;
}