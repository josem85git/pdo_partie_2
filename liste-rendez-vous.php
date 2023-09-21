<a href="ajout-rendez-vous.php">Créer un nouveau rendez-vous</a>
<?php

// Connexion à la base de données
require_once 'db_connect.php';

// Afficher tous les rdv
try{
    // Requête permettant de recuperer tous les clients
    $sql = 'SELECT `id`, `dateHour`, `idPatients` FROM `appointments`;';
    $sth = $db->query($sql);
    // permet de sortir un tableau composé de tableau associatifs
    $appointments = $sth->fetchALL(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die('La requête a retourné une erreur'. $e->getMessage());
}

try{
    $db = new PDO("mysql:host=$servername;dbname=$dbname",$username);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Connecté à la base de données";
}catch(PDOException $e){
    echo"Connection failed: ".$e->getMessage();
};
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once 'db_connect.php';
    // Préparation de la requpete
    $req=$db->prepare('INSERT INTO `appointments`(dateHour, idPatients) VALUES(:datetime, )');
    // Exécution de la requête
    $req->execute(array('datetime' => $_POST['datetime']));
    echo 'Le rendez-vous a été ajouté !';
}
?>
<div class="container py-3">

<div class="card mb-3">

    <div class="card-body">
        <!-- Tous les clients -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">dateHour</th>
                    <th scope="col">idPatients</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                foreach($appointments as $appointment)
                {
                    $i++;
                    echo '<tr><th scope="row">'.$i.'</th>
                    
                    <td>'.date('d.m.Y', strtotime($appointment["dateHour"])).'</td>
                    <td>'.$appointment["idPatients"].'</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
        
</div>

</div>