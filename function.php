<?php

function getFile($jsonFilePath, $isJson = true){

    if ($isJson) {
        if (file_exists($jsonFilePath)) {

            $jsonContent = file_get_contents($jsonFilePath);

            $data = json_decode($jsonContent, true);

            if ($data === null) {
                return "Erreur de décodage JSON";
            } else {
                return $data;
            }
        } else {
            return "Le fichier JSON n'existe pas.";
        }
    } else {


        if (file_exists($jsonFilePath)) {

            $jsonContent = file_get_contents($jsonFilePath);

            return $jsonContent;

        } else {
            return "Le fichier YML n'existe pas.";
        }


    }
}