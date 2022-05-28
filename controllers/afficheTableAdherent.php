<?php

$query = 'SELECT * FROM `adherent`;';
$result = $bdd->query($query);
echo "<table border=\"1\">";
echo "<tr><th>Id</th> <th>Mot de passe</th> <th>droit</th> <th>Nom</th> <th>Prénom</th> <th> Adresse </th> <th>CP</th> <th>Ville</th> <th>Date Nais.</th> <th>Tel.</th> <th>Email</th> <th>Activité</th> <th>Date de création</th>  <th>Date déliv carte</th> <th>Date Exp Carte</th></tr>";
while ($ligne = $result->fetch()) {
    echo "<tr>";
    echo "<td> " . $ligne['id'] . "</td>";
    echo "<td> " . $ligne['mot_de_passe'] . "</td>";
    echo "<td> " . $ligne['droit'] . "</td>";
    echo "<td> " . $ligne['nom_adh'] . "</td>";
    echo "<td> " . $ligne['pre_adh'] . "</td>";
    echo "<td> " . $ligne['ad_adh'] . "</td>";
    echo "<td> " . $ligne['cp_adh'] . "</td>";
    echo "<td> " . $ligne['ville_adh'] . "</td>";
    echo "<td> " . $ligne['date_nais_adh'] . "</td>";
    echo "<td> " . "<a href='tel:" . $ligne['tel_adh'] . "'>" . $ligne['tel_adh'] . "</a>" . "</td>";
    echo "<td> " . "<a href='mailto:" . $ligne['email_adh'] . "'>" . $ligne['email_adh'] .  "</a>" . "</td>";
    echo "<td> " . $ligne['activ_adh'] . "</td>";
    echo "<td> " . $ligne['date_crea_adh'] . "</td>";
    echo "<td> " . $ligne['date_deliv_carte_adh'] . "</td>";
    echo "<td> " . $ligne['date_exp_carte_adh'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</br></br>";
