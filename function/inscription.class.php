<?php  session_start();
include_once 'function.php'; 


class inscription{
    
   private $pseudo;
   private $email;
   private $mdp;
   private $mdp2;
   private $bdd;
    
    public function __construct($pseudo,$email,$mdp,$mdp2){
        
        
        $pseudo = htmlspecialchars($pseudo);
        $email = htmlspecialchars($email);
       
        
        $_POST['pseudo'] = $pseudo; 
        $_POST['email'] = $email;
        $_POST['mdp'] = $mdp;
        $_POST['mdp2'] = $mdp2;
        $this->bdd = bdd();
        
        
    }
    
    public function verif(){
        
        if(strlen( $_POST['pseudo']) >= 5 AND strlen( $_POST['pseudo']) < 21 ){ /*Si le pseudo est bon*/
          
           $syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#'; 
           if(preg_match($syntaxe, $_POST['email'])){ /*email bon*/
               
               if(strlen( $_POST['mdp']) >= 5 AND strlen( $_POST['mdp']) < 21 ){ /*Si le mot de passe à le bon format*/
               
                   if( $_POST['mdp'] ==  $_POST['mdp2']){/*Deux mots de passe bon*/
                       return 'ok';
                   }
                   else { /*Mot de passe !=*/
                       $erreur = 'Les mots de passe doivent être identique';
                       return $erreur;
                   }
               }
               else {/*Mauvais format du mot de passe*/
                   $erreur = 'Le mot de passe doit contenir entre 5 et 20 caractères';
                   return $erreur;
               }
               
               
           }
           else { /*email mauvais*/
               $erreur = 'Syntaxe de l\'adresse email incorrect ';
               return $erreur;
           }
        }
        else { /*Pseudo mauvais*/
            $erreur = 'Le pseudo doit contenir entre 5 et 20 caractères';
            return $erreur;
        }
        
    }
    
    
    public function enregistrement(){
        if(isset($_POST['mdp'])){
        $requete = $this->bdd->prepare('INSERT INTO membres(pseudo,email,mdp) VALUES(:pseudo,:email,:mdp)');
        $requete->execute(array(
            'pseudo'=>   $_POST['pseudo'],
            'email' =>  $_POST['email'],
            'mdp' => sha1($_POST['mdp']) 
        ));
    }
        return 1; 
       
    }
    
    public function session(){
        $requete = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo ');
        $requete->execute(array('pseudo'=>   $_POST['pseudo']));
        $requete = $requete->fetch();
        $_SESSION['id'] = $requete['id'];
        $_SESSION['pseudo'] = $_POST['pseudo'];
        
        return 1;
    }
    
    
    
}

