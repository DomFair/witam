<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

function getPDO(){
    require_once 'inc.db.php';

    try {
        $pdo = new PDO(CONNECT_MYSQL, USER, PWD);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
       return $pdo;

    } catch (PDOException $e) {
        die($e->getMessage());
       
    }
}

$pdo = getPDO();


>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <link href="style.css" rel="stylesheet">
    <title>Assessment Home Page</title>
</head>

<body>
    
    <ul class="tabs">
        <li data-tab-target="#tableOne" class = "active tab">Current Work Staff</li>
        <li data-tab-target="#tableTwo" class = "tab">Old Work Staff</li>
    </ul>



    <div id = "container">
        <div class = "left">
            <div class = "content" >
                <div id="tableOne" data-tab-content class="active">
                    <h1>Current Worker List</h1>
                    <p>hehe</p>

                </div>
                <div id="tableTwo" data-tab-content>
                    <h1>Ex-Worker List</h1>
                    <p>haha</p>
                </div>
            </div>
        </div>
        <div class = "right">
            <h1>Complaints</h1>

        </div>
    </div>
</body>
</html>