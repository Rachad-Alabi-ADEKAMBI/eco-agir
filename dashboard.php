<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

 include 'db.php';

$req = $pdo->prepare("SELECT * FROM
users
    WHERE status != 'Supprimé'
    ORDER BY id DESC");
$req->execute();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>Eco - Tableau de bord</title>
</head>
<body>
    <div class="container" id='app'> <br>
        <?php include 'header.php'; ?>

        <main class="main">
        <div class="content">
            <p class='text'>
                Bonjour <strong class='username'><?= $_SESSION['user']['username'] ?></strong> , content de vous revoir
            </p>

            <table v-if='showUsers'>
                <caption>Liste des inscrits</caption>
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                                while($data = $req->fetch()){?>
                                                    <tr >
                                            <td data-label="Date"><?= $data['date_of_insertion'] ?></td>
                                            <td data-label="Email"><a href="client.php?id=<?=$data['id']?>"><?= substr($data['email'], 0, 7) . '...';  ?></a></td>
                                            <td data-label="Contact"><?= substr($data['phone'], 0, 3) . '...'; ?></td>
                                            <td><a href="deleteUser.php?id=<?=$data['id']?>">
                                            <i class="fas fa-trash"></i></a></td>
                                    </tr>
                                <?php }

                        ?>
                </tbody>
            </table>

            <br>

            <button class='button'>
                <a href="save.php">
                Imprimer
                </a>
            </button>
        </div>
        </main>
    </div>
</body>
</html>