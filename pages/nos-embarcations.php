<?php
require_once('../controllers/connect-database.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOTICA | Paiement de la cotisation</title>

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
                <div class="d-flex align-center cot-title">
                    <?php
                    if (!empty($_SESSION)) {
                    ?>
                        <h1>Nos embarcations :</h1>
                </div>
                <br>
                <div class="table-view">
                    <div class="table-container">

                        <?php
                        require_once('../controllers/afficheTableEmbarcations.php');

                        if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'plagiste') {

                            include_once('../include/editMenu.php');

                            if (isset($usedEmb)) {
                                $usedEmb = true;
                                if ($usedEmb == true) {
                        ?>
                                    <div class="center">
                                        <form action="" method="get">
                                            <input type="hidden" name="immat" value="<?php echo $imm_emb ?>" />
                                            <input type="submit" value="supprimer de toutes les tables (cette action est irréversible)" />
                                        </form>
                                        <br>
                                        <button><a href="gestion-des-reservations.php">Voir les reservations</a></button>
                                    </div>
                                <?php
                                }
                            }
                            if (!empty($_GET)) {
                                $immat = $_GET['immat'];
                                $deleteAllEmb = $bdd->prepare("DELETE FROM emprunt WHERE emprunt.imm_emb = '$immat'");
                                try {
                                    $deleteAllEmb->execute();
                                } catch (PDOException $th) {
                                ?> <div class="error-message">
                                        Oups ! une erreur est survenue veuillez réessayer.
                                    </div> <?php
                                        }
                                    }
                                }
                            } else {
                                echo "<h1> Pour accéder à cette page veuillez vous connecter</h1>";
                            }
                                            ?>

                    </div>
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