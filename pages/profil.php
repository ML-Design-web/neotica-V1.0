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
                <h1>Votre profil :</h1>
                <br>

                <div class="table-view">
                    <?php
                    if (!empty($_SESSION)) {
                        $id = $_SESSION['id'];
                        $profil = $bdd->prepare("SELECT adherent.* FROM adherent WHERE adherent.id = '$id'");
                        $profil->execute();
                        try {
                            $profilArray = $profil->fetch();
                        } catch (PDOException $th) {
                            //throw $th;
                    ?>
                            <div class="error-message">
                                Une erreur inconnue s'est produite.
                            </div>
                        <?php
                        }
                        ?>
                        <div class="pi-5 d-flex row space-between header-title ">
                            <div class="d-flex column">
                                <p>Bienvenue sur votre profil !</p>
                                <h1><?php echo $profilArray['pre_adh'] . ' ' . $profilArray['nom_adh'] ?></h1>
                            </div>
                            <span id="profil-pic"></span>
                        </div>
                        <br>
                        <div class="d-flex row" style="justify-content: center;column-gap: 25px;">
                            <form action="" method="POST">
                                <div class="d-flex modal-form">
                                    <div class="input-box">
                                        <label for="id">Identifiant :</label>
                                        <input type="text" id="id" value="<?php echo $profilArray['id'] ?>" name="id" readonly>
                                    </div>
                                    <div class="input-box">
                                        <label for="droit">Droit :</label>
                                        <input type="number" id="droit" value="<?php echo $profilArray['droit'] ?>" name="droit" readonly>
                                    </div>
                                    <div class="input-box">
                                        <label for="adresse">Adresse :</label>
                                        <input type="text" value="<?php echo $profilArray['ad_adh'] ?>" name="adresse" id="adresse">
                                    </div>
                                    <div class="input-box">
                                        <label for="cp">Code postal :</label>
                                        <input type="number" value="<?php echo $profilArray['cp_adh'] ?>" name="cp" id="cp">
                                    </div>
                                    <div class="input-box">
                                        <label for="ville">Ville :</label>
                                        <input type="text" value="<?php echo $profilArray['ville_adh'] ?>" name="ville" id="ville">
                                    </div>
                                    <div class="input-box">
                                        <label for="date_nais">Date de naissance :</label>
                                        <input type="date" value="<?php echo $profilArray['date_nais_adh'] ?>" name="date_nais" id="date_nais" readonly>
                                    </div>
                                    <div class="input-box">
                                        <label for="tel">Télephone :</label>
                                        <input type="number" value="<?php echo $profilArray['tel_adh'] ?>" name="tel" id="tel">
                                    </div>
                                    <div class="input-box">
                                        <label for="mail">E-mail :</label>
                                        <input type="text" value="<?php echo $profilArray['email_adh'] ?>" name="mail" id="mail">
                                    </div>
                                    <div class="input-box">
                                        <label for="activite">Activité :</label>
                                        <input type="text" value="<?php echo $profilArray['activ_adh'] ?>" name="activite" id="activite">
                                    </div>
                                    <div class="input-box">
                                        <label for="date_crea">Date de création de votre profil :</label>
                                        <input type="date" value="<?php echo $profilArray['date_crea_adh'] ?>" name="date_crea" id="date_crea" readonly>
                                    </div>
                                    <div class="input-box">
                                        <label for="date_crea_carte">Date de délivrance de votre carte :</label>
                                        <input type="date" value="<?php echo $profilArray['date_deliv_carte_adh'] ?>" name="date_crea_carte" id="date_crea_carte" readonly>
                                    </div>
                                    <div class="input-box">
                                        <label for="date_expi_carte">Date d'expiration de votre carte :</label>
                                        <input type="date" value="<?php echo $profilArray['date_exp_carte_adh'] ?>" name="date_expi_carte" id="date_expi_carte" readonly>
                                    </div>
                                </div>
                            </form>



                        <?php
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