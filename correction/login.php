<?php
include_once '../function/function.php';

if (isset($_POST['login'])){
    
    $login=$_POST['login'];
    $password=$_POST['password'];
    
    
    $requete = $bdd->prepare("SELECT * FROM membres WHERE login = :pseudo AND password = :mdp");
    $requete->bindvalue(":pseudo", $login, PDO::PARAM_STR);
    $requete->bindvalue(":mdp", $password PDO::PARAM_STR);
    $requete->execute;
    
    if($requete->rowCount()>0){
        
        $reponse = $requete->fetch();
        
        if ($reponse["lvl"]==0)
            echo "vous etes ban";
        else
        {
            header("Location:profil.php");
        }
    }
    else
    {
        echo "mauvais timing";
    }

}

?>
 <link rel="stylesheet" type="text/css" href="../css/general.css" />
 
<div id="Cforum">
                <form method="post" action="connexion.php">
                    <p>
                        <input name="pseudo" type="text" placeholder="Pseudo..." required /><br>
                        <input name="mdp" type="password" placeholder="Mot de passe..." required /><br>
                        <input type="submit" value="Connexion !" />
                        <p class="box-register">Vous êtes nouveau ici? <a href="inscription.php">S'inscrire</a></p>
                        <?php 
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                    </p>
                </form> 
                
            </div>