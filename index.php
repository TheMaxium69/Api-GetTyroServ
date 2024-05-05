<?php

// INIT
include "function.php";
include './vendor/autoload.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if (empty($_GET['pseudo'])){
    echo json_encode(["status"=>"ok", "message"=>"no pseudo"]);
    exit();
}
$pseudo = $_GET['pseudo'];

// TASK
require "minecraft/init.php";
require "factions/init.php";
require "essential/init.php";
require "luckperms/init.php";


if (empty($_GET['task'])){

    $result['player'] = getPlayer($pseudo);
    if ($result['player'] !== "no player"){

        $uuid = $result['player']['uuid'];
        $name = $result['player']['name'];

        $result['faction'] = getFactionByUser($name);
        $result['money'] = getMoney($uuid);
        $result['roles'] = getRoles($uuid);

    }

    echo json_encode([
        "status"=>"ok",
        "message"=>"Information de " . $pseudo,
        "result"=>$result
    ]);

} else {

    $task = $_GET['task'];

    if ($task == "faction"){

        $result = getFactionByUser($pseudo);

        echo json_encode([
            "status"=>"ok",
            "message"=>"La faction de " . $pseudo,
            "result"=>$result
        ]);


    } else if ($task == "player"){

        $result = getPlayer($pseudo);

        echo json_encode([
            "status"=>"ok",
            "message"=>"Les players data de " . $pseudo,
            "result"=>$result
        ]);


    } else if ($task == "roles"){

        $player = getPlayer($pseudo);
        if ($player !== "no player") {

            $result = getRoles($player['uuid']);

            echo json_encode([
                "status" => "ok",
                "message" => "Les roles de " . $pseudo,
                "result" => $result
            ]);
        } else {

            echo json_encode([
                "status"=>"ok",
                "message"=>"Les roles de " . $pseudo,
                "result"=>$player
            ]);

        }


    } else if ($task == "money"){

        $player = getPlayer($pseudo);
        if ($player !== "no player") {

            $result = getMoney($player['uuid']);

            echo json_encode([
                "status" => "ok",
                "message" => "La money de " . $pseudo,
                "result" => $result
            ]);
        } else {

            echo json_encode([
                "status"=>"ok",
                "message"=>"La money de " . $pseudo,
                "result"=>$player
            ]);

        }


    } else {

        echo json_encode([
            "status"=>"ok",
            "message"=>"task inconnue"
        ]);


    }


}


?>