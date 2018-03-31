
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body background="<?php echo base_url(); ?>img/fond.jpg">
<div class="entraineur" >
		<form method="post" action="<?php echo site_url('Affiche_equipe/index/'.$nom) ?>"  >
		<h1> Créer un evenement ! </h1>
		<fieldset style="border-radius: 15px; text-align: center; background-color: #bdbdbd; opacity: 0.85;">
			<legend>Création d'evenement</legend>
			<label>Nom de l'evenement</label>
			<input name="nomEvent" placeholder="Tournoi" required>
			<label>Lieu</label>
			<input name="lieu" placeholder="Fontainebelau" ><br>
			<label> Date de début </label>
			<input name="dateDebut" type="date" placeholder="aaaa/mm/jj"  required><br>

			<label> Date de fin </label>
			<input name="dateFin" type="date" placeholder="aaaa/mm/jj" required><div class="erreur">
			<?php echo $erreur_date; ?>
		</div>

			<label> Heure de début </label>
			<input name="heureDebut" type="time" placeholder="14:00" required><br>

			<label> Heure de fin </label>
			<input name="heureFin" type="time" placeholder="17:30" required><br>

			<label> Type d'evenement </label>
			<select name="type" id="list">
			<option type="type" value="ponctuel" id="list">ponctuel</option>
				<option type="type" value="regulier"  >régulier</option>
			</select><br>

			<label> Periodicite<br>(Tous les combiens de jour l'evenement se répète) </label>
			<input name="periodicite" placeholder="Ponctuel ->(0) Regulier ->(>0) " required><br>


			<label>Description(200)</label>
			<textarea id="comments" name="description"></textarea>
		</fieldset>

				<button type="submit" name="creation_evenement">OK</button>
				<input value="Rafraichir" type="reset">
			</form>
			<div class="erreur">
			<?php echo $event_fail; ?>
		</div>
			<div class="success">
			<?php echo $event_success; ?>
		</div>

			</div>
			<br>

					</body>
				</html>
