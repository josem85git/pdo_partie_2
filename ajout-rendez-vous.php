<?php
// Connexion à la base de données
require_once 'db_connect.php';
// Récupérer tous les patients
$sql = 'SELECT * FROM `patients`';
$query = $db->prepare($sql);
$query->execute();
$patients=$query->fetchAll(PDO::FETCH_ASSOC);

/*
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $rdvDate = $_POST['datetime'];
    $rdvPatient = 
    // Préparation de la requete
    $req=$bd->prepare('INSERT INTO `appointments`(dateHour, idPatients) VALUES(:datetime)');
    // Exécution de la requête
    $req->execute(array('datetime' => $_POST['datetime']));

    echo 'Le rendez-vous a été ajouté !';
}
*/
$sqlInsert = "INSERT INTO appointments(dateHour, idPatients) VALUES('12/10', '37')";
$db->exec($sqlInsert);
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Ajout Rendez-vous</title>
    </head>
    <body>
        <h1>Ajout Rendez-vous</h1>
        <form action="liste-rendez-vous.php" method="post">
            <div>
                <label for="datetime">Date et Heure:</label><br>
                <input type="datetime-local" id="datetime" name="datetime"><br>
            </div>
            <div>
                <label for="idPatient">Patient:</label>
                <select name="idPpatient" id="idPatient">
                    <!-- Remplir avec les options de patients depuis la base de données -->
                    <?php foreach($patients as $patient):?>
                        <option value="<?=$patient['id']?>"><?=$patient['lastname']?><?=$patient['firstname']?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="button">
                <button type="submit">Ajouter le rendez-vous</button>
            </div>
        </form>
    </body>
</html>

