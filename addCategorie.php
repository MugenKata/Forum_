<?php session_start();
include_once 'function/function.php';
include_once 'function/addCategorie.class.php';
$bdd = bdd();

if(isset($_POST['name'])){
    $addCat = new addCat($_POST['name']);
    $verif = $addCat->verif();
    if($verif == $catok){
        if($addCat->insert()){

        }
    }
    else{
        $erreur = $verif;
    }




?>
<!DOCTYPE html>
<head>
    <meta charset='utf-8' />
    <title>Mon super forum !</title>
    
   
    <link rel="stylesheet" type="text/css" href="css/general.css" />
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
<head>
<body>
 <h1>Ajouter une catégorie</h1>
    
            <div id="Cforum">
                <?php  echo 'Bienvenue : '.$_SESSION['pseudo'].' :) - <a href="deconnexion.php">Deconnexion</a> '; ?>
                
                <form method="post" action="addCategorie.php">
                    <p>
                        <br><input type="text" name="name" placeholder="Nom de la catégorie..." required/><br>
                       <!-- <textarea name="sujet" placeholder="Contenu du sujet..."></textarea><br>
                        <input type="hidden" value="<?php// echo $_GET['categorie']; ?>" name="categorie" /> -->
                        <input type="submit" value="Ajouter la catégorie" />
                        <?php 
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                    </p>
                </form>
            </div>
</body>
</html>
