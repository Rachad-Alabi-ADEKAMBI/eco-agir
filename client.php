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

$pdo = new PDO('mysql:dbname=eco;host=localhost', 'root', '');
$req = $pdo->prepare("SELECT * FROM
users
    WHERE id = ?");
$req->execute(array(verifyInput($_GET['id'])));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>Eco - Fiche client</title>
</head>
<body>
    <div class="container" id='app'> <br>
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
                            Email: <span><?=$data['email']?></span><br>

                            Contact: <span><?=$data['phone']?></span>

                            <div class="cards">
                                <div class="card">
                                    <a href="public/img/<?=$data['bill']?>">
                                        <img src="public/img/<?=$data['bill']?>" alt="">
                                    </a><br>
                                    <span>Facture EDF </span>
                                </div>

                                <div class="card">
                                <a href="public/img/<?=$data['salon']?>">
                                        <img src="public/img/<?=$data['salon']?>" alt="">
                                    </a> <br>
                                    <span>Salon </span>
                                </div>

                                <div class="card">
                                <a href="public/img/<?=$data['salle_a_manger']?>">
                                        <img src="public/img/<?=$data['salle_a_manger']?>" alt="">
                                    </a><br>
                                    <span>Salle a manger </span>
                                </div>

                                <div class="card">
                                <a href="public/img/<?=$data['chambre']?>">
                                        <img src="public/img/<?=$data['chambre']?>" alt="">
                                    </a><br>
                                    <span>Chambre </span>
                                </div>
                            </div>

                        </div>
                <?php }
            ?>
        </div>
        </main>
    </div>

    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    users: [],
                    showUsers: false
                }
            },
            mounted: function() {
                this.displayUsers();
            },
            methods: {
                displayUsers() {
                    axios.get('http://127.0.0.1/eco/api/users').then(response =>
                        this.users = response.data)
                        this.showUsers = true;
                },
                format(num){
                let res = new Intl.NumberFormat('fr-FR', { maximumSignificantDigits: 3 }).format(num);
                return res;
            },
                getImgUrl(pic) {
                return "public/img/" + pic;
            },
            getPic(pic){
                window.location.replace('public/img/'+ pic);
            },
            convertDate(date){
                        function addDaysToDate(date, days){
                                var res = new Date(date);
                                res.setDate(res.getDate() + days);
                                return res;
                            }
                             next_date = addDaysToDate(date, 0);
                        return next_date.toLocaleDateString('fr');
                    }
            }
        }).mount('#app')
    </script>
</body>
</html>