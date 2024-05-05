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

                $playerStatsSelected['world'][$worldOne['name']] = $userWorldStats;

            }

            $allStats = [];

            foreach ($playerStatsSelected['world'] as $playerStatsOneMap){

                if ($playerStatsOneMap !== "none"){

                    foreach (array_keys($allStats + $playerStatsOneMap) as $key) {
                        $allStatsNew[$key] = ($allStats[$key] ?? 0) + ($playerStatsOneMap[$key] ?? 0);
                    }

                    $allStats = $allStatsNew;

                }

            }

            if ($allStats !== []){
                $playerStatsSelected['all'] = $allStats;
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

function getAllPlayer() {

    require "./env.php";

    $usercacheTableau = getFile($usercacheFile);

    $playerAll = [];

    foreach ($usercacheTableau as $userOne){

        $playerSelected = [
            "uuid"=>$userOne['uuid'],
            "name"=>$userOne['name'],
        ];

        array_push($playerAll, $playerSelected);
    }

    if ($playerAll == []){
        $message = "no player";
    } else {
        $message = $playerAll;
    }

    return $message;
}