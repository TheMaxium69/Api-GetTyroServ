<?php

use Symfony\Component\Yaml\Yaml;

function getMoney($uuid) {

    require "./env.php";

    $userdataFil = getFile($e_userdataDir . $uuid . ".yml", false);

    $data = Yaml::parse($userdataFil);

    if ($data == "Le fichier YML n'existe pas."){

        return "Le fichier YML n'existe pas.";

    } else {

        return ["wallet" => $data['money'],];

    }

}