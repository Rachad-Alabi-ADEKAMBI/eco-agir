<?php
session_start();

function verifyInput($inputContent){
    $inputContent = htmlspecialchars(
        $inputContent
    );

    $inputContent = trim($inputContent);

    return $inputContent;
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_GET['id'] < 0) {
    header("Location: dashboard.php");
    exit;
}

include 'db.php';

$req = $pdo->prepare("SELECT * FROM
users
    WHERE id = ?");
$req->execute(array(verifyInput($_GET['id'])));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>EcoAgir - Fiche client</title>
</head>
<body>
    <div class="container" > <br>
        <?php include 'header.php'; ?>

        <main class="main">
        <div class="content">
            <p class='text'>
                <a href="dashboard.php">
                    Retour
                </a>
            </p>

            <h2 class='black-title'>
                Fiche client
            </h2>

            <?php
                while($data = $req->fetch()){?>
                            <div class="user">
                            Email: <span><?=$data['email']?></span>
                            <a href="deleteUser.php?id=<?=$data['id']?>">
                                            <i class="fas fa-trash"></i></a><br>

                            Contact: <span><?=$data['phone']?></span>

                            <div class="cards">
                                <div class="card">
                                    <a href="public/img/<?=$data['bill']?>">
                                        <img src="public/img/<?=$data['bill']?>" alt="">
                                    </a><br>
                                    <span>Facture EDF </span>
                                </div>
                            </div>

                            <div class="cards">
                                 <div class="card">
                                    <a href="public/img/<?=$data['salon1']?>">
                                            <img src="public/img/<?=$data['salon1']?>" alt="">
                                        </a> <br>
                                        <span>Salon 1 </span>
                                </div>

                                <div class="card">
                                    <a href="public/img/<?=$data['salon2']?>">
                                            <img src="public/img/<?=$data['salon2']?>" alt="">
                                        </a><br>
                                        <span>Salon 2  </span>
                                </div>

                                <div class="card">
                                    <a href="public/img/<?=$data['salon3']?>">
                                            <img src="public/img/<?=$data['salon3']?>" alt="">
                                        </a><br>
                                        <span>Salon 3</span>
                                </div>

                                <div class="card">
                                    <a href="public/img/<?=$data['salon4']?>">
                                            <img src="public/img/<?=$data['salon4']?>" alt="">
                                        </a><br>
                                    <span>Salon 4</span>
                                </div>
                            </div> <br>

                            <div class="cards">
                                 <div class="card">
                                    <a href="public/img/<?=$data['salle_a_manger1']?>">
                                            <img src="public/img/<?=$data['salle_a_manger1']?>" alt="">
                                        </a> <br>
                                        <span>Salle à manger 1 </span>
                                </div>

                                <div class="card">
                                    <a href="public/img/<?=$data['salle_a_manger2']?>">
                                            <img src="public/img/<?=$data['salle_a_manger2']?>" alt="">
                                        </a><br>
                                        <span>salle à manger 2 </span>
                                </div>

                                <div class="card">
                                    <a href="public/img/<?=$data['salle_a_manger3']?>">
                                            <img src="public/img/<?=$data['salle_a_manger3']?>" alt="">
                                        </a><br>
                                        <span>Salle à manger 3</span>
                                </div>

                                <div class="card">
                                    <a href="public/img/<?=$data['salle_a_manger4']?>">
                                            <img src="public/img/<?=$data['salle_a_manger4']?>" alt="">
                                        </a><br>
                                    <span>salle à manger 4</span>
                                </div>
                            </div> <br>

                            <div class="cards">
    <div class="card">
    <a href="public/img/<?=$data['chambre1']?>">
            <img src="public/img/<?=$data['chambre1']?>" alt="">
        </a> <br>
        <span>Chambre 1 </span>
    </div>

    <div class="card">
    <a href="public/img/<?=$data['chambre2']?>">
            <img src="public/img/<?=$data['chambre2']?>" alt="">
        </a><br>
        <span>Chambre 2 </span>
    </div>

    <div class="card">
    <a href="public/img/<?=$data['chambre3']?>">
            <img src="public/img/<?=$data['chambre3']?>" alt="">
        </a><br>
        <span>Chambre 3</span>
    </div>

    <div class="card">
    <a href="public/img/<?=$data['chambre4']?>">
            <img src="public/img/<?=$data['chambre4']?>" alt="">
        </a><br>
    <span>Chambre 4</span>
    </div>

    <div class="card">
    <a href="public/img/<?=$data['chambre5']?>">
            <img src="public/img/<?=$data['chambre5']?>" alt="">
        </a><br>
        <span>Chambre 5</span>
    </div>

    <div class="card">
    <a href="public/img/<?=$data['chambre6']?>">
            <img src="public/img/<?=$data['chambre6']?>" alt="">
        </a><br>
    <span>Chambre 6</span>
    </div>
</div>

                        </div>
                <?php }
            ?>
        </div>
        </main>
    </div>

</body>
</html>