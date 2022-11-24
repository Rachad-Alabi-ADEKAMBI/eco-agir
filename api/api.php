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

        if(empty($_POST['phone'])){
            $errors['phone'] ='Numero de telephone non valide';
        } else{
            $req = $pdo->prepare('SELECT phone FROM users WHERE phone = ?');
            $req->execute([$_POST['phone']]);
            $data = $req->fetch();
            if($data){
                $errors['phone'] = "Ce numero est déjà utilisé";
            }
        }


        if (!empty($errors)){
                $_SESSION['register']=[
                    'phone' => verifyInput($_POST['phone']),
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
          $salon1 = time() . '_' .$_FILES['salon1'] ['name'];
          $salon2 = time() . '_' .$_FILES['salon2'] ['name'];
          $salon3 = time() . '_' .$_FILES['salon3'] ['name'];
          $salon4 = time() . '_' .$_FILES['salon4'] ['name'];

          $salle_a_manger1 = time() . '_' .$_FILES['salle_a_manger1'] ['name'];
          $salle_a_manger2 = time() . '_' .$_FILES['salle_a_manger2'] ['name'];
          $salle_a_manger3 = time() . '_' .$_FILES['salle_a_manger3'] ['name'];
          $salle_a_manger4 = time() . '_' .$_FILES['salle_a_manger4'] ['name'];

          $chambre1 = time() . '_' .$_FILES['chambre1'] ['name'];
          $chambre2 = time() . '_' .$_FILES['chambre2'] ['name'];
          $chambre3 = time() . '_' .$_FILES['chambre3'] ['name'];
          $chambre4 = time() . '_' .$_FILES['chambre4'] ['name'];
          $chambre5 = time() . '_' .$_FILES['chambre5'] ['name'];
          $chambre6 = time() . '_' .$_FILES['chambre6'] ['name'];



          $target = '../public/img/' .$bill;

          if( move_uploaded_file($_FILES['bill']['tmp_name'], $target)){

              $req = $pdo -> prepare ("UPDATE users SET
              bill = ? WHERE id = ? ");

             $req -> execute([$bill, $user_id]);
          }

        $target = '../public/img/' .$salon1;
          if( move_uploaded_file($_FILES['salon1']['tmp_name'], $target)){

            $req = $pdo -> prepare ("UPDATE users SET
            salon1 = ? WHERE id = ? ");

           $req -> execute([$salon1, $user_id]);
        }

        $target = '../public/img/' .$salon2;
        if( move_uploaded_file($_FILES['salon2']['tmp_name'], $target)){

          $req = $pdo -> prepare ("UPDATE users SET
          salon2 = ? WHERE id = ? ");

         $req -> execute([$salon2, $user_id]);
      }

      $target = '../public/img/' .$salon3;
      if( move_uploaded_file($_FILES['salon3']['tmp_name'], $target)){

        $req = $pdo -> prepare ("UPDATE users SET
        salon3 = ? WHERE id = ? ");

       $req -> execute([$salon3, $user_id]);
    }


    $target = '../public/img/' .$salon4;
    if( move_uploaded_file($_FILES['salon4']['tmp_name'], $target)){

      $req = $pdo -> prepare ("UPDATE users SET
      salon4 = ? WHERE id = ? ");

     $req -> execute([$salon4, $user_id]);
  }




  $target = '../public/img/' .$salle_a_manger1;
  if( move_uploaded_file($_FILES['salle_a_manger1']['tmp_name'], $target)){

    $req = $pdo -> prepare ("UPDATE users SET
    salle_a_manger1 = ? WHERE id = ? ");

   $req -> execute([$salle_a_manger1, $user_id]);
  }

  $target = '../public/img/' .$salle_a_manger2;
  if( move_uploaded_file($_FILES['salle_a_manger2']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  salle_a_manger2 = ? WHERE id = ? ");

  $req -> execute([$salle_a_manger2, $user_id]);
  }

  $target = '../public/img/' .$salle_a_manger3;
  if( move_uploaded_file($_FILES['salle_a_manger3']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  salle_a_manger3 = ? WHERE id = ? ");

  $req -> execute([$salle_a_manger3, $user_id]);
  }


  $target = '../public/img/' .$salle_a_manger4;
  if( move_uploaded_file($_FILES['salle_a_manger']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  salle_a_manger4 = ? WHERE id = ? ");

  $req -> execute([$salle_a_manger4, $user_id]);
  }




  $target = '../public/img/' .$chambre1;
  if( move_uploaded_file($_FILES['chambre1']['tmp_name'], $target)){

    $req = $pdo -> prepare ("UPDATE users SET
    chambre1 = ? WHERE id = ? ");

   $req -> execute([$chambre1, $user_id]);
  }

  $target = '../public/img/' .$chambre2;
  if( move_uploaded_file($_FILES['chambre2']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  chambre2 = ? WHERE id = ? ");

  $req -> execute([$chambre2, $user_id]);
  }

  $target = '../public/img/' .$chambre3;
  if( move_uploaded_file($_FILES['chambre3']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  chambre3 = ? WHERE id = ? ");

  $req -> execute([$chambre3, $user_id]);
  }


  $target = '../public/img/' .$chambre4;
  if( move_uploaded_file($_FILES['chambre']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  chambre4 = ? WHERE id = ? ");

  $req -> execute([$chambre4, $user_id]);
  }

  $target = '../public/img/' .$chambre5;
  if( move_uploaded_file($_FILES['chambre5']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  chambre5 = ? WHERE id = ? ");

  $req -> execute([$chambre5, $user_id]);
  }


  $target = '../public/img/' .$chambre6;
  if( move_uploaded_file($_FILES['chambre6']['tmp_name'], $target)){

  $req = $pdo -> prepare ("UPDATE users SET
  chambre6 = ? WHERE id = ? ");

  $req -> execute([$chambre6, $user_id]);
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


function delete($id){
    if(empty($_POST)){
        $pdo = getConnexion();
     //   $id = verifyInput($_GET['id']);

              $sql = $pdo->prepare("UPDATE users SET status = 'Supprimé' WHERE id = ?");
              $sql->execute(array($id));
                ?>
                    <script>
                        alert('Suppression reussie !');
                        window.location.replace('../dashboard.php');
                    </script>
                <?php
    }
}

function logout(){
    unset($_SESSION['user']);

    header("Location: ../index.php");
}

if($action == 'register'){
    register();
}

if($action == 'delete'){
    $id = verifyInput($_GET['id']);
    delete($id);
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