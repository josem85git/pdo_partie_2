<!DOCTYPE html>
<html>
    <head>
        <title>Page de traitement</title>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Dans le formulaire précédent, vous avez fourni les
        informations suivantes :</p>
        
        <?php
            echo 'Nom : '.$_POST["nom"].'<br>';
            echo 'Prénom : ' .$_POST["prenom"].'<br>';
            echo 'Date de naissance : ' .$_POST["dateNaissance"].'<br>';
            echo 'Numéro de téléphone : ' .$_POST["numero"].'<br>';
            echo 'Email : ' .$_POST["email"].'<br>';
        ?>

        <p>
            On va intégrer ces données dans la base de données "patients"
        </p>
        <?php
    $serveur = "localhost";
    $dbname = "hospitale2n";
    $user = "root";
        
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $dateNaissance = $_POST["dateNaissance"];
    $numero = $_POST["numero"];
    $email = $_POST["email"];
    
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //On insère les données reçues
        $sth = $dbco->prepare("
            INSERT INTO patients(lastname, firstname, birthdate, phone, mail)
            VALUES(:nom, :prenom, :dateNaissance, :numero, :email)");
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':prenom',$prenom);
        $sth->bindParam(':dateNaissance',$dateNaissance);
        $sth->bindParam(':numero',$numero);
        $sth->bindParam(':email',$email);
        $sth->execute();
        
        //On renvoie l'utilisateur vers la page de remerciement
        header("Location:liste-patients.php");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>
    </body>
</html>