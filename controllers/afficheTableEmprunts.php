<?php
$query = 'SELECT * FROM `emprunt`;';
$result = $bdd->query($query);
echo "<table border=\"1\">";
echo "<tr><th>Id</th> <th>Date de l'emprunt</th> <th>Immatriculation embarcation</th> <th>Date de retour</th> <th>Etat Avant</th> <th>Etat Après</th></tr>";
while ($ligne = $result->fetch()) {
    echo "<tr>";
    echo "<td> " . $ligne['id'] . "</td>";
    echo "<td> " . $ligne['date_empr'] . "</td>";
    echo "<td> " . $ligne['imm_emb'] . "</td>";
    echo "<td> " . $ligne['date_retour_empr'] . "</td>";
    echo "<td> " . $ligne['etat_debut_empr'] . "</td>";
    echo "<td> " . $ligne['etat_retour_empr'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</br></br>";
