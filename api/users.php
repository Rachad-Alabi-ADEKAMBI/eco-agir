f<?php

function getConnexion(){
    return new PDO("mysql:host=localhost; dbname=eco; charset=UTF8", "root", "");
}

function getUsers()
{
    $pdo = getConnexion();
    $req = $pdo->prepare("SELECT * FROM
    users
        WHERE role = 'user'
        ORDER BY id DESC");
    $req->execute();
    $datas = $req->fetch();
    $req->closeCursor();
   // sendJSON($datas);
   return $datas;
}

$p =getUsers();
var_dump($p);