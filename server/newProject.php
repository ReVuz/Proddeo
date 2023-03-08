<?php

require 'vendor/autolaod.php';

#   The newproject() takes the username, project name and various other parameters and adds them to the database.

function newproject(string $username, string $projectName, string $projectType, 
string $projectDescription , date $startDate, date $deadline){

    $client = new MonogoDB\Client;
    $database = $client->Prodeo;
    $collection = $database->projects;


    if (strlen($projectName) == 0){
        return 'Please provide a valid name';
    }


    $result = $collection->count(
        [ 'Name' => $projectName]
    );
    if ($result >= 1 ){
        return 'A Project with the given name already exists';
    }


    $projectID = $username + '_' + $projectName;
    $result = $collection->insertOne(
        [
            '_id'           => $projectID,
            'Name'          => $projectName,
            'Type'          => $projectType,
            'Description'   => $projectDescription,
            'startingDate'  => $startDate,
            'Deadline'      => $deadline
        ]
        );
    var_dump($result);
}

?>