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