<?php
require_once '../function/function.php';
$bdd = bdd ();
if(isset($_GET['type']) AND $_GET['type'] == 'membre') {
   if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
      $confirme = (int) $_GET['confirme'];
      $req = $bdd->prepare('UPDATE membres SET confirme = 1 WHERE id = ?');
      $req->execute(array($confirme));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM membres WHERE id = ?');
      $req2 = $bdd->prepare('DELETE FROM postsujet WHERE propri = ?');
      $req->execute(array($supprime));
      $req2->execute(array($supprime));
   } 

} elseif(isset($_GET['type']) AND $_GET['type'] == 'commentaire') {
   if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
      $approuve = (int) $_GET['approuve'];
      $req = $bdd->prepare('UPDATE postsujet SET approuve = 1 WHERE id = ?');
      $req->execute(array($approuve));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM postsujet WHERE id = ?');
      $req->execute(array($supprime));
   }
}
$membres = $bdd->query('SELECT * FROM membres ORDER BY id ');
$commentaires = $bdd->query('SELECT * FROM postsujet ORDER BY id ');
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title>Administration</title>
   <link rel="stylesheet" type="text/css" href="../css/general.css" >
</head>
<body>
   <div id="Cforum">
      <h1>Liste des membres</h1>
  <center> <ul>
      <?php while($m = $membres->fetch()) { ?>
      <li><?= $m['id'] ?> : <?= $m['pseudo'] ?><?php if($m['confirme'] == 0) { ?> - <a href="indexadmin.php?type=membre&confirme=<?= $m['id'] ?>">Confirmer</a><?php } ?> - <a href="indexadmin.php?type=membre&supprime=<?= $m['id'] ?>">Supprimer</a></li>
      <?php } ?>
   </ul></center>
   <br /><br />
   <h1>Messages des utilisateurs </h1>
   <center><ul>
      <?php while($c = $commentaires->fetch()) { ?>
      <li><?= $c['id'] ?> : <?= $c['propri'] ?> : <?= $c['contenu'] ?><?php if($c['approuve'] == 0) { ?> - <a href="indexadmin.php?type=commentaire&approuve=<?= $c['id'] ?>">Approuver</a><?php } ?> - <a href="indexadmin.php?type=commentaire&supprime=<?= $c['id'] ?>">Supprimer</a></li>
      <?php } ?>
   </ul></center>
      </div>
</body>
</html>