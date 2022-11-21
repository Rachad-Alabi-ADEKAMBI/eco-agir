<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO('mysql:dbname=eco;host=localhost', 'root', '');
$req = $pdo->prepare("SELECT * FROM
users
    WHERE role = 'user'
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