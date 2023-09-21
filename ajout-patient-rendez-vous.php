<!DOCTYPE html>
<html>
    <head>
        <title>PDO : Partie 2</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/formulaire.css">
    </head>
<form action="nouveau-patient.php" method="post">
    <fieldset>
        <legend>Ajout d'un patient</legend>
        <div class="c100">
        <label for="nom">Nom: </label>
        <input type="text" id="nom" name="nom">
    </div>
    <div class="c100">
        <label for="prenom">Prénom: </label>
        <input type="text" id="prenom" name="prenom">
    </div>
    <div class="c100">
        <label for="dateNaissance">Date de naissance: </label>
        <input type="date" name="dateNaissance" id="dateNaissance">
    </div>
    <div class="c100">
            <label for="numero">Numéro de téléphone </label>
            <input type="tel" name="numero" id="numero" pattern="[0-9]{10}" required>
        </div>
        <div class="c100">
            <label for="email">Email : </label>
            <input type="email" name="email" id="email">
        </div>
    
    </fieldset>
    <fieldset>
        <div class="c100" id="submit">
            <input type="submit" value="Envoyer">
        </div>
    </fieldset>
    
    
</form>
</html>