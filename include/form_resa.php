<?php
require_once(dirname(__FILE__) . '/core/verifCot.php');
if ($_SESSION['isCot'] == true) {
    $returnedEmb = $bdd->prepare("SELECT embarcation.imm_emb FROM embarcation");
    $returnedEmb->execute();
    while ($array = $returnedEmb->fetch()) {
        $embArray[] = $array[0];
    }
    $returnedEmbLenght = count($embArray);
?>
    <form action="" method="post">
        <div class="d-flex column resa-form">
            <div class="input-box">
                <label for="date_emp">Date d'emprunt</label>
                <input type="datetime-local" name="date_emp" id="date_emp" required>
            </div>
            <div class="input-box">
                <label for="immat_emb">Quelle embarcation ?</label>
                <select name="immat_emb" id="immat_emb" required>
                    <?php if ($returnedEmb != false) {
                        for ($i = 0; $i < $returnedEmbLenght; $i++) {
                            echo "<option value='$embArray[$i]'>";
                            echo $embArray[$i];
                            echo "</option>";
                        }
                    } else {
                        echo "<option value=''>";
                        echo "Il n'y a pas d'embarcation";
                        echo "</option>";
                    } ?>"
                </select>
            </div>

            <div class="input-box">
                <label for="date_ret">Date de retour</label>
                <input type="datetime-local" name="date_ret" id="date_ret" required>
            </div>
            <div class="input-box">
                <label for="etat_av">Etat au moment de l'emprunt</label>
                <select name="etat_av" id="etat_av" required>
                    <option value="">----- Choisissez un état -----</option>
                    <option value="neuf">Neuf</option>
                    <option value="t_bon">Très bon</option>
                    <option value="bon">Bon</option>
                    <option value="moyen">Moyen</option>
                    <option value="Mauvais">Mauvais</option>
                </select>
            </div>
            <input type="submit" name="reservation" value="Réserver">


            <?php
            $id = $_SESSION['id'];
            $todayDate = date("Y-m-d");

            // obtenir la date du jour non concaténée sous forme d'entier
            $todayDay = date('d');
            $todayDay = intval($todayDay);

            $todayMonth = date('m');
            $todayMonth = intval($todayMonth);

            $todayYear = date('Y');
            $todayYear = intval($todayYear);

            $months30 = ['avril' => 4, 'juin' => 6, 'septembre' => 9, 'novembre' => 11];
            $months31 = ['mars' => 3, 'mai' => 5, 'juillet' => 7, 'aout' => 8, 'octobre' => 10, 'decembre' => 12];

            //obtenir la semaine précédente en réutilisant les variables précédente pour établir une intervalle
            if ($todayDay < 8 && $todayMonth == 1) {
                $newDay = $todayDay + 31 - 7;
                $newMonth = 12;
                $newYear = $todayYear - 1;
            } elseif ($todayDay < 8 && $todayMonth == 3) {
                $newDay = $todayDay + 28 - 7;
                $newMonth = $todayMonth - 1;
                $newYear = $todayYear;
            } elseif ($todayDay < 8 && in_array($todayMonth, $months30)) {
                $newDay = $todayDay + 31 - 7;
                $newMonth = $todayMonth - 1;
                $newYear = $todayYear;
            } elseif ($todayDay < 8 && in_array($todayMonth, $months31)) {
                $newDay = $todayDay + 30 - 7;
                $newMonth = $todayMonth - 1;
                $newYear = $todayYear;
            } else {
                $newDay = $todayDay - 7;
                $newMonth = $todayMonth;
                $newYear = $todayYear;
            }

            $newDate = $newYear . "-" . $newMonth . "-" . $newDay;

            $nbResaAdh = $bdd->prepare("SELECT COUNT(adherent.id) from adherent, emprunt where adherent.id = emprunt.id AND emprunt.id = '$id'");
            $nbResaAdh->execute();
            $nbResaAdhFetched = $nbResaAdh->fetch(PDO::FETCH_ASSOC);
            $nbResa = $nbResaAdhFetched['COUNT(adherent.id)'];
            $nbResa = intval($nbResa);
            $nbResaSemaine = $bdd->prepare("SELECT COUNT(*) from adherent, emprunt where adherent.id = emprunt.id AND emprunt.id = '$id' AND emprunt.date_empr BETWEEN '$newDate 00:00' AND '$todayDate 23:59'");
            $nbResaSemaine->execute();
            $nbResaSemaine = $nbResaSemaine->fetch(PDO::FETCH_ASSOC);
            $nbResaSemaine = $nbResaSemaine['COUNT(*)'];
            $nbResaSemaine = intval($nbResaSemaine);
            /* var_dump($nbResa, $nbResaSemaine, $newDate, $todayDate); */

            if (!empty($_POST['reservation'])) {
                $date_emprunt =
                    date("Y-m-d H:i:s", strtotime($_POST['date_emp']));

                $immat_emb = $_POST['immat_emb'];

                $date_retour =
                    date("Y-m-d H:i:s", strtotime($_POST['date_ret']));

                $etat = $_POST['etat_av'];

                /* var_dump($date_emprunt, $immat_emb, $date_retour, $etat, $nbResa, $nbResaSemaine, $newDate); */

                if ($nbResaSemaine < 4 && $_SESSION['isCot'] == true) {
                    $reservation = "INSERT INTO `emprunt` (`id`, `date_empr`, `imm_emb`, `date_retour_empr`, `etat_debut_empr`, `etat_retour_empr`) VALUES ('$id', '$date_emprunt', '$immat_emb', '$date_retour', '$etat', 'inconnu')";
                    $reservation = $bdd->prepare($reservation);
                    try {
                        $reservation->execute();
                    } catch (PDOexception $th) {
                        echo '<div class="error-message">';
                        echo 'Erreur inconnue, veuillez réessayer avec une autre date';
                        echo '</div>';
                    }
                } else {
                    echo "<div class='error-message'>";
                    echo "vous avez effectué plus de 3 réservations au cours de la semaine";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </form>
<?php
} else {
?>
    <div class="error-message">
        <p>Vous n'avez pas effectué de cotisations au cours de la dernière année</p>
        <br>
        <p>Vous ne pourrez pas effectuer de réservations tant que vous n'avez pas cotisé !</p>
        <br><br>
        <button><a href="http://localhost/neotica-V1.0/pages/paiement-cotisation.php">Cotiser</a></button>
    </div>
<?php
}
