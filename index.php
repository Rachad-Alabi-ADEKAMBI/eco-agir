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
                    <img src="public/img/logo-eco.jpg" alt="brasseur gratuit subventionne par EDF">
                    <img src="public/img/teaserbox_2440927305.png" alt="brasseur gratuit subventionne par EDF">
                     <ul>
                        <li>Pose offerte</li>
                        <li>Sans engagement </li>
                        <li>Sans frais</li>
                    </ul>
                </div>

                <h2>
                    1 SEULE CONDITION:
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
                        <input type="file" name='bill' required >
                    </label>


                        <label for="">Salon: <strong> (4 photos max)</strong> <br>
                         <input type="file" name='salon1'> <i class="fas fa-plus" id='moreSalonShowBtn'
                          onclick=moreSalonShow()></i>
                         <i class="fas fa-minus" id='moreSalonCloseBtn' onclick=moreSalonClose()></i>
                        </label>

                        <div class="" id='moreSalon' class='moreSalon'>
                        <label for="">Salon2:  <br>
                         <input type="file" name='salon2'  >
                        </label>

                        <label for="">Salon 3: <br>
                         <input type="file" name='salon3'  >
                        </label>

                        <label for="">Salon 4: <br>
                         <input type="file" name='salon4'  >
                        </label>
                        </div>



                        <label for="">salle à manger: <strong>(4 photos max)</strong> <br>
                        <input type="file" name='salle_a_manger1'> <i class="fas fa-plus" id='moreSalleShowBtn'
                          onclick=moreSalleShow()></i>
                         <i class="fas fa-minus" id='moreSalleCloseBtn' onclick=moreSalleClose()></i>
                        </label>

                        <div class="moreSalle" id='moreSalle'>
                            <label for="">salle à manger 2: <br>
                        <input type="file" name='salle_a_manger2'>
                            </label>

                            <label for="">salle à manger 3: <br>
                        <input type="file" name='salle_a_manger3'>
                            </label>

                            <label for="">salle à manger 4: <br>
                        <input type="file" name='salle_a_manger4'>
                            </label>
                        </div>




                        <label for="">Chambre: <strong>(6 photos max)</strong> <br>
                            <input type="file" name='chambre1'> <i class="fas fa-plus" id='moreChambreShowBtn'
                            onclick=moreChambreShow()></i>
                            <i class="fas fa-minus" id='moreChambreCloseBtn' onclick=moreChambreClose()></i>

                        </label>

                        <div class="moreChambre" id='moreChambre'>

                            <label for="">Chambre 2: <br>
                            <input type="file" name='chambre2'>
                            </label>

                            <label for="">Chambre 3: <br>
                            <input type="file" name='chambre3'>
                            </label>

                            <label for="">Chambre 4: <br>
                            <input type="file" name='chambre4'>
                            </label>

                            <label for="">Chambre 5: <br>
                            <input type="file" name='chambre5'>
                            </label>

                            <label for="">Chambre 6: <br>
                            <input type="file" name='chambre6'>
                            </label>
                        </div>
                    </div>

                    <p>
                    <input type="checkbox" class='checkbox' required>   Je confirme être un abonné EDF
                    </p>


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
    <script>
        function moreSalonShow(){
            document.getElementById("moreSalon").style.display = "block";
            document.getElementById("moreSalonShowBtn").style.display = "none";
            document.getElementById("moreSalonCloseBtn").style.display = "block";
        }

        function moreSalonClose(){
            document.getElementById("moreSalon").style.display = "none";
            document.getElementById("moreSalonCloseBtn").style.display = "none";
            document.getElementById("moreSalonShowBtn").style.display = "block";
        }


        function moreSalleShow(){
            document.getElementById("moreSalle").style.display = "block";
            document.getElementById("moreSalleShowBtn").style.display = "none";
            document.getElementById("moreSalleCloseBtn").style.display = "block";
        }

        function moreSalleClose(){
            document.getElementById("moreSalle").style.display = "none";
            document.getElementById("moreSalleCloseBtn").style.display = "none";
            document.getElementById("moreSalleShowBtn").style.display = "block";
        }


        function moreChambreShow(){
            document.getElementById("moreChambre").style.display = "block";
            document.getElementById("moreChambreShowBtn").style.display = "none";
            document.getElementById("moreChambreCloseBtn").style.display = "block";
        }

        function moreChambreClose(){
            document.getElementById("moreChambre").style.display = "none";
            document.getElementById("moreChambreCloseBtn").style.display = "none";
            document.getElementById("moreChambreShowBtn").style.display = "block";
        }
    </script>
</body>
</html>