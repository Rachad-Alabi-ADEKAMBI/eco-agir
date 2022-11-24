<?php
$pdo = new PDO('mysql:dbname=eco;host=localhost', 'root', '');
function getConnexion(){
    return new PDO("mysql:host=localhost; dbname=eco; charset=UTF8", "root", "");
}

$id = 1;

if(!isset($_POST['submit'])){
    $i = 0;
    foreach($_FILES['salon']['tmp_name'] as $key => $image){
        $i++;
        $img = '';
        $item = 'salon'.$i;
        $imageName = $_FILES['salon']['name'][$key];
        $imageTmpName = $_FILES['salon']['tmp_name'][$key];

        $img .=$imageName. ',';
        $directory = 'public/img/';

        $result = move_uploaded_file($imageTmpName, $directory.$imageName);

        $sql=$pdo->prepare('UPDATE users SET '.$item.'= ? WHERE id = ?');
        $sql->execute(array($imageName, $id));
    }

    if($result){
        echo  'ok fait';
    }
}
else{
    echo 'Veuillez verifier vos entrees';
}

?>