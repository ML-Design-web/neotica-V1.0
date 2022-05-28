<?php
require_once('controllers/connect-database.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOTICA | Récupération du mot de passe</title>

    <!-- CSS MAIN -->
    <link rel="stylesheet" href="assets/style/style.css">

    <!-- CSS OTHERS -->


</head>

<body>
    <main>
        <!-- INCLUDE SIDE NAV on all pages -->
        <?php
        include_once('include/sidenav.php')
        ?>
        <!-- ----------------------------- -->

        <!--  CONTENEUR DU CONTENU qui comporte le décalage de la side nav -->
        <div class="center scale-container">
            <div class=" container">
                <div class="card text-center">
                    <h1>Récupération du mot de passe : </h1>
                    <div class="sp-50"></div>
                    <?php
                    $ableToEdit = false;
                    // formulaire de récupération du mdp
                    if (empty($_POST['recoId']) && $ableToEdit == false) { ?>
                        <!-- récupération de l'id -->
                        <form action="" method="POST">
                            <div class="input-box">
                                <label for="id">Rentrez votre identifiant :</label>
                                <input type="text" name="id" id="id">
                            </div>
                            <br>
                            <input type="submit" value="Envoyer" name="recoId">
                        </form>
                        <?php
                    }
                    if (!empty($_POST['recoId']) && empty($_POST['verifInfos']) && empty($_POST['newpassword'])) {

                        $queryId = $_POST['id'];

                        // vérifier si l'id rentré existe
                        $infoId = $bdd->prepare("SELECT * FROM adherent where adherent.id = '$queryId'");
                        $infoId->execute();
                        try {
                            $infoId = $infoId->fetch();
                            /*   */
                        } catch (PDOException $th) {
                            //throw $th;
                        ?>
                            <div class="error-message">
                                Une erreur inconnue s'est produite !
                            </div>
                        <?php
                        }
                        if ($infoId) { ?>
                            <h4>Rentrez vos informations pour vérifier que c'est bien vous</h4> <!-- vérification de informations -->
                            <div class="sp-50"></div>
                            <form action="" method="POST">
                                <div class="d-flex modal-form">
                                    <input type="hidden" name="queryId" value="<?php echo $queryId; ?>">
                                    <div class="input-box">
                                        <label for="prenom">Rentrez votre prénom :</label>
                                        <input type="text" name="prenom" id="prenom">
                                    </div>
                                    <div class="input-box">
                                        <label for="nom">Rentrez votre nom :</label>
                                        <input type="text" name="nom" id="nom">
                                    </div>
                                    <div class="input-box">
                                        <label for="ville">Rentrez votre ville :</label>
                                        <input type="text" name="ville" id="ville">
                                    </div>
                                    <div class="input-box">
                                        <label for="cp">Rentrez votre code postal :</label>
                                        <input type="number" name="cp" id="cp">
                                    </div>
                                    <div class="input-box">
                                        <label for="mail">Rentrez votre Mail :</label>
                                        <input type="text" name="mail" id="mail">
                                    </div>
                                    <div class="input-box">
                                        <label for="tel">Rentrez votre numéro de téléphone :</label>
                                        <input type="number" name="tel" id="tel">
                                    </div>
                                    <div class="input-box">
                                        <label for="birthdate">Rentrez votre date de naissance :</label>
                                        <input type="date" name="birthdate" id="birthdate">
                                    </div>
                                    <div class="input-box">
                                        <label for="activite">Rentrez votre activité :</label>
                                        <input type="text" name="activite" id="activite">
                                    </div>
                                </div>
                                <br>
                                <input type="submit" value="Vérifier" name="verifInfos">

                            </form>
                        <?php
                        } else if ($infoId == false && empty($_POST['verifInfos'])) { ?>
                            <!-- si les informations sont fausses retourne le formulaire de départ avec un message d'erreur -->
                            <form action="" method="POST">
                                <div class="input-box">
                                    <label for="id">Rentrez votre identifiant :</label>
                                    <input type="text" name="id" id="id">
                                </div>
                                <br>
                                <input type="submit" value="Envoyer" name="recoId">
                            </form>
                            <br>
                            <div class="id-false">
                                Cet identifiant est inconnue à notre base de donnée !
                            </div>
                        <?php
                        }
                    }
                    if (!empty($_POST['verifInfos'])) { /* vérification des informations */
                        $queryId = $_POST['queryId'];
                        // vérifier les infos de l'id rentré
                        $infoId = $bdd->prepare("SELECT * FROM adherent where adherent.id = '$queryId'");
                        $infoId->execute();
                        try {
                            $infoId = $infoId->fetch();
                        } catch (PDOException $th) {
                            //throw $th;
                        ?>
                            <div class="error-message">
                                Une erreur inconnue s'est produite !
                            </div>
                        <?php
                        }
                        /* var_dump($_POST, $infoId); */
                        if (
                            $_POST['prenom'] == $infoId['pre_adh'] &&
                            $_POST['nom'] == $infoId['nom_adh'] &&
                            $_POST['ville'] == $infoId['ville_adh'] &&
                            $_POST['cp'] == $infoId['cp_adh'] &&
                            $_POST['mail'] == $infoId['email_adh'] &&
                            $_POST['tel'] == $infoId['tel_adh'] &&
                            $_POST['birthdate'] == $infoId['date_nais_adh'] &&
                            $_POST['activite'] == $infoId['activ_adh']
                        ) {
                            $ableToEdit = true; /* toggle $abletoedit si toutes les informations sont correctement rentrées */
                        }
                    }
                    if ($ableToEdit == true) { /* si true */
                        $queryId = $_POST['queryId'];
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="queryId" value="<?php echo $queryId; ?>">
                            <div class="input-box">
                                <label for="password">Rentrez votre nouveau mot de passe :</label>
                                <input type="text" name="password" id="password">
                            </div>
                            <br>
                            <input type="submit" value="Modifier" name="newpassword">
                        </form>
                    <?php
                    } else if ($ableToEdit == false && !empty($_POST['verifInfos'])) { ?>
                        <div class="id-false">
                            Les informations que vous venez de rentrer ne correspondent pas avec votre profil.
                        </div>
                        <br>
                        <button><a href="index.php">Retourner à l'accueil</a></button>
                        <?php
                    }
                    if (!empty($_POST['newpassword'])) {
                        $queryId = $_POST['queryId'];
                        $newPassword = md5($_POST['password']);
                        $ableToEdit = true;

                        $updatePassword = $bdd->prepare("UPDATE adherent SET adherent.mot_de_passe = '$newPassword' WHERE adherent.id = '$queryId'"); /* requete de modification du mdp */
                        try {
                            $updatePassword->execute();
                        } catch (PDOException $th) {
                            //throw $th;
                        ?>
                            <div class="error-message">
                                Une erreur inconnue s'est produite veuillez réessayer.
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
    </main>

    <!-- ###### FOOTER ###### -->
    <?php
    include_once('include/footer.php');
    ?>
    <!---->

</body>

</html>