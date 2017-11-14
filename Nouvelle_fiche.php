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
    <title> Nouvelle fiche </title>
    <link rel="stylesheet" href="../css/Nouvelle_fiche.css">

<body>
	<table id="fiche">
		<tr>
			<th rowspan="3"> Sources </th>
			<th colspan="4"> AVANT HOSPITALISATION </th>
			<th colspan="4"> PENDANT HOSPITALISATION </th>
			<th colspan="4" rowspan="2"> CONCILIATION DU : <input type="date" id="format_date" value="dd/mm/aaaa"> </input> </th>
		</tr>
	   	<tr>
	       	<th colspan="4"> TRAITEMENT HABITUEL </th>
	       	<th colspan="4"> TRAITEMENT DU : <input type="date" id="format_date" value="dd/mm/aaaa"> </input></th>
	       	<th colspan="4">  </th>
	    </tr>
	    <tr>
	        <th> Medicament </th>
	        <th> Dosage </th>
	        <th> Forme </th>
	        <th> Poso </th>
	        <th> Medicament </th>
	        <th> Dosage </th>
	        <th> Forme </th>
	        <th> Poso </th>
	        <th> Divergence </th>
	        <th> Proposition pharmacien </th>
	        <th> Décision médecin </th>
	        <th> Fait le : </th>

	    </tr>
	    <tr>
	   		<td><SELECT> 
	   				<option> Ordonnance médecin </option>
	   				<option> Entretien patient </option>
	   				<option> Entretien pharmacien </option>
	   		    </SELECT></td>
	   		<td> </td>
	   		<td> </td>
	   		<td> </td>
	   		<td> </td>
	   		<td> </td>
	   		<td> </td>
	   		<td> </td>
	   		<td> </td>
	   		<td><SELECT>
	   				<option> 1 </option>
	   				<option> 2 </option>
	   				<option> 3 </option>
	   				<option> 4 </option>
	   				<option> 5 </option>
	   				<option> 6 </option>
	   			</SELECT> </td>
	   		<td><SELECT>
	   				<option> Arrêter </option>
   					<option> Suspendre</option>
   					<option> Remplacer par : </option>
	   			</SELECT> </td>
	   		<td> </td>
	   		<td> <input type="date" id="format_date" value="dd/mm/aaaa"> </td>
   		</tr>
	</table>

	<input type="submit" name="Nouvelle_ligne" value="+ Nouvelle ligne" onclick="ajout_ligne()">

	<script> 
		function ajout_ligne(){
			var tableau = document.getElementById("fiche");
			var ligne = document.createElement("tr");

			
			tableau.appendChild(ligne);
			for (var i=0;i<13;i++){
				var cellule = document.createElement("td");
				var champ = document.createElement("input");
				ligne.appendChild(cellule);
				cellule.appendChild(champ);
			}
		}
	</script>

<!-- script permettant de modifier le style des cases du tableau !-->
	<script>
		var arrayLignes = document.getElementById("fiche").rows;
		var longueur = arrayLignes.length;
		arrayLignes[1].cells[0].style.color="red";
		arrayLignes[1].cells[1].style.color="blue";
		arrayLignes[2].cells[4].style.color="blue";
		arrayLignes[2].cells[5].style.color="blue";
		arrayLignes[2].cells[6].style.color="blue";
		arrayLignes[2].cells[7].style.color="blue";
	</script>

	<script>

	</script>


</body>


</html>