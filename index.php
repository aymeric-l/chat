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
				$_SESSION['droit'] = $login['droit'];
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
	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		function message() {
		   $.ajax({
		      type: "GET",
		      url: "messages.php"
		   }).done(function (html) {
		      $('#messages').html(html); // Retourne dans #maDiv le contenu de ta page
		      setTimeout(message, 5000);
		   });
		}      
		message();
	</script>
</head>
<body>

<?php 
if(isset($_SESSION["pseudo"], $_SESSION["password"])){
	echo "<form action='traitement.php' method='post' style='padding-bottom:16px;'>";
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
// if(isset($_SESSION['droit'])){
// 	if($_SESSION['droit'] == 'admin'){
// 		echo "<form action='admin.php' method='post'>";
// 		echo "<input type='text' name='message_cible' placeholder='Message à modifier' style='width:150px'>";
// 		echo "<input type='submit' name='boutonDroit'>";
// 	}
// }

?>
<div id="messages"></div>
<?php

	if(isset($_SESSION["pseudo"], $_SESSION["password"])){
		echo 	"<a href='deconnexion.php'><input type='button' name='bouton' value='Déconnexion'></a>";
	}
?>

</body>
</html>