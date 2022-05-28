<?php
require('connect-database.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'une base de données</title>

    <!-- CSS MAIN -->
    <link rel="stylesheet" href="../assets/style/style.css">

    <!-- CSS OTHERS -->


</head>

<body>
    <main>
        <!-- ###### SIDENAV ###### -->
        <?php
        include_once('../include/sidenav.php');
        ?>
        <!---->



        <div class="scale-container">
            <div class="container">

                <h1>Se connecter</h1>

                <div class="sp-150"></div>

                <div class="card text-center">
                    <h1>Connexion</h1>
                    <br><br>
                    <form action="connect-normal.php" method="POST" class="d-flex align-center column">
                        <label for="id">Identifiant</label>
                        <input type="text" name="id" id="id" placeholder="Identifiant" required>

                        <label for="passwrd">Mot de passe</label>
                        <input type="password" name="passwrd" id="passwrd" placeholder="Mot de passe" required>
                        <br>
                        <input type="submit" value="Connexion">
                    </form>

                    <?php
                    // ------------- CODE PHP - COEUR DE LA CONNEXION UTILISATEUR NORMALE -------------- //
                    require_once('../include/core/connect-core.php');
                    // ---------------------------------------------------------------------------------//
                    ?>

                    <br>
                    <a href="../passwrd-recovery.php">Mot de passe oublié</a>
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