<?php

if (!empty($_POST)) {
    if (!empty($_SESSION)) {
        session_destroy(); // si une session existe déjà alors elle est écrasée pour se connecter à la nouvelle
    }

    // associer les entrées du formulaire aux variables
    $id = $_POST['id'];
    $password = md5($_POST['passwrd']); // Hashing en MD5 du mot de passe rentré dans le formulaire

    // requête mySQL pour selectionner les ID, PASSWORD et DROIT correspondant à l'ID rentré
    $sqlMainResult = $bdd->prepare("SELECT adherent.id, adherent.mot_de_passe, adherent.droit FROM adherent WHERE adherent.id = '$id'");
    $sqlMainResult->execute();
    $idResult = $sqlMainResult->fetch(PDO::FETCH_ASSOC);  // Stocke dans un tableau ce qui est renvoyé par la requête

    // Requêtes pour stocker les noms et prénoms de l'$ID rentré
    $sqlNomResult = $bdd->prepare("SELECT adherent.nom_adh, adherent.pre_adh FROM adherent WHERE adherent.id = '$id'");
    $sqlNomResult->execute();
    $infosResult =  $sqlNomResult->fetch(PDO::FETCH_ASSOC);;     // exec SQL adherent.nom_adh, adherent.pre_adh QUERY
    // Informations renvoyées sous forme d'un array()

    if ($idResult != false) { // si la requête renvoie une valeur et est donc différente de false
        if ($password == $idResult['mot_de_passe']) { // si le mot de passe corresspond à celui associé à l'id
            if ($idResult['droit'] == 3) { // id de droit 1 ouvrent une session admin et on alimente la variable $_SESSION d'autres infos
                $_SESSION['id'] = $id;
                $_SESSION['role'] = 'admin';
                $_SESSION['nom'] = $infosResult['nom_adh'];
                $_SESSION['prenom'] = $infosResult['pre_adh'];
                $_SESSION['mdp'] = $password;
                require_once(dirname(__FILE__) . '/verifCot.php');
                header('Location: http://localhost/neotica-V1.0/index.php'); // retour à la page d'accueil et ouvre la session
                exit();
            } else {
                echo '<br /> <div class="id-false"> Oups ! Vous n êtes pas administrateur ! </div> ';
            }
        } else { // si mot de passe incorrect >
            echo '<br />';
            echo '<div class="id-false"> Oups ! Le mot de passe est incorrect veuillez réessayer !</div> ';
        }
    } else { // si identifiant inconnu >
        echo '<br />';
        echo "<div class='id-false'> Oups ! Cet identifiant n'existe pas !</div> ";
    }
}
