<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>EcoAgir - Connexion</title>
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
            <form action="api/api.php?action=login" class="login"
                method='POST'>
                    <img src="public/img/Logo Ecoagir.png" alt="" class='logo'> <br>
                    <h1>Connexion</h1>

                <div class="details">
                    <label for="">Nom d'utilisateur: <br>
                        <input type="text" name='username' required value='<?=$_SESSION['login']['username']?>'>
                    </label> <br>

                    <label for="">Mot de passe: <br>
                        <input type="password" name='pass' required>
                    </label> <br> <br>

                    <button type='submit'>
                        Connexion
                    </button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>