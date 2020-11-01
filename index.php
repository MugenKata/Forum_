<?php session_start();
include_once 'function/function.php';
include_once 'function/addPost.class.php';

$bdd = bdd();

if(!isset($_SESSION['id'])){

    header('Location: inscription.php');
}
else {
    
    
        if(isset($_POST['name']) AND isset($_POST['sujet'])){
    
        $addPost = new addPost($_POST['name'],$_POST['sujet']);
        $verif = $addPost->verif();
         if($verif == "ok"){
        if($addPost->insert()){
            
        }
    }
    else {/*Si on a une erreur*/
        $erreur = $verif;
        }
    
    }
   
    
    
    
    ?>
<!DOCTYPE html>
<head>
    <meta charset='utf-8' />
    <title>Forum four-tout</title>
    
   
    <link rel="stylesheet" type="text/css" href="css/general.css" >
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
<head>

<body>
 <h1>Bienvenue sur le Forum four-tout</h1>


 <div id="Cforum">
 
                <?php 
                
                 echo 'Bienvenue : '.$_SESSION['pseudo'].' :) '?> - <a href="deconnexion.php"><strong>Déconnexion</strong></a>
                 <?php
                if(isset($_GET['categorie'])){ /*SI on est dans une categorie*/
                    $_GET['categorie'] = htmlspecialchars($_GET['categorie']);
                    ?>
                
                    <div class="categories">
                      <h1><?php echo $_GET['categorie']; ?></h1>
                    </div>
                <a href="addSujet.php?categorie=<?php echo $_GET['categorie']; ?>">Ajouter un sujet</a>
                <?php 
                $requete = $bdd->prepare('SELECT * FROM sujet WHERE categorie = :categorie ');
                $requete->execute(array('categorie'=>$_GET['categorie']));
                while($reponse = $requete->fetch()){
                    ?>
                     <div class="categories">
                         <a href="index.php?sujet=<?php echo $reponse['name'] ?>"><h1><?php echo $reponse['name'] ?></h1></a>
                         </div>
                        
                    
                    <?php
                }
                ?>
                 <p class="box-register"> <a href="index.php">Retour</a></p>
                
                    
                    <?php
                }
                
                else if(isset($_GET['sujet'])){ /*SI on est dans un sujet*/
                    $_GET['sujet'] = htmlspecialchars($_GET['sujet']);
                    ?>
                    <div class="categories">
                      <h1><?php echo $_GET['sujet']; ?></h1>
                    </div>
                
                <?php 
                $requete = $bdd->prepare('SELECT * FROM postSujet WHERE sujet = :sujet ');
                $requete->execute(array('sujet'=>$_GET['sujet']));
                while($reponse = $requete->fetch()){
                    ?>
                <div class="post">
                    <?php 
                     $requete2 = $bdd->prepare('SELECT * FROM membres WHERE id = :id');
                     $requete2->execute(array('id'=>$reponse['propri']));
                     $membres = $requete2->fetch();
                     echo $membres['pseudo']; echo ' : <br>';
                     
                     echo $reponse['contenu'];
                    ?>
                 </div> 
                <?php
                   
                }
                ?>
                
                 <form method="post" action="index.php?sujet=<?php echo $_GET['sujet']; ?>">
                        <textarea name="sujet" placeholder="Votre message..." ></textarea>
                        <input type="hidden" name="name" value="<?php echo $_GET['sujet']; ?>" />
                        <input type="submit" value="Ajouter à la conversation" />
                        <p class="box-register"> <a href="index.php">Retour</a></p>
                        <?php 
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                    </form>
                <?php
                }
                else { /*Si on est sur la page normal*/
                    
                       
                    
                        $requete = $bdd->query('SELECT * FROM categories');
                        while($reponse = $requete->fetch()){
                        ?>
                      
                            <div class="categories">
                                <div class="up"> <strong> <a href="index.php?categorie=<?php echo $reponse['name']; ?>"><?php echo $reponse['name']; ?></a></strong></div>
                              </div>
                              
                   
                    <?php 
                    }
                    
                }
                 ?>
                
                
                
                
                
            </div>
</body>
<?php
}
?>
</html>
 

    
