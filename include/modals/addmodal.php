<?php
$countreq =  $bdd->prepare("SELECT * FROM adherent");
$countreq->execute();
while ($count = $countreq->fetch()) {
    $countArray[] = $count[0];
}
$arrayMaxLenght = count($countArray);

if ($_SERVER['PHP_SELF'] == "/pages/gestion-des-donnees.php") {
    echo '<div class="modal" id="modal">';
    echo '<div class="bg-modal" id="bg-modal"></div>';
    echo '<div class="add-box">';
?>
    <form action="" method="post" required>
        <div class="d-flex modal-form">
            <!-- php var_dump($adh_info); ?-->
            <div class="input-box">
                <label for="id">Identifiant :</label>
                <input type="text" name="id" id="id" required>
            </div>
            <div class="input-box">
                <label for="password">Mot de passe :</label>
                <input type="text" name="password" id="password" required>
            </div>
            <div class="input-box">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div class="input-box">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" required>
            </div>
            <div class="input-box">
                <label for="droit">Droit :</label>
                <input type="number" name="droit" id="droit" min="1" max="3" maxlength="1" required>
            </div>
            <div class="input-box">
                <label for="cp">Code postal :</label>
                <input type="number" name="cp" id="cp" required>
            </div>
            <div class="input-box">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" required>
            </div>
            <div class="input-box">
                <label for="date_nais">Date de naissance :</label>
                <input type="date" name="date_nais" id="date_nais" required>
            </div>
            <div class="input-box">
                <label for="tel">Téléphone :</label>
                <input type="number" name="tel" id="tel" maxlength="12" required>
            </div>
            <div class="input-box">
                <label for="mail">E-Mail :</label>
                <input type="text" name="mail" id="mail" required>
            </div>
            <div class="input-box">
                <label for="activite">Activité :</label>
                <input type="text" name="activite" id="activite" required>
            </div>
            <div class="input-box">
                <label for="date_crea_adh">Date d'inscription :</label>
                <input type="date" name="date_crea_adh" id="date_crea_adh" required>
            </div>
            <div class="input-box">
                <label for="date_deliv_carte">Date de délivrance carte :</label>
                <input type="date" name="date_deliv_carte" id="date_deliv_carte" required>
            </div>
            <div class="input-box">
                <label for="date_expi_carte">Date d'expiration carte :</label>
                <input type="date" name="date_expi_carte" id="date_expi_carte" required>
            </div>
        </div>
        <br />

        <input type="submit" name="add-adh" value="Ajouter">
    </form>
    <?php
    echo '</div>';
    echo '</div>';

    if (!empty($_POST['add-adh'])) {
        $id = $_POST['id'];
        $mdp = md5($_POST['password']);
        $droit = $_POST['droit'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adress = $_POST['adress'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $date_nais = $_POST['date_nais'];
        $tel = $_POST['tel'];
        $mail = $_POST['mail'];
        $activite = $_POST['activite'];
        $date_crea_adh = $_POST['date_crea_adh'];
        $date_deliv_carte = $_POST['date_deliv_carte'];
        $date_expi_carte = $_POST['date_expi_carte'];

        $addQuery = "INSERT INTO `adherent` (`id`, `mot_de_passe`, `droit`, `nom_adh`, `pre_adh`, 'ad_adh',  `cp_adh`, `ville_adh`, `date_nais_adh`, `tel_adh`, `email_adh`, `activ_adh`, `date_crea_adh`, `date_deliv_carte_adh`, `date_exp_carte_adh`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $result = $bdd->prepare($addQuery);
        $result->execute(array($id, $mdp, $droit, $nom, $prenom, $adress, $cp, $ville, $date_nais, $tel, $mail, $activite, $date_crea_adh, $date_deliv_carte, $date_expi_carte));
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/gestion-des-cotisations.php") { ?>
    <div class="modal" id="modal">
        <div class="bg-modal" id="bg-modal"></div>
        <div class="add-box">
            <form action="" method="post" required>
                <div class="d-flex modal-form">
                    <div class="input-box">
                        <label for="date_nais">Date de cotisation :</label>
                        <input type="date" name="date_cot" id="date_cot" required>
                    </div>
                    <div class="input-box">
                        <label for="id">Choisissez l'identifiant :</label>
                        <select name="id" id="id" required>

                            <?php
                            for ($i = 0; $i < $arrayMaxLenght; $i++) {
                                echo "<option value='$countArray[$i]'>";
                                echo $countArray[$i];
                                echo "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="montant">Montant de la cotisation</label>
                        <input type="number" name="montant" id="montant" placeholder="Montant (€)" required>
                    </div>
                    <div class="input-box">
                        <label for="role">role</label>
                        <select name="role" placeholder="Rôle" id="role" value="rôle" required>
                            <option value=""> -- Choisir un rôle -- </option>
                            <option value="Administrateur"> Administrateur</option>
                            <option value="Adhérent"> Adhérent</option>
                            <option value="Plagiste"> Plagiste</option>
                        </select>
                    </div>
                </div>
                <br />

                <input type="submit" name="addCot" value="Ajouter">

            </form>
        </div>
    </div>
    <?php
    if (!empty($_POST['addCot'])) {
        $date_cot = $_POST['date_cot'];
        $id = $_POST['id'];
        $montant = $_POST['montant'];
        $role = $_POST['role'];

        $addQuery = "INSERT INTO `cotiser` (`date_cotise`, `id`, `montant_cot`, `role_adh`) VALUES (?,?,?,?)";
        $result = $bdd->prepare($addQuery);
        $result->execute(array($date_cot, $id, $montant, $role));
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/gestion-des-reservations.php") {
    $returnedEmb = $bdd->prepare("SELECT embarcation.imm_emb FROM embarcation");
    $returnedEmb->execute();
    while ($array = $returnedEmb->fetch()) {
        $embArray[] = $array[0];
    }
    $returnedEmbLenght = count($embArray); ?>

    <div class="modal" id="modal">
        <div class="bg-modal" id="bg-modal"></div>
        <div class="add-box">
            <form action="" method="post" required>
                <div class="d-flex modal-form">
                    <div class="input-box">
                        <label for="id">Identifiant :</label>
                        <select name="id" id="id" required>
                            <?php
                            for ($i = 0; $i < $arrayMaxLenght; $i++) {
                                echo "<option value='$countArray[$i]'>";
                                echo $countArray[$i];
                                echo "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="date_empr">Date de l'emprunt :</label>
                        <input type="datetime-local" name="date_empr" id="date_empr" placeholder="Date de l emprunt" required>
                    </div>
                    <div class="input-box">
                        <label for="immat_emb">Immatriculation de l'embarcation :</label>
                        <select name="immat_emb" id="immat_emb" required>
                            <?php
                            if ($returnedEmb != false) {
                                for ($i = 0; $i < $returnedEmbLenght; $i++) {
                                    echo "<option value='$embArray[$i]'>";
                                    echo $embArray[$i];
                                    echo "</option>";
                                }
                            } else {
                                echo "<option value=''>";
                                echo "Il n'y a pas d'embarcation";
                                echo "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="date_ret">Date de retour :</label>
                        <input type="datetime-local" name="date_ret" id="date_ret" placeholder="Date de retour" required>
                    </div>
                    <div class="input-box">
                        <label for="etat_av">Etat lors de l'emprunt :</label>
                        <select name="etat_av" id="etat_av" required>
                            <option value="">----- Etat au début -----</option>
                            <option value="neuf">Neuf</option>
                            <option value="t_bon">Très bon</option>
                            <option value="bon">Bon</option>
                            <option value="moyen">Moyen</option>
                            <option value="Mauvais">Mauvais</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="etat_ap">Etat au retour :</label>
                        <select name="etat_ap" id="etat_ap" required>
                            <option value="">----- Etat de retour -----</option>
                            <option value="neuf">Neuf</option>
                            <option value="t_bon">Très bon</option>
                            <option value="bon">Bon</option>
                            <option value="moyen">Moyen</option>
                            <option value="Mauvais">Mauvais</option>
                            <option value="pas_encore_rendu">Pas encore retourné</option>
                        </select>
                    </div>
                </div>
                <br />
                <input type="submit" name="addEmpr" value="Ajouter">
            </form>
        </div>
    </div>

    <?php

    if (!empty($_POST['addEmpr'])) {
        $id = $_POST['id'];
        $date_emprunt =
            date("Y-m-d H:i:s", strtotime($_POST['date_empr']));

        $immat_emb = $_POST['immat_emb'];

        $date_retour =
            date("Y-m-d H:i:s", strtotime($_POST['date_ret']));

        $etat = $_POST['etat_av'];
        $etat_ap = $_POST['etat_ap'];

        $addQuery = "INSERT INTO `emprunt` (`id`, `date_empr`, `imm_emb`, `date_retour_empr`, `etat_retour_empr`, `etat_debut_empr`) VALUES (?,?,?,?,?,?)";
        $result = $bdd->prepare($addQuery);
        $result->execute(array($id, $date_emprunt, $immat_emb, $date_retour, $etat_ap, $etat));
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/nos-embarcations.php") { ?>
    <div class="modal" id="modal">
        <div class="bg-modal" id="bg-modal"></div>
        <div class="add-box">
            <form action="" method="post" required>
                <div class="d-flex modal-form">
                    <div class="input-box">
                        <label for="immat">Immatriculation :</label>
                        <input type="text" name="immat" id="immat" required>
                    </div>
                    <div class="input-box">
                        <label for="type">Type :</label>
                        <input type="text" name="type" id="type" required>
                    </div>
                    <div class="input-box">
                        <label for="type_abg">Type abrégé :</label>
                        <input type="text" name="type_abg" id="type_abg" required>
                    </div>
                    <div class="input-box">
                        <label for="prop">Moyen de propulsion :</label>
                        <input type="text" name="prop" id="prop" required>
                    </div>
                    <div class="input-box">
                        <label for="num_serie">Num de série :</label>
                        <input type="text" name="num_serie" id="num_serie" required>
                    </div>
                    <div class="input-box">
                        <label for="constr">Constructeur :</label>
                        <input type="text" name="constr" id="constr" required>
                    </div>
                    <div class="input-box">
                        <label for="annee-const">Année de construction :</label>
                        <input type="text" name="annee-const" id="annee-const" required>
                    </div>
                    <div class="input-box">
                        <label for="nom_emb">Nom de l'embarcation :</label>
                        <input type="text" name="nom_emb" id="nom_emb" required>
                    </div>
                    <div class="input-box">
                        <label for="proprio">Propriétaire :</label>
                        <input type="text" name="proprio" id="proprio" required>
                    </div>
                    <div class="input-box">
                        <label for="larg">Largeur :</label>
                        <input type="text" name="larg" id="larg" required>
                    </div>
                    <div class="input-box">
                        <label for="long">Hauteur :</label>
                        <input type="text" name="long" id="long" required>
                    </div>
                </div>
                <br />

                <input type="submit" name="addEmb" value="Ajouter">

            </form>
        </div>
    </div>
    <?php
    if (!empty($_POST['addEmb'])) {
        $immat = $_POST['immat'];
        $type = $_POST['type'];
        $type_abg = $_POST['type_abg'];
        $prop = $_POST['prop'];
        $num_serie = $_POST['num_serie'];
        $constr = $_POST['constr'];
        $annee_const = $_POST['annee-const'];
        $nom_emb = $_POST['nom_emb'];
        $proprio = $_POST['proprio'];
        $larg = $_POST['larg'];
        $long = $_POST['long'];

        $addQuery = "INSERT 
        INTO `embarcation` (`imm_emb`, `type_emb`, `type_abrege_emb`, `prop_emb`, `nom_serie_emb`, `constr_emb`, `annee_constr_emb`, `nom_emb`, `proprio_emb`, `large_mb`, `long_emb`) 
        VALUES ('$immat','$type','$type_abg','$prop','$num_serie','$constr','$annee_const','$nom_emb','$proprio','$larg', '$long')";
        $result = $bdd->prepare($addQuery);
        try {
            $result->execute();
        } catch (PDOException $th) {
    ?>
            <div class="error-message">
                une erreur inconnue s'est produite merci de réessayer.
            </div>
<?php
        }
    }
}
