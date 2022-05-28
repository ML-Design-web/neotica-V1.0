<?php
function IsElsewhere($id, $db)
{
    $testIsCotis = "SELECT * FROM cotiser, adherent WHERE adherent.id = cotiser.id and cotiser.id = '$id'";
    $testIsEmpr = "SELECT * FROM adherent, emprunt WHERE adherent.id = emprunt.id and emprunt.id = '$id'";

    $resultCotis = $db->prepare($testIsCotis);
    $resultCotis->execute();
    $resultCotis = $resultCotis->fetch();

    $resultEmpr = $db->prepare($testIsEmpr);
    $resultEmpr->execute();
    $resultEmpr = $resultEmpr->fetch();

    if ($resultEmpr != false && $resultCotis != false) {
?>
        <div class="error-message">
            <h1> Avant de supprimer cet adhérent, veuillez supprimer toutes les cotisations qu'il a effectué</h1>
        </div>
        <?php
    } else {
        $result = $db->prepare("DELETE FROM `adherent` WHERE adherent.id = '$id'");
        try {
            $result->execute();
        } catch (PDOException $th) {
            //throw $th;
        ?>
            <div class="error-message">
                Vous ne pouvez pas supprimer un adhérent qui a une cotisation en cours, veuillez d'abord supprimer sa cotisation avant toute manipulation.
            </div>
    <?php
        }
    }
}

if ($_SERVER['PHP_SELF'] == "/pages/gestion-des-donnees.php") { ?>
    <div class="modal" id="modal">
        <div class="bg-modal" id="bg-modal"></div>
        <div class="delete-box">
            <form action="" method="post">
                <div class="d-flex modal-form">
                    <div class="input-box">
                        <label for="id">Choisissez un ID à supprimer :</label>
                        <select name="id" id="id" required>
                            <?php
                            for ($i = 0; $i < $arrayMaxLenght; $i++) {
                                echo "<option value='$countArray[$i]'>";
                                echo $countArray[$i];
                                echo "</option>";
                            };
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <input type="submit" name="deleteAdh" value="Supprimer">
            </form>
        </div>
    </div>
    <?php
    if (!empty($_POST['deleteAdh'])) {
        IsElsewhere($_POST['id'], $bdd);
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/gestion-des-cotisations.php") {

    $idSelected2 = isset($_POST['idSelect2']);
    $idInCot = $bdd->prepare("SELECT cotiser.id from cotiser");
    try {
        $idInCot->execute();
        while ($fillIdArray = $idInCot->fetch()) {
            $idInCotArray[] = $fillIdArray[0];
        }
    } catch (PDOException $th) {
        echo '<div class="error-message">';
        echo 'Une erreur inconnue s\'est produite';
        echo '</div>';
    }
    if (!empty($idInCotArray)) {
        $lenIdinCot = count($idInCotArray);
    }

    if (!$idSelected2) { ?>
        <div class="modal" id="modal">
            <div class="bg-modal" id="bg-modal"></div>
            <div class="edit-box">
                <form action="" id="pre-form" method="post">
                    <div class="d-flex modal-form">
                        <div class="input-box">
                            <label for="id">Choisissez un ID :</label>
                            <select name="id" id="id" required>
                                <?php
                                if ($lenIdinCot != false) {
                                    for ($i = 0; $i < $lenIdinCot; $i++) {
                                        echo "<option value='$idInCotArray[$i]'>";
                                        echo $idInCotArray[$i];
                                        echo "</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="idSelect2" id="select_button" value="Choisir">
                </form>
            </div>
        </div>

    <?php } else if ($idSelected2 && empty($_POST['dateSelect2'])) {
        $old_id = $_POST['id'];

        $dateFromId = $bdd->prepare("SELECT cotiser.date_cotise FROM cotiser WHERE cotiser.id = '$old_id'");
        try {
            $dateFromId->execute();
            while ($dateCot = $dateFromId->fetch()) {
                $dateCotResult[] = $dateCot[0];
            }
        } catch (PDOException $th) {
            echo '<div class="error-message">';
            echo 'Une erreur inconnue s\'est produite';
            echo '</div>';
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
                                    echo 'il n\'y a pas de cotisations pour cet ID';
                                    echo "</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="dateSelect2" id="select_button" value="Supprimer">
                </form>
            </div>
        </div>
        <?php
    }
    if (isset($_POST['dateSelect2'])) {
        $id = $_POST['old_id'];
        $dateCot = $_POST['date_cot'];
        $delete = $bdd->prepare("DELETE FROM `cotiser` WHERE cotiser.id = '$id' AND cotiser.date_cotise = '$dateCot'");
        try {
            $delete->execute();
        } catch (PDOException $th) {
        ?> <div class="error-message">
                Une erreur inconnue s'est produite merci de réessayer.
            </div>
        <?php
        }
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/gestion-des-reservations.php") {

    $idSelected2 = isset($_POST['idSelect2']);

    if (!$idSelected2) { ?>
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
                    <input type="submit" name="idSelect2" id="select_button" value="Choisir">
                </form>
            </div>
        </div>

    <?php } else if ($idSelected2 && empty($_POST['dateSelect2'])) {
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
            $lenDateEmpr = count($dateEmprResult) / 2;
        } else {
            $lenDateEmpr = 0;
        }

    ?> <div class="modal active" id="modal">
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
                                    echo 'il n\'y a pas de réservations pour cet ID';
                                    echo "</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="dateSelect2" id="select_button" value="Supprimer">
                </form>
            </div>
        </div>
    <?php
    }
    if (!empty($_POST['dateSelect2'])) {
        $id = $_POST['old_id'];
        $date_empr = $_POST['date_empr'];
        $delete = $bdd->prepare("DELETE FROM `emprunt` WHERE emprunt.id = '$id' AND emprunt.date_empr = '$date_empr'");
        $delete->execute();
    }
} elseif ($_SERVER['PHP_SELF'] == "/pages/nos-embarcations.php") {

    $listEmb = $bdd->prepare("SELECT * FROM embarcation");
    try {
        $listEmb->execute();
        while ($countEmb = $listEmb->fetch()) {
            $arrayEmb[] = $countEmb[0];
        }
        if (!empty($arrayEmb)) {
            $len_emb = count($arrayEmb); // longueur du tableau
        }
    } catch (PDOException $th) {
        echo 'Il n\'y a pas d\'embarcations référencée dans la liste';
    }
    ?>
    <div class="modal" id="modal">
        <div class="bg-modal" id="bg-modal"></div>
        <div class="add-box">
            <form action="" method="post" required>
                <div class="d-flex modal-form">
                    <div class="input-box">
                        <label for="imm_emb">Choisissez une embarcation à supprimer</label>
                        <select name="imm_emb" id="imm_emb" required>

                            <?php
                            for ($i = 0; $i < $len_emb; $i++) {
                                echo "<option value='$arrayEmb[$i]'>";
                                echo $arrayEmb[$i];
                                echo "</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <br />

                <input type="submit" name="delEmb" value="Supprimer">
            </form>
        </div>
    </div>
    <?php
    if (!empty($_POST['delEmb'])) {
        $imm_emb = $_POST['imm_emb'];

        $delEmbQuery = "DELETE FROM embarcation WHERE imm_emb = '$imm_emb'";
        $delEmb = $bdd->prepare($delEmbQuery);
        try {
            $delEmb->execute();
        } catch (PDOException $th) { ?>
            <div class="error-message">
                <span>L'embarcation <?php echo $imm_emb ?> est déjà utilisée dans la table emprunt et ne peut pas être supprimée</span>
            </div>
<?php
            $usedEmb = true;
        }
    }
}
