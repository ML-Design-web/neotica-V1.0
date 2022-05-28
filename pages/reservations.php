<?php
require_once('../controllers/connect-database.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOTICA | Réserver un créneau</title>

    <!-- CSS MAIN -->
    <link rel="stylesheet" href="../assets/style/style.css">

    <!-- CSS OTHERS -->


</head>

<body>


    <main>
        <?php
        include_once('../include/sidenav.php')
        ?>

        <div class="scale-container">
            <div class="container">
                <h1>Réserver un créneau :</h1>
                <br>

                <div class="table-view">
                    <?php
                    if (!empty($_SESSION)) {
                        echo '<div class="d-flex row" style="justify-content: center;
    column-gap: 25px;">';

                        require_once('../include/form_resa.php');
                    ?>
                        <div class="table-container">

                        <?php
                        require_once('../controllers/afficheTableEmpruntsAdh.php');

                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo "<h1> Vous n'avez pas la permission d'accéder à cette page</h1>";
                    }
                        ?>
                        </div>
                </div>
            </div>
    </main>


    <!-- ###### FOOTER ###### -->
    <?php
    include_once('../include/footer.php');
    ?>
    <!---->


</body>

</html>