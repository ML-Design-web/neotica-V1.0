<?php

$query = 'SELECT * FROM `embarcation`;';
$result = $bdd->query($query);
echo "<table border=\"1\">";
echo "<tr><th>Immatriculation</th> <th>Type</th> <th>Type abrégé</th> <th>Moyen de propulsion</th> <th>Num de série</th> <th>Constructeur</th> <th>Année de construction</th> <th>Nom de l'embarcation</th> <th>Propriétaire</th> <th>Largeur</th> <th>Longueur</th></tr>";
while ($ligne = $result->fetch()) {
    echo "<tr>";
    echo "<td> " . $ligne['imm_emb'] . "</td>";
    echo "<td> " . $ligne['type_emb'] . "</td>";
    echo "<td> " . $ligne['type_abrege_emb'] .  "</td>";
    echo "<td> " . $ligne['prop_emb'] . "</td>";
    echo "<td> " . $ligne['nom_serie_emb'] . "</td>";
    echo "<td> " . $ligne['constr_emb'] . "</td>";
    echo "<td> " . $ligne['annee_constr_emb'] .  "</td>";
    echo "<td> " . $ligne['nom_emb'] . "</td>";
    echo "<td> " . $ligne['proprio_emb'] . "</td>";
    echo "<td> " . $ligne['large_mb'] .  "</td>";
    echo "<td> " . $ligne['long_emb'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</br></br>";
