<html>
  <head>
     <title> Mon super de site de ventes </title>
	 <meta charset="UTF-8">
	 <link rel="stylesheet" href="mesStyles.css" />
  </head>

  <body>
    <center> <h1> SUPERVENTES </h1> <br/><br/>
	<div style="float: left; margin-right: 20px; width:33%">
		<h3> Recherches </h3>
	  Sélectionnez les produits par une catégorie <br/>
	  <form action="http://localhost/produitsParCategorie1.php">
	   <select name="catégorie">
	     <option> téléphone </option>
		 <option> tablette </option>
		 <option> écouteurs </opton>
		 <option> ordinateur </opton>
		 <option> Appareil photo </opton>
		 <option> Disque dur </opton>
	   </select> <br/>
	   <input type="submit" value="Envoyez !"></input>
      </form>
	  <br/>
	  Sélectionnez tous les produits <br/>
	  <form action="http://localhost/produitsParCategorie1.php">
	   <input type="submit" value="Envoyez !"></input>
      </form>
	</div>
	<div style="float:left;  width:33%">
		<h3> Résultat de la recherche </h3>
	<?php
      $dsn = "mysql:host=localhost;dbname=superventes";  /* Data Source Name */
      $username = "root"; $password = "";
      $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
      $dbh = new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");

	  $where = "";
	  if (isset($_GET['catégorie'])) {
	    $cat = $_GET['catégorie'];
	    $where = " WHERE catégorie='$cat'";
	  }

	  $sql = "SELECT * FROM produits1 $where;";
	  //echo $sql;
	  
      $sth = $dbh->prepare($sql);
      $sth->execute(); /* Les données que le SGBD nous renvoie sont stockées en mémoire */
      $result = $sth->fetchAll(); /* Les données sont recopiées dans le tableau result */

	  echo "<table border='1'>";
	  echo "<tr><th>Nom</th><th>Marque</th><th>Catégorie</th><th>Prix</th></tr>";
	  foreach ($result as $enr) { /* Chaque élément de result est le tableau des attributs */
			echo "<tr><td>".$enr['Nom']."</td><td>".$enr['Marque']."</td><td>".$enr['Catégorie']."</td><td>".$enr['Prix']
			."</td><td><a href='produitsParCategorie1.php?numProduit=".$enr['numProduit']."'>acheter</a></td></tr>"; /* Affichage de l'attribut nom */
      }
      echo "</table>";
	?>
	</div>
	
	<?php
	  if (isset($_GET['numProduit'])) {
		$sql = "INSERT INTO produitsPaniers (emailClient, numProduit, quantité) VALUES
('claire.delune@gmail.com',".$_GET['numProduit'].", 1);";
	  echo $sql;
      $sth = $dbh->prepare($sql);
      $sth->execute();	    
	  }
	?>
	
	<div>
	<h3> Affichage du panier </h3>
	 <?php
	  $sql = "SELECT * FROM produitsPaniers;";
	  //echo $sql;
      $sth = $dbh->prepare($sql);
      $sth->execute(); /* Les données que le SGBD nous renvoie sont stockées en mémoire */
      $result = $sth->fetchAll(); /* Les données sont recopiées dans le tableau result */

	  echo "<table border='1'>";
	  echo "<tr><th>Num produit</th><th>Quantité</th></tr>";
	  foreach ($result as $enr) { /* Chaque élément de result est le tableau des attributs */
			echo "<tr><td>".$enr['numProduit']."</td><td>".$enr['quantité']."</td></tr>";
      }
      echo "</table>";
	?>
	</div>

  </body>

</html>



