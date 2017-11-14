<?php
session_start();
if (isset($_COOKIE['Connex'])){

}else{
    setcookie('Connex','false',time() + 1000, null, null, false, true);
}

?>

<!DOCTYPE>
<html>

    <meta charset="utf-8" />
    <title> Espace connexion </title>
    <link rel="stylesheet" href="../css/Acces_css.css">


<body>
	<h1> Espace de connexion </h1>

	<form action="Traitement_Connexion.php" method="post">
		<p>
			<input type="text" name="identifiant" value="Identifiant">
			<input type="password" name="mdp" value="Mot de passe">
			<input type="submit" value="Connexion">
		</p>
        <p id="Msg_mauvaise_connexion"> </p>
	</form>

    <script>
        <?php
        $compt = $_SESSION['Compteur_erreur'];
        ?>

        var compteur = '<?php echo $compt;?>'

        if (compteur > 0){
            Msg_mauvaise_connexion.innerHTML = "Erreur connexion, veuillez réessayer";
            document.getElementById("Msg_mauvaise_connexion").style.color = "red";
        }

    </script>



</body>
</html>