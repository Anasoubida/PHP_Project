<html>
  <head>
     <title> Mon super de site de ventes </title>
	 <meta charset="UTF-8">
	 <link rel="stylesheet" href="mesStyles.css" />
  </head>

  <body>
    <center> <h1> SUPERVENTES </h1> 
	<?php 
	session_start();
	if($_SESSION["loggedin"] == true){
		echo "<h3>utilisateur connecté ".$_SESSION["username"]."</h3>"; 
	}
	?>
	<br/><br/>
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
      $db_username = "root"; $db_password = "";
      $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
      $dbh = new PDO($dsn, $db_username, $db_password, $options) or die("Pb de connexion !");

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
	
	$register_username_err = "";
	$register_username = "";
	$register_password_err = "";
	$register_password = "";
	$nom_err = "";
	$nom = "";
	$prenom_err = "";
	$prenom = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Validate username and password
		if(empty(trim($_POST["login_username"])) && empty(trim($_POST["login_password"]))){
			$login_username_err = "Please enter a username.";
		} else{
			$login_username = $_POST["login_username"];
			$login_password = $_POST["login_password"];
			// Prepare a select statement
			$where = " WHERE email='$login_username' and password='$login_password'";
			$sql = "SELECT * FROM clients $where;";
			$sth = $dbh->prepare($sql);
      		/* Les données que le SGBD nous renvoie sont stockées en mémoire */
			try{
				$sth->execute(); 
			}catch(PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			  }
      		$result_login = $sth->fetchAll(); /* Les données sont recopiées dans le tableau result */
			  
			  if (empty($result_login)){
				
				$login_username_err = "User not found";
				} else{
					session_start();        
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $login_username;
				}
			  }
		}
	?>
	<div style="float:left;  width:33%">
        <h2>Authentification</h2>
        <form action="http://localhost/produitsParCategorie1.php" method="post">
            <div >
                <label>Email</label>
                <input type="email" name="login_username" value="<?php echo $login_username; ?>">
                <span ><?php echo $login_username_err; ?></span>
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="login_password">
                <span ><?php echo $login_password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Se connecter">
            </div>
        </form>
    </div>

	<?php
	
	$login_username = "";
	$login_password = "";
	$login_username_err = "";
	$login_password_err = "";
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		// Validate username
		if(empty(trim($_POST["register_username"]))){
			$register_username_err = "Please enter a username.";
		} else{
			$register_username = $_POST["register_username"];
			// Prepare a select statement
			$where = " WHERE email='$register_username'";
			$sql = "SELECT * FROM clients $where;";
			$sth = $dbh->prepare($sql);
      		/* Les données que le SGBD nous renvoie sont stockées en mémoire */
			try{
				$sth->execute(); 
			}catch(PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			  }
      		$result_login = $sth->fetchAll(); /* Les données sont recopiées dans le tableau result */
			  
			  if (! empty($result_login)){
				
				$register_username_err = "This username is already taken.";
				} else{
				$register_username = trim($_POST["register_username"]);
				}
			  }
		}
	
		// Validate password
		if(empty(trim($_POST["register_password"]))){
			$register_password_err = "Please enter a password.";     
		} elseif(strlen(trim($_POST["register_password"])) < 6){
			$register_password_err = "Password must have atleast 6 characters.";
		} else{
			$register_password = trim($_POST["register_password"]);
		}
		
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		
		// Check input errors before inserting in database
		if(empty($register_username_err) && empty($register_password_err) ){
			
			// Prepare an insert statement
			$sql = "INSERT INTO clients (email, password, nomClient, prénom) VALUES ('$register_username', '$register_password', '$nom', '$prenom')";
			 try{
				$sth = $dbh->prepare($sql);
				$sth->execute();
			 }catch(PDOException $e) {
				echo $sql . "<br>" . $e->getMessage();
			  }       		
		}
	?>

	<div style="float:left;  width:33%">
        <h2>Inscription</h2>
        <form action="http://localhost/produitsParCategorie1.php" method="post">
            <div class="form-group <?php echo (!empty($register_username_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input  type="email" name="register_username" class="form-control" value="<?php echo $register_username; ?>">
                <span ><?php echo $register_username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($register_password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="register_password" class="form-control">
                <span class="help-block"><?php echo $register_password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($nom_err)) ? 'has-error' : ''; ?>">
                <label>nom</label>
                <input  name="nom" class="form-control" value="<?php echo $nom; ?>">
                <span ><?php echo $nom_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($prenom_err)) ? 'has-error' : ''; ?>">
                <label>prenom</label>
                <input name="prenom" class="form-control">
                <span class="help-block"><?php echo $prenom_err; ?></span>
            </div>
            <div >
                <input type="submit" value="S'inscrire">
            </div>
        </form>
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



