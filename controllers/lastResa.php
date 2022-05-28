<?php
if (!empty($_SESSION)) {
    $id = $_SESSION['id'];

    $lastResa = $bdd->prepare("SELECT emprunt.date_empr, emprunt.date_retour_empr, emprunt.imm_emb FROM emprunt WHERE emprunt.id = '$id'");
    $lastResa->execute();

    $countResa = $bdd->prepare("SELECT COUNT(*) FROM emprunt WHERE emprunt.id = '$id'");
    $countResa->execute();

    try {

        $lastResaArray = $lastResa->fetch();
        $countResa = $countResa->fetch();

        if (!$lastResaArray) {
            $_SESSION['lastResa'] = false;
            $_SESSION['nbResa'] = 0;
        } else {
            $_SESSION['lastResa'] = array(
                'date' => $lastResaArray['date_empr'],
                'immat' => $lastResaArray['imm_emb'],
                'date_ret' => $lastResaArray['date_retour_empr']
            );
            $_SESSION['nbResa'] = $countResa[0];
        }
        /* var_dump($lastResaArray, $_SESSION['lastResa'],  $_SESSION['nbResa']); */
    } catch (PDOException $th) {
        //throw $th;
?>
        <div class="error-message">
            Une erreur inconnue s'est produite
        </div>
<?php
    }
}
