<?php session_start();

if (!isset($_SESSION['detail'])) {
    header("Location: login.php");
    exit;
}

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
                Bonjour <strong class='detailname'><?= $_SESSION['detail']['detailname'] ?></strong> , content de vous revoir
            </p>

            <table v-if='showdetails'>
                <caption>Liste des inscrits</caption>
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                </tr>
                </thead>
                <tbody>
                         <tr v-for='detail in details' :key='detail.id'>
                                            <td data-label="Date">{{ detail.date_of_insertion }}</td>
                                            <td data-label="Email">{{ detail.email }}</td>
                                            <td data-label="Contact">{{ detail.phone }}</td>
                                    </tr>
                </tbody>
            </table>

            <br>

            <button class='button'>
                Telecharger en PDF
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
                    details: [],
                    showdetails: false
                }
            },
            mounted: function() {
                this.displaydetails();
            },
            methods: {
                displaydetails() {
                    axios.get('https://eco-agir.industreet972.com/api/details').then(response =>
                        this.details = response.data)
                        this.showdetails = true;
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