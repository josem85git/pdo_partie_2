<?php
include 'db_connect.php';
include 'menu.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
.table-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 60px); /* Hauteur de la fenêtre moins la hauteur de l'en-tête */
    margin-left: 260px;
}

table {
    margin-top: 60px; /* ajoute une marge en haut du tableau */
    width: 80%; /* Réduisez la largeur du tableau pour le centrer sur la page */
    margin: auto; /* Centrez le tableau sur la page */
    border-collapse: collapse;
}
th, td {
    border: 2px solid #ddd; /* Augmentez l'épaisseur de la bordure pour rendre les sections plus distinctes */
    padding: 15px; /* Augmentez l'espacement à l'intérieur des cellules pour une meilleure lisibilité */
    text-align: left;
}
tr:nth-child(even) {
    background-color: #ddd; /* Changez la couleur de fond des lignes paires pour aider à distinguer les patients */
}
tr:nth-child(odd) {
    background-color: #eee; /* Changez la couleur de fond des lignes impaires pour les rendre moins foncées */
}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php       
        // Préparez la requête pour obtenir tous les patients
            $stmt = $db->prepare("SELECT * FROM patients");
            $stmt->execute();
            $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="table-container">
            <table>
                <tr>
                    <th colspan="7" style="text-align: center;">Liste des patients</th>
                </tr>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Profil</th>
            </tr>

            <?php
            // Parcourez chaque patient et affichez leurs informations
            foreach($patients as $patient) {
                echo "<tr>";
                echo "<td>" . $patient['id'] . "</td>";
                echo "<td>" . $patient['lastname'] . "</td>";
                echo "<td>" . $patient['firstname'] . "</td>";
                echo "<td>" . $patient['birthdate'] . "</td>";
                echo "<td>" . $patient['phone'] . "</td>";
                echo "<td>" . $patient['mail'] . "</td>";
                echo "<td><a href=\"profil-patient.php?id=" . $patient['id'] . "\">Voir le profil</a></td>";
            }
            ?>
        </table>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
