<?php
if (!empty($_SESSION)) {
    // count ADH
    $countAdhQuery = $bdd->prepare("SELECT COUNT(*) FROM adherent");
    $countAdhQuery->execute();
    $countAdh = $countAdhQuery->fetch();


    // count embarcations
    $countEmbQuery = $bdd->prepare("SELECT COUNT(*) FROM embarcation");
    $countEmbQuery->execute();
    $countEmb = $countEmbQuery->fetch();


    // count resa
    $countResaQuery = $bdd->prepare("SELECT COUNT(*) FROM emprunt");
    $countResaQuery->execute();
    $countResa = $countResaQuery->fetch();
}
