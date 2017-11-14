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
    <title>  Acceuil  </title>
    <link rel="stylesheet" href="../css/Acceuil_css.css">

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

<!--  dessous la tete de page !-->
<nav>
</nav>

<!-- corps de la page !-->
<article>
</article>

<!-- droite de la page !-->
<div id="droite">
	<aside>
		<div id="nouvel_acces">
			<script type="text/javascript">
				// si on a le niveau d'accreditation max alors on peut ajouter un nouvel utilisateur
				var acc = '<?php echo $Accreditation;?>';
				if (acc == 1){
					document.getElementById("nouvel_acces").innerHTML = '<a href="Gestion_acces.php">Gestion accès</a>';
				}
			</script>
		</div>
	</aside>

	<aside>
	</aside>

</div>

<!-- pied de page !-->
<footer>
</footer>



</html>





