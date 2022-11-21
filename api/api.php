<?php
 session_start();
//local
$pdo = new PDO('mysql:dbname=eco;host=localhost', 'root', '');
function getConnexion(){
    return new PDO("mysql:host=localhost; dbname=eco; charset=UTF8", "root", "");
}


//production
/*
function getConnexion(){
    return new PDO("mysql:host=localhost; dbname=hdwu6055_eco; charset=UTF8",
    "hdwu6055_eco", "Akk7t1KRrN4Q");
}

$pdo = new PDO('mysql:dbname=hdwu6055_eco;host=localhost', 'hdwu6055_eco', 'Akk7t1KRrN4Q');
*/
$error = array('error' => false);
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}




function str_random($length){
        $alphabet="0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";

        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    // obtenir le titre de la page
    function PageName() {
        return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
      }

      $current_page = PageName();

    //controle des input
    function verifyInput($inputContent){
        $inputContent = htmlspecialchars(
            $inputContent
        );

        $inputContent = trim($inputContent);

        return $inputContent;
    }

function register(){
    $pdo = getConnexion();
    if (!empty ($_POST)){
        $errors = array();

      /*  if (empty ($_POST['bill'])) {
            $errors['bill'] = 'Veuillez inserer la facture EDF';
        }
        */

        if (empty ($_POST['phone'])) {
            $errors['phone'] = 'Numero de telephone non valide';
        }

        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] ='Email non valide';
        } else{
            $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $req->execute([$_POST['email']]);
            $email = $req->fetch();
            if($email){
                $errors['email'] = "Ce email est déjà utilisé";
            }
        }


        if (!empty($errors)){
                $_SESSION['register']=[
                    'phone' => verifyInput($_POST['email']),
                    'email' => verifyInput($_POST['email']),
                ]
            ?>

            <div class="alert" width=400>
                <P>
                    Merci de corriger les erreurs suivantes:
                </P>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                        <li style="color: red;"><?= $error; ?></li>
                        <?php endforeach;?>
                    </ul>
            </div>
           <?php }

        if(empty($errors)){
            $email = verifyInput($_POST['email']);
            $phone = verifyInput($_POST['phone']);
            $status = 'En attente';
            $role = 'user';

            $sql = $pdo->prepare("INSERT INTO users SET date_of_insertion = NOW(),
            email = ?, phone = ?, role = ?, status = ?");

            $sql->execute(array($email, $phone, $role, $status));

          $user_id = $pdo->lastInsertId();

          $bill = time() . '_' .$_FILES['bill'] ['name'];
          $salon = time() . '_' .$_FILES['salon'] ['name'];
          $salle_a_manger = time() . '_' .$_FILES['salle_a_manger'] ['name'];
          $chambre = time() . '_' .$_FILES['chambre'] ['name'];

          $target = '../public/img/' .$bill;

          if( move_uploaded_file($_FILES['bill']['tmp_name'], $target)){

              $req = $pdo -> prepare ("UPDATE users SET
              bill = ? WHERE id = ? ");

             $req -> execute([$bill, $user_id]);
          }

          $target = '../public/img/' .$salon;
          if( move_uploaded_file($_FILES['salon']['tmp_name'], $target)){

            $req = $pdo -> prepare ("UPDATE users SET
            salon = ? WHERE id = ? ");

           $req -> execute([$salon, $user_id]);
        }

        $target = '../public/img/' .$salle_a_manger;
        if( move_uploaded_file($_FILES['salle_a_manger']['tmp_name'], $target)){

            $req = $pdo -> prepare ("UPDATE users SET
            salle_a_manger = ? WHERE id = ? ");

           $req -> execute([$salle_a_manger, $user_id]);
        }

        $target = '../public/img/' .$chambre;
        if( move_uploaded_file($_FILES['chambre']['tmp_name'], $target)){

            $req = $pdo -> prepare ("UPDATE users SET
            chambre = ? WHERE id = ? ");

           $req -> execute([$chambre, $user_id]);
        }



            ?>
            <script>
                alert("Inscription réussie, un email vous sera envoyé pour finalisation");
            window.location.replace("../index.php");
                </script>
            <?php
         }

        }
    }



if($action == 'register'){
    register();
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
    sendJSON($datas);
  // return $datas;
}

function login(){
    if(!empty($_POST)){
        $pdo = getConnexion();

        $errors = array ();

        if(isset($_POST['username'], $_POST['pass'])
            &&!empty($_POST['username'] && !empty($_POST['pass']))
            ){

            $sql = "SELECT * FROM `users` WHERE `username` = ?";

            $query = $pdo -> prepare($sql);

            $query->execute([verifyInput($_POST['username'])]);

            $user = $query->fetch();

            if(!$user){
                $errors['username'] = 'Utilisateur/mot de passe incorrect';
            }

            if(!password_verify($_POST['pass'], $user['pass'])){
                $errors['pass'] = 'Utilisateur/mot de passe incorrect';
            }

            if(!empty($errors)){
                    $_SESSION['login']=[
                        'username' => verifyInput($_POST['username'])
                    ]
                ?>

               <script>
                alert('Veuillez verifier vos identifiants');
                window.location.replace('../login.php')
               </script>
            <?php }

            if (empty($errors)){

                session_start();

                $_SESSION['user'] = [
                    "username" =>$user['username'],
                    "role" => $user['admin']
                ];

                header("Location: ../dashboard.php");
            }

            }
    }
}

function logout(){
    unset($_SESSION['user']);

    header("Location: ../index.php");
}

if($action == 'login'){
    login();
}

if($action == 'logout'){
    logout();
}

    function sendJSON($infos)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode($infos, JSON_UNESCAPED_UNICODE);
    }