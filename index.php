<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>
    <meta name="description" content="Utilisez ce lien pour obtenir gratuitement votre brasseur avant le 31/12/2022">

    <title>Eco - Accueil </title>
</head>
<body>
    <div class="container">
        <?php
           if (isset($_SESSION['user'])) {
             include 'header.php';
           }
        ?>
        <main class="main">
            <div class="top ">
                <h1>
                    Obtenez  gratuitement
                      votre brasseur d'air <span class='blink'>jusqu'au 31/12/2022</span>
                </h1>
            </div>

            <div class="content">
                <div class="images">
                    <img src="public/img/logo-eco.jpeg" alt="">
                    <img src="public/img/logo-eco.jpeg" alt="">
                     <ul>
                        <li>Pose offerte</li>
                        <li>Sans engagement </li>
                        <li>Sans frais</li>
                    </ul>
                </div>

                <h2>
                    1 SEULE CONDITION
                </h2>

                <strong>
                     Etre un abonné EDF
                </strong>

                <form action="api/api.php?action=register" method='POST'
                class="form"
                enctype="multipart/form-data">
                    <div class="form__details">
                    <label for="">
                        Contact: <span>*</span><br>
                        <input type="number" name='phone' required
                        value='<?=$_SESSION['register']['phone']?>'
                        onkeyup="if(this.value<0){this.value= this.value * -1}" >
                    </label>

                    <label for="">
                        Email: <span>*</span><br>
                        <input type="email" name='email' required
                            value='<?=$_SESSION['register']['email']?>'>
                    </label>


                    </div>

                    <div class="form__details">
                    <label for="">
                        Facture EDF: <span>*</span> <br>
                        <input type="file" name='bill' required>
                    </label>


                        <label for="">Salon: <br>
                         <input type="file" name='salon' >
                        </label>

                        <label for="">salle à manger: <br>
                       <input type="file" name='salle_a_manger'>
                        </label>

                        <label for="">Chambre: <br>
                       <input type="file" name='chambre'>
                        </label>
                    </div>

                    <div class="line">
                        <input type="checkbox" class='checkbox' required>   Je confirme être un abonné EDF
                    </div>

                    <p>
                    Vous serez recontacté sous 48H pour finaliser le bon de  commande
                    </p>

                    <button type='submit'>
                    Je veux mon brasseur
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>