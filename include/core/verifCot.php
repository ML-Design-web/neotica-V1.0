<?php
if (!empty($_SESSION)) {
    $id = $_SESSION['id'];
    $todayDate = date("Y-m-d");

    // obtenir la date du jour non concaténée sous forme d'entier
    $todayDay = date('d');
    $todayDay = intval($todayDay);

    $todayMonth = date('m');
    $todayMonth = intval($todayMonth);

    $todayYear = date('Y');
    $todayYear = intval($todayYear);

    $yearAgo = $todayYear - 1  . "-" . $todayMonth . "-" . $todayDay;

    $verifCotAdh = $bdd->prepare("SELECT COUNT(adherent.id) FROM adherent, cotiser WHERE adherent.id = cotiser.id AND adherent.id = '$id' AND cotiser.date_cotise BETWEEN '$yearAgo' AND '$todayDate'");
    $verifCotAdh->execute();
    $verifCot = $verifCotAdh->fetch();

    // requete pour obtenir la derniere date de cotisation
    $dateCotAdh = $bdd->prepare("SELECT cotiser.date_cotise FROM cotiser WHERE cotiser.id = '$id' AND cotiser.date_cotise BETWEEN '$yearAgo' AND '$todayDate'");
    $dateCotAdh->execute();
    $dateCot = $dateCotAdh->fetch();

    $newDateString = 0;
    $dayTillNextCot = 0;
    $dayFromLastCot = 0;

    if (!empty($dateCot)) {
        $dateCotBis = $dateCot['date_cotise'];

        // modifier les 4 premiers caractères de la chaine pour obtenir l'année suivante
        $yearCot = intval(substr($dateCotBis,  0,  4));
        $nextYearCot = strval($yearCot + 1);
        $newDateString = substr_replace($dateCotBis, $nextYearCot, 0, 4);
        // ----------

        // strtotime des dates pour les comparer
        $date_debut = strtotime($todayDate);
        $date_fin = strtotime($newDateString);
        $timeToday = strtotime($dateCotBis);

        $dayFromLastCot = round(($date_debut - $timeToday) / 60 / 60 / 24, 0);
        $dayTillNextCot = round(($date_fin - $date_debut) / 60 / 60 / 24, 0);

        //var_dump($dayFromLastCot, $dayTillNextCot, $dateCotBis, $yearCot, $nextYearCot, $newDateString);
    }
    if ($verifCot['0'] != '0') {
        $_SESSION['isCot'] = true;
        $_SESSION['dateNextCot'] = $newDateString;
        $_SESSION['dayTillNextCot'] = $dayTillNextCot;
        $_SESSION['dayFromLastCot'] = $dayFromLastCot;
    } else {
        $_SESSION['isCot'] = false;
        $_SESSION['dateNextCot'] = $newDateString;
        $_SESSION['dayTillNextCot'] = $dayTillNextCot;
        $_SESSION['dayFromLastCot'] = $dayFromLastCot;
    }
}
