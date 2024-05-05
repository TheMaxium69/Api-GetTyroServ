<?php

function getFactionByUser($pseudo){

    require "./env.php";

    $factionsFile = getFile($f_factionsFile);
    $playersFile = getFile($f_playersFile);

    $factionID = null;
    $factionSelected = null;

    foreach ($playersFile as $onePlayer){
        if ($onePlayer['name'] == $pseudo){
            $factionID = $onePlayer['factionId'];
        }
    }

    if ($factionID !== null){
        foreach ($factionsFile as $oneFaction){
            if ($oneFaction['id'] == $factionID){
                $factionSelected = [
                    "id" => $oneFaction['id'],
                    "name" => $oneFaction['tag']
                ];
            }
        }
    }

    if ($factionSelected == null){
        $message = "no faction";
    } else {
        $message = $factionSelected;
    }



    return $message;

}