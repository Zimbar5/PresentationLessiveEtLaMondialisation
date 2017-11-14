<?php
session_start();
$_SESSION['erreur'] ="f";
// ---------------------- REQUETE SQL -----------------------

// on cree des arrays local pour pouvoir ensuite les transformer en variable de session
$_SESSION['Compteur_erreur'] = 0;
$liste_login = array();
$liste_nom = array();
$liste_mdp = array();
$liste_acc = array();

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
    $liste_login[] = $donnees['prénom'];
    $liste_nom[] = $donnees['nom'];
    $liste_mdp[] = $donnees['mdp'];
    $liste_acc[] = $donnees['lvl_accreditation'];

}

// permet de terminer une requete
$test->closeCursor();
// -------------------- FIN REQUETE SQL ----------------------

$connexion = false;

// on recupere les informations envoyees par la page d'acceuil
// htmlspecialchars previent de la faille XLS		
$login = htmlspecialchars($_POST['identifiant']);
$mot_de_passe = htmlspecialchars($_POST['mdp']);

// on verifie les conditions d'acces et on stocke les donnees correspondant 
// a celles de l'utilisateur dans des variable de session (globales)
for ($inc = 0; $inc < count($liste_login);$inc++){
	if ($login == $liste_login[$inc] && $mot_de_passe == $liste_mdp[$inc]){
        $_SESSION['Prenom'] = $liste_login[$inc];
        $_SESSION['Nom'] = $liste_nom[$inc];
        $_SESSION['Mdp'] = $liste_mdp[$inc];
        $_SESSION['Lvl'] = $liste_acc[$inc];
		$connexion = true;
	}
}

if($connexion == true){
	// si les informations sont bonnes on accède à la page d'acceuil
	header('Location: Acceuil.php');
	$_SESSION['Compteur_erreur'] = 0;

}else{
	// sinon on redirige vers la page de connexion
    header('Location: Acces.php');
    $_SESSION['Compteur_erreur']++;
}


?> 

