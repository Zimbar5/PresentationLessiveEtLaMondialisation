<?php
session_start();
if (isset($_COOKIE['Connex'])){

}else{
    header('Location: Acces.php');
}

?>

<!DOCTYPE>
<html>

    <meta charset="utf-8" />
    <title> Gestion accès </title>
    <link rel="stylesheet" href="../css/Gestion_acces_css.css">

<!-- tete de page !-->
<header>
	<div id="perso">
		<div id="menu">
			<ul id="menu-deroulant">
				<li><a href="" id="nom_prenom"> </a>
					<ul>
						<li id="rubriquederoulante"><a href="Acceuil.php"> Acceuil </a> </li>
						<li id="rubriquederoulante"><a href="Nouvelle_fiche.php"> Nouvelle fiche </a> </li>
						<li id="rubriquederoulante"><a href="Traitement_deconnexion.php"> Deconnexion </a> </li>
					</ul>
				</li>
			</ul>
			<img src="../images/perso.png" id="perso" width="25px" height="23px">
		</div>

		<script>
			<?php 
			$Prenom = $_SESSION['Prenom'];
			$Nom = $_SESSION['Nom'];
			$Accreditation = $_SESSION['Lvl'];
			$Mdp = $_SESSION['Mdp'];
			?>
			var prenom = '<?php echo $Prenom;?>';
			var nom = '<?php echo $Nom;?>';
			document.getElementById("nom_prenom").innerHTML = "▾ " +  prenom + " " + nom;
		</script>
	</div>
</header>

<body>
	<h1> Gestion des accès </h1>
	<div id="gestion_acces">
		<p id="liste_acces">  </p>
		<?php
		try
		{
		    // connexion avec la BDD
		    $bdd = new PDO('mysql:host=localhost;dbname=Noms_autorisation_BIMO;charset=utf8', 'root', 'root');
		}
		catch (Exception $e)
		{
		    // permet d'afficher un message d'erreur en cas d'echec
		        die('Erreur : ' . $e->getMessage());
		}
		// requete SQL
		$test = $bdd->query('SELECT * FROM Autorisation');

		// fetch affiche la ligne que l'on stocke dans des listes
		while ($donnees = $test->fetch()){
		    $liste_login_php[] = $donnees['prénom'];
		    $liste_nom_php[] = $donnees['nom'];
		    $liste_mdp_php[] = $donnees['mdp'];
		    $liste_acc_php[] = $donnees['lvl_accreditation'];
		}
		// permet de terminer une requete
		$test->closeCursor();
		$he = "ahhhh";
		?>

		<script type="text/javascript">
			// on verifie qu'on possede le meme nombre d'informations dans chaque liste sinon on previent d'une erreur
			if ("<?php count($liste_login_php);?>" == "<?php count($liste_nom_php);?>" == "<?php count($liste_mdp_php);?>" == "<?php count($liste_acc_php);?>"){
				var taille_listes = "<?php echo count($liste_login_php);?>";
			} else{
				alert("Veuillez vérifier les données d'accès");
			}
			// json_encode permet de retourner le tableau php dans un format lisible par JS
			// on recupere alors toutes les listes
			var liste_log = <?php echo json_encode($liste_login_php) ; ?>;
			var liste_nom = <?php echo json_encode($liste_nom_php) ; ?>;
			var liste_mdp = <?php echo json_encode($liste_mdp_php) ; ?>;
			var liste_acc = <?php echo json_encode($liste_acc_php) ; ?>;

			for (var i=0; i < taille_listes; i++){
				liste_acces.innerHTML += liste_log[i] +" "+ liste_nom[i] +" "+ liste_mdp[i] +" "+ liste_acc[i] +" " +  "<img id='close' src='../images/close.png' width='1%' onclick='Delete_function('<?php echo $he; ?>')'/>" + "</br>";
			}
			var Delete_function = function(idt){
				alert(idt);
			}
		</script>



		
	</div>

	<h1> Création nouvel accès </h1>
	<div id="nouvel_acces">
		<form action="Traitement_creation_acces.php" method="post">
			<p>
				<label for="identifiant"> Identifiant : </label> <input type="text" name="identifiant" value="Identifiant"> </br>
				<label for="nom"> Nom : </label> <input type="text" name="nom" value="Nom"> </br>
				<label for="accredit"> Niveau accréditation : </label> <input type="number" name="accredit"  value="3" min="1" max="3"> </br>				
				<label for="psw1"> Mot de passe : </label> <input type="password" name="psw1" value="xxxxx"> </br>
				<label for="psw2"> Confirmation : </label> <input type="password" name="psw2" value="xxxxx"> </br>

				<input type="submit" value="Création accès">
			</p>
	        <p id="Msg_creation"> </p>
	        <script>
		        <?php
		        $creation = $_SESSION['Crea_acces'];
		        ?>
		        var crea = '<?php echo $creation;?>'

		        // traitement lors de deux mdp differents
		        if (crea == "erreur_mdp"){
		            Msg_creation.innerHTML = "Erreur création, les mots de passe sont différents";
		            document.getElementById("Msg_creation").style.color = "red";
		            <?php $_SESSION['Crea_acces'] = "";?>

		        // traitement lorsque l'utilisateur existe deja
		        } else if(crea == "erreur_existance"){
		            Msg_creation.innerHTML = "Erreur création, l'utilisateur existe déjà";
		            document.getElementById("Msg_creation").style.color = "red";
		            <?php $_SESSION['Crea_acces'] = "";?>

		        // traitement lorsque tout est ok
		        } else if(crea == "ok"){
		        	Msg_creation.innerHTML = '<img src="../images/valide.jpg" width="20" height="20"> Nouvel utilsateur ajouté';
		        	document.getElementById("Msg_creation").style.color = "green";
		        	<?php $_SESSION['Crea_acces'] = "";?>
		        }
		    </script>
		</form>
	</div>



</body>
</html>