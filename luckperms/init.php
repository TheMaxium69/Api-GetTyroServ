<?php

function getRoles($uuid){

    require "./env.php";

    $userSelectedFile = getFile($l_userDir . $uuid . ".json");

    $rolesSelected=null;
    $i = 0;

    if (empty($userSelectedFile['parents'])){
        return "no roles";
    }

    foreach ($userSelectedFile['parents'] as $parents){

        $roleOneFile = getFile($l_groupsDir . $parents['group'] . ".json");

        $displayNameValue = false;
        foreach ($roleOneFile['permissions'] as $permission) {
            $permissionValue = $permission['permission'];
            if (strpos($permissionValue, 'displayname.') === 0) {
                $displayNameValue = substr($permissionValue, strlen('displayname.'));
                break;
            }
        }

        $addRole = [
            "name" => $roleOneFile['name'],
            "displayName" => $displayNameValue,
            "prefix" => $roleOneFile['prefixes'][0]['prefix'],
        ];
        $rolesSelected[$i] = $addRole;
        $i++;

    }


    if ($rolesSelected == null){
        $message = "no role";
    } else {
        $message = $rolesSelected;
    }

    return $message;

}