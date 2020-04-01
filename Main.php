<?php
include "DBConnect.php";

//Getting MySQL connection
$pdo = connect();

//Fetching all users
$users = $pdo->query("SELECT * FROM users")->fetchAll();

$data = array();

//preparing query result for json encoding
foreach ($users as $user) {
    $data[] = array(
        'id'=>$user['id'],
        'firstName'=>$user['firstName'],
        'lastName'=>$user['lastName'],
        'email'=>$user['email']
    );
}


//Writing query results to json file
$fp = fopen('data.json', 'w');

//Encoding the data array to json.
fwrite($fp, json_encode($data));
fclose($fp);


//Reading json file
$str = file_get_contents('data.json');
$fileData = json_decode($str, true);

$result = array();

//Verify data integrity from data.json by comparing the data from the query result
foreach ($fileData as $item) {
    foreach ($users as $user) {
        if ($item['id'] == $user['id']) {
            array_push($result, $item['id']);
        }
    }
}

//Deleting verified data in database
$verifiedUserIds = implode("','", $result);
$pdo->query("DELETE FROM users WHERE id IN ('".$verifiedUserIds."')");;

//Closing MySQL connection by removing all references.
$pdo = null;