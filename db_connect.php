<?php
/*
Le fichier db_connect.php est généralement utilisé pour établir une connexion à la bd
il contient généralement le code nécessaire pour se connecter à la bd
en utilisant PDO (PHP Data Objects) ou mysqli
*/
$servername="localhost";
$username="root";
$dbname="hospitale2n";
try{
    $db = new PDO("mysql:host=$servername;dbname=$dbname",$username);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Connecté à la base de données";
}catch(PDOException $e){
    echo"Connection failed: ".$e->getMessage();
};
/*
Les informations  de connexion à la base de données sont sensibles et ne doivent jamais être 
exposées publiquement
assurez-vous que ce fichier est correctement sécurisé et n'est pas accessible au public
de plus il est recommandé de supprimer l'instruction echo"Connected successfully"; une fois
que vous avez confirmé que la connexion à la base de données fonctionne correctement
*/