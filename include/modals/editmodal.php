<?php

if ($_SERVER['PHP_SELF'] == "/pages/gestion-des-donnees.php") {

    $formvalid = isset($_POST['idSelect']); ?>

    <?php if (!$formvalid) { ?>
        <div class="modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <form action="" id="pre-form" onsubmit="keepModal()" method="post">
                    <div class="d-flex modal-form">
                        <div class="input-box">
                            <label for="id">Choisissez un ID à modifier :</label>
                            <select name="id" id="id" required>
                                <?php
                                var_dump($countArray);
                                if ($countArray != false) {
                                    for ($i = 0; $i < $arrayMaxLenght; $i++) {
                                        echo "<option value='$countArray[$i]'>";
                                        echo $countArray[$i];
                                        echo "</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <input type="submit" name="idSelect" id="select_button" value="Choisir">
                </form>
            </div>
        </div>

    <?php } else if (empty($_POST['edit-adh'])) {
        /* var_dump($_POST['id']); */
        $old_id = $_POST['id'];
        $adh_info_query = $bdd->prepare("SELECT * FROM adherent WHERE adherent.id = '$old_id'");
        $adh_info_query->execute();
        $adh_info = $adh_info_query->fetch(PDO::FETCH_NAMED);
    ?>
        <div class="active modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <div class="center pb-1">
                    <b> vous modifiez l'id : <?php echo $old_id; ?></b>
                    <br />
                </div>
                <form action="" method="post" required>
                    <div class="d-flex modal-form">
                        <!-- php var_dump($adh_info); ?-->
                        <input type="hidden" name="old_id" value="<?php echo $old_id; ?>">
                        <div class="input-box">
                            <label for="id">Identifiant :</label>
                            <input type="text" name="id" id="id" value="<?php echo $adh_info["id"] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="password">Mot de passe :</label>
                            <input type="text" name="password" id="password" value="<?php echo $adh_info['mot_de_passe'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" id="nom" value="<?php echo $adh_info['nom_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" id="prenom" value="<?php echo $adh_info['pre_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="droit">Droit :</label>
                            <input type="number" name="droit" id="droit" value="<?php echo $adh_info["droit"] ?>" min="1" max="3" maxlength="1" required>
                        </div>
                        <div class="input-box">
                            <label for="cp">Code postal :</label>
                            <input type="number" name="cp" id="cp" value="<?php echo $adh_info['cp_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="ville">Ville :</label>
                            <input type="text" name="ville" id="ville" value="<?php echo $adh_info['ville_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="date_nais">Date de naissance :</label>
                            <input type="date" name="date_nais" id="date_nais" value="<?php echo $adh_info['date_nais_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="tel">Téléphone :</label>
                            <input type="number" name="tel" id="tel" value="<?php echo $adh_info['tel_adh'] ?>" maxlength="12" required>
                        </div>
                        <div class="input-box">
                            <label for="mail">E-Mail :</label>
                            <input type="text" name="mail" id="mail" value="<?php echo $adh_info['email_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="activite">Activité :</label>
                            <input type="text" name="activite" id="activite" value="<?php echo $adh_info['activ_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="date_crea_adh">Date d'inscription :</label>
                            <input type="date" name="date_crea_adh" id="date_crea_adh" value="<?php echo $adh_info['date_crea_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="date_deliv_carte">Date de délivrance carte :</label>
                            <input type="date" name="date_deliv_carte" id="date_deliv_carte" value="<?php echo $adh_info['date_deliv_carte_adh'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="date_expi_carte">Date d'expiration carte :</label>
                            <input type="date" name="date_expi_carte" id="date_expi_carte" value="<?php echo $adh_info['date_exp_carte_adh'] ?>" required>
                        </div>
                    </div>
                    <br />

                    <input type="submit" name="edit-adh" value="Modifier">

                </form>
            </div>
        </div>

        <?php
    }
    if (!empty($_POST['edit-adh'])) {
        //variables du formulaire edit_adh
        $old_id = $_POST['old_id'];
        $id = $_POST['id'];
        $mdp = $_POST['password'];
        $droit = $_POST['droit'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $date_nais = $_POST['date_nais'];
        $tel = $_POST['tel'];
        $mail = $_POST['mail'];
        $activite = $_POST['activite'];
        $date_crea_adh = $_POST['date_crea_adh'];
        $date_deliv_carte = $_POST['date_deliv_carte'];
        $date_expi_carte = $_POST['date_expi_carte'];

        $editAdh = $bdd->prepare("UPDATE `adherent` SET `id` = '$id', `mot_de_passe`='$mdp' , `droit`= $droit , `nom_adh` = '$nom', `pre_adh`= '$prenom', `cp_adh` = '$cp', `ville_adh`='$ville', `date_nais_adh`='$date_nais', `tel_adh`='$tel', `email_adh`='$mail', `activ_adh`='$activite', `date_crea_adh`='$date_crea_adh', `date_deliv_carte_adh`='$date_deliv_carte', `date_exp_carte_adh`='$date_expi_carte' WHERE adherent.id = '$old_id'");
        /* var_dump($editAdh); */
        try {
            $editAdh->execute();
        } catch (PDOException $th) {
        ?>
            <div class="error-message">
                Une erreur s'est produite veuillez réessayer
            </div>
        <?php
        }
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/gestion-des-cotisations.php") {

    $idSelected1 = isset($_POST['idSelect1']);


    if (!$idSelected1) { ?>
        <div class="modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <form action="" id="pre-form" method="post">
                    <div class="d-flex modal-form">
                        <div class="input-box">
                            <label for="id">Choisissez un ID :</label>
                            <select name="id" id="id" required>
                                <?php
                                var_dump($countArray);
                                if ($countArray != false) {
                                    for ($i = 0; $i < $arrayMaxLenght; $i++) {
                                        echo "<option value='$countArray[$i]'>";
                                        echo $countArray[$i];
                                        echo "</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="idSelect1" id="select_button" value="Choisir">
                </form>
            </div>
        </div>

    <?php } else if ($idSelected1 && empty($_POST['dateSelect1'])) {
        $old_id = $_POST['id'];

        $dateFromId = $bdd->prepare("SELECT cotiser.date_cotise FROM cotiser WHERE cotiser.id = '$old_id'");
        try {
            $dateFromId->execute();
        } catch (PDOException $th) {
            echo '<div class="error-message">';
            echo 'Une erreur inconnue s\'est produite';
            echo '</div>';
        }
        while ($dateCot = $dateFromId->fetch()) {
            $dateCotResult[] = $dateCot[0];
        }
        if (!empty($dateCotResult)) {
            $lenDateCot = count($dateCotResult);
        }

    ?> <div class="active modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <form action="" id="pre-form" method="post">
                    <div class="d-flex modal-form">
                        <div class="input-box">
                            <input type="hidden" name="old_id" value="<?php echo $old_id; ?>">
                            <label for="date_cot">Choisissez une date de cotisation :</label>
                            <select name="date_cot" id="date_cot" required>
                                <?php

                                if ($lenDateCot != 0) {
                                    for ($i = 0; $i < $lenDateCot; $i++) {
                                        echo "<option value='$dateCotResult[$i]'>";
                                        echo $dateCotResult[$i];
                                        echo "</option>";
                                    }
                                } else {
                                    echo "<option value=''>";
                                    echo 'il \'a pas de cotisations pour cet ID';
                                    echo "</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="dateSelect1" id="select_button" value="Choisir">
                </form>
            </div>
        </div>
    <?php
    }
    if (isset($_POST['dateSelect1'])) {
        /* var_dump($_POST['id']); */
        $old_id = $_POST['old_id'];
        $old_date = $_POST['date_cot'];
        $cot_info_query = $bdd->prepare("SELECT * FROM cotiser WHERE cotiser.id = '$old_id'");
        $cot_info_query->execute();
        $cot_info = $cot_info_query->fetch(PDO::FETCH_NAMED);
    ?>
        <div class="active modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <div class="center pb-1">
                    <b> vous modifiez la cotisation de : <?php echo $old_id; ?></b>
                    <br />
                </div>
                <form action="" method="post" required>
                    <div class="d-flex modal-form">
                        <!-- php var_dump($adh_info); ?-->
                        <input type="hidden" name="old_id" value="<?php echo $old_id; ?>">
                        <input type="hidden" name="old_date" value="<?php echo $old_date; ?>">
                        <div class="input-box">
                            <label for="date">Date de cotisation :</label>
                            <input type="date" name="date" id="date" value="<?php echo $cot_info["date_cotise"] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="id">Identifiant :</label>
                            <input type="text" name="id_cot" id="id" value="<?php echo $cot_info['id'] ?>" required readonly>
                        </div>
                        <div class="input-box">
                            <label for="montant">Montant de la cotisation :</label>
                            <input type="number" name="montant" id="montant" value="<?php echo $cot_info['montant_cot'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="role">Rôle :</label>
                            <input type="text" name="role" id="role" value="<?php echo $cot_info['role_adh'] ?>" required>
                        </div>
                    </div>
                    <br />

                    <input type="submit" name="edit_cot" value="Modifier">
                </form>
            </div>
        </div>
        <?php
    }
    if (!empty($_POST['edit_cot'])) {
        //variables du formulaire edit_cot
        $old_id = $_POST['old_id'];
        $old_date = $_POST['old_date'];
        $date_cot = $_POST['date'];
        $id_cot = $_POST['id_cot'];
        $montant = $_POST['montant'];
        $role = $_POST['role'];

        $editCot = $bdd->prepare("UPDATE `cotiser` SET `date_cotise` = '$date_cot', `id`='$id_cot' , `montant_cot`= $montant , `role_adh` = '$role' WHERE cotiser.id = '$old_id' AND cotiser.date_cotise = '$old_date'");
        try {
            $editCot->execute();
        } catch (PDOException $th) {
        ?>
            <div class="error-message">
                Une erreur s'est produite veuillez réessayer
            </div>
        <?php
        }
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/gestion-des-reservations.php") {
    $idSelected1 = isset($_POST['idSelect1']);

    $idInEmpr = $bdd->prepare("SELECT emprunt.id FROM emprunt");
    try {
        $idInEmpr->execute();
    } catch (PDOException $th) {
        echo '<div class="error-message">';
        echo 'Une erreur inconnue s\'est produite';
        echo '</div>';
    }
    while ($idInEmprResult = $idInEmpr->fetch()) {
        $IdInEmprArray[] = $idInEmprResult[0];
    }
    if (!empty($IdInEmprArray)) {
        $lenIdInEmpr = count($IdInEmprArray);
    } else {
        $lenIdInEmpr = 0;
    }


    if (!$idSelected1) { ?>
        <div class="modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <form action="" id="pre-form" method="post">
                    <div class="d-flex modal-form">
                        <div class="input-box">
                            <label for="id">Choisissez un ID :</label>
                            <select name="id" id="id" required>
                                <?php
                                var_dump($countArray);
                                if ($lenIdInEmpr != 0) {
                                    for ($i = 0; $i < $lenIdInEmpr; $i++) {
                                        echo "<option value='$IdInEmprArray[$i]'>";
                                        echo $IdInEmprArray[$i];
                                        echo "</option>";
                                    }
                                } else {
                                    echo "<option value=''>";
                                    echo 'il n\'y a pas de réservations';
                                    echo "</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="idSelect1" id="select_button" value="Choisir">
                </form>
            </div>
        </div>

    <?php } else if ($idSelected1 && empty($_POST['dateSelect1'])) {
        $old_id = $_POST['id'];

        $dateFromId = $bdd->prepare("SELECT emprunt.date_empr FROM emprunt WHERE emprunt.id = '$old_id'");
        try {
            $dateFromId->execute();
        } catch (PDOException $th) {
            echo '<div class="error-message">';
            echo 'Une erreur inconnue s\'est produite';
            echo '</div>';
        }
        while ($dateEmpr = $dateFromId->fetch()) {
            $dateEmprResult[] = $dateEmpr[0];
        }
        if (!empty($dateEmprResult)) {
            $lenDateEmpr = count($dateEmprResult);
        }

    ?> <div class="active modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <form action="" id="pre-form" method="post">
                    <div class="d-flex modal-form">
                        <div class="input-box">
                            <input type="hidden" name="old_id" value="<?php echo $old_id; ?>">
                            <label for="date_empr">Choisissez une date de réservation :</label>
                            <select name="date_empr" id="date_empr" required>
                                <?php

                                if ($lenDateEmpr != 0) {
                                    for ($i = 0; $i < $lenDateEmpr; $i++) {
                                        echo "<option value='$dateEmprResult[$i]'>";
                                        echo $dateEmprResult[$i];
                                        echo "</option>";
                                    }
                                } else {
                                    echo "<option value=''>";
                                    echo 'il \'a pas de réservations pour cet ID';
                                    echo "</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="dateSelect1" id="select_button" value="Choisir">
                </form>
            </div>
        </div>
    <?php
    }
    if (isset($_POST['dateSelect1']) && empty($_POST['edit_resa'])) {
        /* var_dump($_POST['id']); */
        $old_id = $_POST['old_id'];
        $old_date = $_POST['date_empr'];
        $empr_info_query = $bdd->prepare("SELECT * FROM emprunt WHERE emprunt.id = '$old_id'");
        $empr_info_query->execute();
        $empr_info = $empr_info_query->fetch(PDO::FETCH_NAMED);
    ?>
        <div class="active modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <div class="center pb-1">
                    <b> vous modifiez la réservation de : <?php echo $old_id; ?></b>
                    <br />
                </div>
                <form action="" method="post" required>
                    <div class="d-flex modal-form">
                        <!-- php var_dump($adh_info); ?-->
                        <input type="hidden" name="old_id" value="<?php echo $old_id; ?>">
                        <input type="hidden" name="old_date" value="<?php echo $old_date; ?>">
                        <div class="input-box">
                            <label for="id">Identifiant :</label>
                            <input type="text" name="id_resa" id="id" value="<?php echo $empr_info['id'] ?>" required readonly>
                        </div>
                        <div class="input-box">
                            <label for="date_empr">Date de réservation :</label>
                            <input type="text" name="date_empr" id="date_empr" value="<?php echo $empr_info["date_empr"] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="immat">Immatriculation de l'embarcation :</label>
                            <input type="text" name="immat" id="immat" value="<?php echo $empr_info['imm_emb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="date_ret">Date de retour de l'emprunt :</label>
                            <input type="text" name="date_ret" id="date_ret" value="<?php echo $empr_info['date_retour_empr'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="etat_av">Etat avant :</label>
                            <input type="text" name="etat_av" id="etat_av" value="<?php echo $empr_info['etat_debut_empr'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="etat_ret">Etat après retour :</label>
                            <input type="text" name="etat_ret" id="etat_ret" value="<?php echo $empr_info['etat_retour_empr'] ?>" required>
                        </div>
                    </div>
                    <br />

                    <input type="submit" name="edit_resa" value="Modifier">
                </form>
            </div>
        </div>
        <?php
    }
    if (!empty($_POST['edit_resa'])) {
        //variables du formulaire edit_resa
        $id_resa = $_POST['id_resa'];
        $date_empr = $_POST['date_empr'];
        $immat = $_POST['immat'];
        $date_ret = $_POST['date_ret'];
        $etat_av = $_POST['etat_av'];
        $etat_ret = $_POST['etat_ret'];

        $editResa = $bdd->prepare("UPDATE `emprunt` SET `date_empr`='$date_empr' , `imm_emb`= '$immat' , `date_retour_empr` = '$date_ret', `etat_retour_empr` = '$etat_ret', `etat_debut_empr` = '$etat_av' WHERE emprunt.id = '$id_resa' AND emprunt.date_empr = '$date_empr'");
        try {
            $editResa->execute();
        } catch (PDOException $th) {
            echo $th;
        ?>
            <div class="error-message">
                Une erreur s'est produite veuillez réessayer
            </div>
        <?php
        }
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/nos-embarcations.php") {

    $idSelected = isset($_POST['idSelect']);

    $immatEmb = $bdd->prepare("SELECT embarcation.imm_emb FROM embarcation");
    try {
        $immatEmb->execute();
    } catch (PDOException $th) {
        echo '<div class="error-message">';
        echo 'Une erreur inconnue s\'est produite';
        echo '</div>';
    }
    while ($immatR = $immatEmb->fetch()) {
        $immatRarray[] = $immatR[0];
    }
    if (!empty($immatRarray)) {
        $lenImmat = count($immatRarray);
    }

    if (!$idSelected) { ?>
        <div class="modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <form action="" id="pre-form" method="post">
                    <div class="d-flex modal-form">
                        <div class="input-box">
                            <label for="immat">Choisissez une immatriculation :</label>
                            <select name="immat" id="immat" required>
                                <?php
                                var_dump($lenImmat);
                                if ($lenImmat != 0) {
                                    for ($i = 0; $i < $lenImmat; $i++) {
                                        echo "<option value='$immatRarray[$i]'>";
                                        echo $immatRarray[$i];
                                        echo "</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="idSelect" id="select_button" value="Choisir">
                </form>
            </div>
        </div>

    <?php } else if (empty($_POST['edit-emb'])) {
        /* var_dump($_POST['id']); */
        $old_immat = $_POST['immat'];
        $immat_info_query = $bdd->prepare("SELECT * FROM embarcation WHERE embarcation.imm_emb = '$old_immat'");
        $immat_info_query->execute();
        $immat_info = $immat_info_query->fetch(PDO::FETCH_NAMED);
    ?>
        <div class="active modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <div class="center pb-1">
                    <b> vous modifiez l'embarcation d'immatriculation : <?php echo $old_immat; ?></b>
                    <br />
                </div>
                <form action="" method="post" required>
                    <div class="d-flex modal-form">
                        <!-- php var_dump($adh_info); ?-->
                        <input type="hidden" name="old_immat" value="<?php echo $old_immat; ?>">
                        <div class="input-box">
                            <label for="immat">Immatriculation :</label>
                            <input type="text" name="immat" id="immat" value="<?php echo $immat_info["imm_emb"] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="type">Type d'embarcation :</label>
                            <input type="text" name="type" id="type" value="<?php echo $immat_info['type_emb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="type_abg">Type d'embarcation (abrégé):</label>
                            <input type="text" name="type_abg" id="type_abg" value="<?php echo $immat_info['type_abrege_emb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="prop">Propulsion :</label>
                            <input type="text" name="prop" id="prop" value="<?php echo $immat_info['prop_emb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="nom_serie">Nom de série :</label>
                            <input type="text" name="nom_serie" id="nom_serie" value="<?php echo $immat_info["nom_serie_emb"] ?>" min="1" max="3" maxlength="1" required>
                        </div>
                        <div class="input-box">
                            <label for="const">Constructeur :</label>
                            <input type="text" name="const" id="const" value="<?php echo $immat_info['constr_emb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="annee_constr">Année de construction :</label>
                            <input type="date" name="annee_constr" id="annee_constr" value="<?php echo $immat_info['annee_constr_emb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="nom_emb">Nom de l'embarcation :</label>
                            <input type="text" name="nom_emb" id="nom_emb" value="<?php echo $immat_info['nom_emb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="proprio">Propriétaire :</label>
                            <input type="text" name="proprio" id="proprio" value="<?php echo $immat_info['proprio_emb'] ?>" maxlength="12" required>
                        </div>
                        <div class="input-box">
                            <label for="large">Largeur :</label>
                            <input type="number" name="large" id="large" value="<?php echo $immat_info['large_mb'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="long">Longueur :</label>
                            <input type="number" name="long" id="long" value="<?php echo $immat_info['long_emb'] ?>" required>
                        </div>
                    </div>
                    <br />

                    <input type="submit" name="edit-emb" value="Modifier">
                </form>
            </div>
        </div>

        <?php
    }
    if (!empty($_POST['edit-emb'])) {
        //variables du formulaire edit_adh
        $old_immat = $_POST['old_immat'];
        $immat = $_POST['immat'];
        $type = $_POST['type'];
        $type_abg = $_POST['type_abg'];
        $prop = $_POST['prop'];
        $nom_serie = $_POST['nom_serie'];
        $const = $_POST['const'];
        $annee_constr = $_POST['annee_constr'];
        $nom_emb = $_POST['nom_emb'];
        $proprio = $_POST['proprio'];
        $large = $_POST['large'];
        $long = $_POST['long'];

        $editEmb = $bdd->prepare("UPDATE `embarcation` SET `imm_emb` = '$immat', `type_emb`='$type' , `type_abrege_emb`= '$type_abg' , `prop_emb` = '$prop', `nom_serie_emb`= '$nom_serie', `constr_emb` = '$const', `annee_constr_emb`='$annee_constr', `nom_emb`='$nom_emb', `proprio_emb`='$proprio', `large_mb`=$large, `long_emb`=$long WHERE embarcation.imm_emb = '$old_immat'");
        /* var_dump($editAdh); */
        try {
            $editEmb->execute();
        } catch (PDOException $th) {

            echo $th; ?>
            <div class="error-message">
                Une erreur s'est produite veuillez réessayer, il est possible que cette embarcation
                soit déjà présente dans la table réservation. Pour la modifier, veuillez supprimer les réservations qui lui sont associées.
            </div>
<?php
        }
    }
}
