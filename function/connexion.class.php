<?php include_once 'function.php';

class connexion{
    
    private $pseudo; 
    private $mdp;
    private $bdd;
    
    public function __construct($pseudo,$mdp) {
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
        $this->bdd = bdd();
    }
    
    public function verif(){
        
        $requete = $this->bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
        $requete->execute(array('pseudo'=> $this->pseudo));
        $reponse = $requete->fetch();
        if($reponse){/*on regarde si le pseudo est connu dans la bdd*/
            
            if($this->mdp == $reponse['mdp']){/* on vérifie le mdp dans la bdd*/
                return 'ok';
            }
            else {/** mot de passe faux ou inexistant dans la bdd */
                $erreur = 'Le mot de passe est incorrect';
                return $erreur;
            }
            
            
        }
        else {/** pseudo erroné ou inexistant */
            $erreur = 'Le pseudo est incorrect';
            return $erreur;
         }
        
        
    }
    
    public function session(){
        $requete = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo ');
        $requete->execute(array('pseudo'=>  $this->pseudo));
        $requete = $requete->fetch();
        $_SESSION['id'] = $requete['id'];
        $_SESSION['pseudo'] = $this->pseudo;
        
        return 1;
    }
    
    
}