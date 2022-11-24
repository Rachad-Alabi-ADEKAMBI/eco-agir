<?php session_start();
    $pdo = new PDO('mysql:dbname=eco;host=localhost', 'root', '');

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
            header('dashboard.php');
        }

        $sql = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $sql->execute(array($id));
        $data = $sql->fetch();



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>EcoAgir - Supprimer inscrit</title>
</head>
<body>
    <div class="container">
    <?php
           if (isset($_SESSION['user'])) {
             include 'header.php';
           }
        ?>
        <br><br>

        <main class="main">
            <form action="api/api.php?action=delete&id=<?=$id?>" class="login"
                method='POST'>
                   <p>
                    Souhaitez vous vraiment supprimer
                    <strong><?= $data['email'] ?></strong> ?
                   </p>

                    <div class="buttons">
                    <button type='submit' class='green'>
                        Oui
                    </button>

                    <button class='red' >
                        <a href="dashboard.php">
                        Non
                        </a>
                    </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
</html>