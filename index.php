<?php

// INIT
include "function.php";
include './vendor/autoload.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// TASK
require "minecraft/init.php";
require "factions/init.php";
require "essential/init.php";
require "luckperms/init.php";
require "tyroserv/init.php";


if (empty($_GET['task'])){

    if (empty($_GET['pseudo'])){
        echo json_encode(["status"=>"ok", "message"=>"no pseudo"]);
        exit();
    }
    $pseudo = $_GET['pseudo'];

    $result['player'] = getPlayer($pseudo);
    if ($result['player'] !== "no player"){

        $uuid = $result['player']['uuid'];
        $name = $result['player']['name'];

        $result['faction'] = getFactionByUser($name);
        $result['money'] = getMoney($uuid);
        $result['roles'] = getRoles($uuid);
        $result['stats'] = getPlayerStats($pseudo);


    }

    echo json_encode([
        "status"=>"ok",
        "message"=>"Information de " . $pseudo,
        "result"=>$result
    ]);

} else {

    $task = $_GET['task'];

    /*TASK PAR UTILISATEUR*/
    if (empty($_GET['global'])){

        if (empty($_GET['pseudo'])){
            echo json_encode(["status"=>"ok", "message"=>"no pseudo"]);
            exit();
        }
        $pseudo = $_GET['pseudo'];

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


        } else if ($task == "stats"){

            $playerStats = getPlayerStats($pseudo);

            echo json_encode([
                "status"=>"ok",
                "message"=>"Les world stats de " . $pseudo,
                "result"=>$playerStats
            ]);

        } else {

            echo json_encode([
                "status"=>"ok",
                "message"=>"task inconnue"
            ]);


        }


    } else {
        /*TASK GLOBAL*/

        if ($task == "stats"){

            $globalStats = getAllStats();

            echo json_encode([
                "status"=>"ok",
                "message"=>"Les world stats global",
                "result"=>$globalStats
            ]);

        } else if ($task == "factions"){

            $globalFac = getAllFaction();

            echo json_encode([
                "status"=>"ok",
                "message"=>"toutes les factions",
                "result"=>$globalFac
            ]);

        } else if ($task == "players"){

            $globalPlayer = getAllPlayer();

            echo json_encode([
                "status"=>"ok",
                "message"=>"toutes les joueurs",
                "result"=>$globalPlayer
            ]);

        } else {


            $resultGlobal['players'] = getAllPlayer();
            $resultGlobal['factions'] = getAllFaction();
            $resultGlobal['stats'] = getAllStats();


            echo json_encode([
                "status"=>"ok",
                "message"=>"Information global",
                "result"=>$resultGlobal
            ]);

        }


    }


}


?>