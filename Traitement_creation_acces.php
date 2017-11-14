<?php
session_start();
if (isset($_COOKIE['Connex'])){

}else{
	header('Location: Acces.php');
}

$_SESSION['Crea_acces'] = "";

// si les champs sont remplis on recupere les champs
if(isset($_POST['identifiant']) && isset($_POST['nom']) && isset($_POST['accredit']) && isset($_POST['psw1']) && isset($_POST['psw2'])){
	$identifiant = htmlspecialchars($_POST['identifiant']);
	$nom = htmlspecialchars($_POST['nom']);
	$accredit = htmlspecialchars($_POST['accredit']);
	$psw1 = htmlspecialchars($_POST['psw1']);
	$psw2 = htmlspecialchars($_POST['psw2']);

	// si les deux mdp ne sont pas identiques on recommence
	if($psw1 != $psw2){
		$_SESSION['Crea_acces'] = "erreur_mdp" ;
		header('Location: Gestion_acces.php');

	// sinon on effectue une requete sql pour ajouter un utilisateur
	}else{
		try{
		    // connexion avec la BDD
		    $bdd = new PDO('mysql:host=localhost;dbname=Noms_autorisation_BIMO;charset=utf8', 'root', 'root');
		}
		catch (Exception $e){
		    // permet d'afficher un message d'erreur en cas d'echec
		        die('Erreur : ' . $e->getMessage());
		}

		$test = $bdd->query('SELECT * FROM Autorisation');
		// fetch affiche la ligne que l'on stocke dans des listes
		while ($donnees = $test->fetch()){
		    $liste_login[] = $donnees['prénom'];
		    $liste_nom[] = $donnees['nom'];
		}

		// si l'utilisateur possede deja un compte on l'indique
		if(in_array($identifiant,$liste_login) && in_array($nom,$liste_nom)){
			$_SESSION['Crea_acces'] = "erreur_existance" ;
			header('Location: Gestion_acces.php');

		// sinon on ajoute les informations 
		} else{
			$bdd->exec('INSERT INTO Autorisation(prénom, nom, mdp, lvl_accreditation) VALUES("'.$identifiant.'", "'.$nom.'", "'.$psw1.'", "'.$accredit.'")');
			$_SESSION['Crea_acces'] = "ok";
			header('Location: Gestion_acces.php');

		}
	}
}

?>