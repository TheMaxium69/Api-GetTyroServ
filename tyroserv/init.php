<?php

function getAllStats(){

    require "./env.php";

    $mergedMapAll = [];

    foreach ($worldStats as $worldStatsOne){

        $chemin_dossier = $worldStatsOne['url'];

        $noms_fichiers_json = array();

        if (is_dir($chemin_dossier)) {
            if ($dossier = opendir($chemin_dossier)) {
                while (($fichier = readdir($dossier)) !== false) {
                    if ($fichier != "." && $fichier != "..") {
                        if (pathinfo($fichier, PATHINFO_EXTENSION) === 'json') {
                            $noms_fichiers_json[] = $fichier;
                        }
                    }
                }
                closedir($dossier);
            }
        } else {
            $mergedMapAll['world'][$worldStatsOne['name']] = "err";
        }

        $mergedMap = [];

        foreach ($noms_fichiers_json as $nom_fichier_json) {
            $contenu_json = file_get_contents($chemin_dossier . '/' . $nom_fichier_json);
            $json_data = json_decode($contenu_json, true);

        //    var_dump("JSON UNIQUE ", $json_data);

            // Fusionner les tableaux
            foreach (array_keys($mergedMap + $json_data) as $key) {
                $mergedMapNew[$key] = ($mergedMap[$key] ?? 0) + ($json_data[$key] ?? 0);
            }

        //    var_dump("MERGE TWO : ", $mergedMapNew);
            $mergedMap = $mergedMapNew;

        }
        $mergedMapAll['world'][$worldStatsOne['name']] = $mergedMap;


    }


    $allStats = [];

    foreach ($mergedMapAll['world'] as $globalStatsOneMap){

        if ($globalStatsOneMap !== "err"){

            foreach (array_keys($allStats + $globalStatsOneMap) as $key) {
                $allStatsNew[$key] = ($allStats[$key] ?? 0) + ($globalStatsOneMap[$key] ?? 0);
            }

            $allStats = $allStatsNew;

        }

    }

    if ($allStats !== []){
        $mergedMapAll['all'] = $allStats;
    }


    // Returner le tableau fusionné
    return $mergedMapAll;

}



function getServerList(){

    require "./env.php";

    $servers = [];
    $i = 0;

    foreach ($worldStats as $worldStatsOne) {

        $servers[$i]=[
            "id"=>$i,
            "name"=>$worldStatsOne['name']
        ];

        $i = $i + 1;
    }

    return $servers;


}