<?php include_once 'function.php';

class addCategorie{
    
    private $name;
   // private $categorie;
    private $bdd;
    
    public function __construct($name/*$categorie*/) {
        
        $this->name = htmlspecialchars($name);
       // $this->categorie = htmlspecialchars($categorie);
        $this->bdd = bdd();
        
    }
    
    
    public function verif(){
        
        if(strlen($this->name) >= 5 AND strlen($this->name) <= 21 ){ /*Si le nom du sujet est bon**/
            $catok = 'Création de la catégorie effectuée';
            return $catok;
           
            
        }
        else { /*Si le nom du sujet est mauvais*/
            $erreur = 'Le nom de la catégorie doit contenir entre 5 et 20 caractères';
            return $erreur;
        }
        
    }
    
    public function insert(){
        
        $requete = $this->bdd->prepare('INSERT INTO categorie(name) VALUES(:name)');
        $requete->execute(array('name'=> $this->name));
        
      //  $requete2 = $this->bdd->prepare('INSERT INTO postSujet(propri,contenu,date,sujet) VALUES(:propri,:contenu,NOW(),:sujet)');
      //  $requete2->execute(array('propri'=>$_SESSION['id'],'contenu'=>  $this->sujet,'sujet'=>  $this->name));
        
        return 1;
    }
    
}