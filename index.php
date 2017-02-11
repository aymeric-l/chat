<?php 
	session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '' );
	if(isset($_POST['pseudo'], $_POST['password'])){
		$_SESSION['pseudo']= $_POST['pseudo'];
		$_SESSION['password']= $_POST['password'];
		$utilisateurs = $bdd->query("SELECT * FROM login");
		foreach ($utilisateurs as $key => $login) {
			if($login['pseudo'] == ucfirst($_SESSION['pseudo']) AND $login['password'] == $_SESSION['password']){
				$connect = true;
			}
		}
		if($connect == false){
			session_unset(); 
			session_destroy();
		}
	}
?>


<?php 
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '' ); // Connexion à la base de données
	$contenu = $bdd->query("SELECT * FROM chat ORDER BY id DESC");// Selectionne tout le contenu du tableau 'chat' par id décroissant
?>

<!DOCTYPE html>
<html>
<head>
	<title>Le chat de la fabrik !</title>
</head>
<body>

<?php 
if(isset($_SESSION["pseudo"], $_SESSION["password"])){
	echo "<form action='traitement.php' method='post'>";
	echo 	"<label>Message : </label><input type='text' name='message' placeholder='Message' >";
	echo 	"<input type='submit' name='bouton'>";
	echo "</form>";
}else{
	echo "<form action='index.php' method='post'>";
	echo "<label>Votre pseudo : </label><input type='text' name='pseudo' placeholder='Pseudo' >";
	echo "<label>Mot de Passe : </label><input type='password' name='password' placeholder='Mot de passe' >";
	echo 	"<button type='submit' name='bouton'>Connexion</button>";
	echo "<a href='inscription.php'><input type='button' value='INSCRIPTION' style='margin-left: 15px;height:50px;width:120px;' ></a>";
	echo "</form>";

}
?>

<?php
	$droit = 'blue';
	//On parcoure le tableau et à chaque nouvelles lignes, on ajoute son contenu dans la variable $ligne
	foreach ($contenu as $ligne) {
		if($ligne['droit'] == 'admin'){$droit = 'red';}else if($ligne['droit'] == 'modo'){$droit = 'green';}
		echo $ligne['id'] . ') <span style="color:' . $droit . '; font-weight:bold;">' . ucfirst($ligne['pseudo']) . '</span> : ' .$ligne['message'] .  '</br>';
		$droit = 'blue';
	}
	if(isset($_SESSION["pseudo"], $_SESSION["password"])){
		echo "<form action='deconnexion.php' method='post'>";
		echo 	"<button type='submit' name='bouton'>Déconnexion</button>";
		echo "</form>";
	}
?>

</body>
</html>