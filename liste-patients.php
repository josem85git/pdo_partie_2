<!DOCTYPE html>
<html>
    <head>
        <title>PDO : Partie 2</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="formulaire.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
<?php
// Initialisation des constantes permettant la connexion à la Bdd
// dsn : Data Source Name
define('DSN', 'mysql:host=localhost;dbname=hospitale2n;charset=utf8');
define('LOGIN', 'root');
define('PASSWORD', '');

// Connexion
try{
    // Nouvelle instance de PDO
    $pdo = new PDO(DSN, LOGIN, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // permet de renvoyer un resultat sous forme d'objet
    echo 'nouvelle instance PDO ';
}   
catch(PDOException $e){
    echo 'erreur de connexion à la BDD: '. $e->getMessage();
}

// Afficher tous les patients
try{
    // Requête permettant de recuperer tous les clients
    $sql = 'SELECT `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients`;';
    $sth = $pdo->query($sql);
    // permet de sortir un tableau composé de tableau associatifs
    $patients = $sth->fetchALL(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die('La requête a retourné une erreur'. $e->getMessage());
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
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Date de naissance</th>
                        <th scope="col">Numéro de téléphone</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    foreach($patients as $patient)
                    {
                        $i++;
                        echo '<tr><th scope="row">'.$i.'</th>
                        <td>'.$patient["lastname"].'</td>
                        <td>'.$patient["firstname"].'</td>
                        <td>'.date('d.m.Y', strtotime($patient["birthdate"])).'</td>
                        <td>'.$patient["phone"].'</td>
                        <td>'.$patient["mail"].'</td>
                        <td><a href="profil-patient.php">profil</a></td>
                        </tr>';
                        
                    }
                    ?>
                </tbody>
            </table>
            
    </div>
    
</div>
<a href="ajout-patient.php">Ajouter un patient</a> 


<?php
/*
Pour créer une pagination dans votre fichier `liste-patients.php`, vous pouvez utiliser le code PHP suivant.
Ce code suppose que vous avez une connexion à la base de données et que vous récupérez les données à partir d'une table appelée `patients`.
*/

$limit = 10; // Cette ligne définit le nombre de patients par page
$page = isset($_GET['page']) ? $_GET['page'] : 1; /* Cette ligne vérifie si un paramètre de page a été passé dans l'URL(par exemple, liste-patients.php?page=2).
Si c'est le cas, il utilise cette valeur comme numéro de page actuel
Sinon il définit la page actuelle à 1 */
$start = ($page - 1) * $limit; /* Cette ligne calcule l'index de départ pour la requête SQL LIMIT
Si vous êtes à la page 1 alors vous commencez à partir de l'index 0
Si vous êtes à la page 2 vous commencez à partir de l'index égal à la limite (10 dans ce cas) et ainsi de suite */

/* Les lignes suivantes exécutent une requête SQL pour obtenir le nombre total de patients
puis elles calculent le nombre total de pages en divisant ce nombre par la limte
et en arrondissant au nombre entier supérieur avec ceil() */
$result = $pdo->prepare("SELECT COUNT(*) FROM patients");
$result->execute();
$patientCount = $result->fetchColumn();

$total_pages = ceil($patientCount / $limit);

/* ensuite une autre requête SQL est exécutée pour obtenir les patients pour la page actuelle
la clause LIMIT dans la requête SQL limite le nombre de résultats retournés
en commençant par l'index de départ que nous avons calculé */
$result = $pdo->prepare("SELECT * FROM patients LIMIT :start, :limit");
$result->bindParam(':start', $start, PDO::PARAM_INT);
$result->bindParam(':limit', $limit, PDO::PARAM_INT);
$result->execute();
$patients = $result->fetchAll();

/* La boucle foreach est utilisée pour parcourir
chaque patient retourné par la requête SQL
on utilise cette boucle pour afficher les informations de chaque patient
 */
foreach ($patients as $patient) {
   
}
/* la boucle for affiche les liens vers toutes les pages de résultats
chaque lien pointe vers liste-patients.php avec le paramètre page approprié dans l'URL*/
for ($page = 1; $page <= $total_pages; $page++) {
    echo "<a href='liste-patients.php?page=".$page."'>".$page."</a> ";
}

/*
Ce code affiche un lien vers chaque page de résultats. 
Quand un utilisateur clique sur un numéro de page, la page `liste-patients.php` est rechargée avec le paramètre `page` mis à jour. 
Les résultats sont ensuite récupérés pour la page spécifiée. 
Vous pouvez personnaliser ce code pour l'adapter à vos besoins spécifiques. 
N'oubliez pas de remplacer `$conn` par votre propre objet de connexion à la base de données.
*/
?>


</html>