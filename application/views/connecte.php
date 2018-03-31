<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css">
	</head>

<body background="<?php echo base_url(); ?>img/fond.jpg">
	<h1> Accueil </h1><br>
		<div class="Presentation" style="border-radius:15px;">
		<p> Bienvenue sur votre profil <?php echo $login ?> ! <br>
			Vous pouvez dès maintenant créer votre equipe pour organiser les évenements de votre club sportif. Vous en deviendrez alors automatiquement administrateur avec le pouvoir d'inviter des membres et de nommer des entraineurs par la suite.
			Le formulaire de droite vous permet de rejoindre une equipe si votre entraineur vous a transmis le mot de passe ultèrieurement.
			Les icones que vous pouvez voir sur la barre de navigation vous permettent respectivement de voir vos évenements prévus, d'accéder a votre profil et de vous déconnecter. </p>
		</div>

	<div class="creer_equipe">
		<div class="formulaire1">
		<form method="post" action="<?php echo site_url('Gestion_equipe') ?>" enctype="multipart/form-data">
					<h1> Créer une équipe </h1>
					<fieldset  style="border-radius: 15px; background-color: #bdbdbd;  opacity: 0.80;text-align: center; " >
			<legend>Création d'équipe</legend>
			<label>Nom de l'équipe</label> 
			<input name="nomEquipe" placeholder="DreamTeam" required > <div class="erreur"><?php echo $nom_utilise ?></div>
			<label>Mot de passe</label> 
			<input type="password" name="mdp" required> &nbsp; <div class="erreur"><?php echo $mdp_non_concordant ?></div>
			<label>Confirmation</label>
			<input type="password" name="confirm" required> &nbsp;<br>
			<label>Ville</label>
			<input name="ville" placeholder="Fontainebelau" required ><br>
			<label>Sport</label>
			<select name="sport" id="sport">
			<option value="Accrobranche">Accrobranche</option>
				<option value="Aikido">Aikido</option>
				<option value="Aqua gym">Aqua gym</option> 
				<option value="Athlétisme">Athlétisme</option>
				<option value="Badminton">Badminton</option>
				<option value="Baseball">Baseball</option>
				<option value="Basket ball">Basket ball</option>
				<option value="Boxe américaine">Boxe américaine</option>
				<option value="Boxe française">Boxe française</option>
				<option value="Canoë kayak">Canoë kayak</option>
				<option value="Curling">Curling</option>
				<option value="Cyclisme sur piste">Cyclisme sur piste</option>
				<option value="Danse">Danse</option>
				<option value="Equitation">Equitation</option>
				<option value="Escalade">Escalade</option>
				<option value="Escrime">Escrime</option>
				<option value="Fitness">Fitness</option>
				<option value="Football">Football</option>
				<option value="Futsal">Futsal</option>
				<option value="Golf">Golf</option>
				<option value="Gymnastique">Gymnastique</option>
				<option value="Handball">Handball</option>
				<option value="Hockey sur glace">Hockey sur glace</option>
				<option value="Judo">Judo</option>
				<option value="Karaté">Karaté</option>
				<option value="Karting">Karting</option>
				<option value="Kung fu">Kung fu</option>
				<option value="Lutte libre">Lutte libre</option>
				<option value="Moto cross">Moto cross</option>
				<option value="Musculation">Musculation</option>
				<option value="Natation">Natation</option>
				<option value="Ninjutsu">Ninjutsu</option>
				<option value="Nunchaku">Nunchaku</option>
				<option value="Parapente">Parapente</option>
				<option value="Patinage artistique">Patinage artistique</option>
				<option value="Pêche">Pêche</option>
				<option value="Pelote basque">Pelote basque</option>
				<option value="Pétanque">Pétanque</option>
				<option value="Plongée">Plongée</option>
				<option value="Rafting">Rafting</option>
				<option value="Roller">Roller</option>
				<option value="Rugby à XIII">Rugby à XIII</option>
				<option value="Rugby à XV">Rugby à XV</option>
				<option value="Salsa">Salsa</option>
				<option value="Self défense">Self défense</option>
				<option value="Ski alpin">Ski alpin</option>
				<option value="Ski de fond">Ski de fond</option>
				<option value="Ski nautique">Ski nautique</option>
				<option value="Snowboard">Snowboard</option>
				<option value="Sumo">Sumo</option>
				<option value="Surf">Surf</option>
				<option value="Taekwondo">Taekwondo</option>
				<option value="Taï jitsu">Taï jitsu</option>
				<option value="Tennis">Tennis</option>
				<option value="Tennis de table">Tennis de table</option>
				<option value="Tir à l'arc">Tir à l'arc</option>
				<option value="Ultimate Frisbee">Ultimate Frisbee</option>
				<option value="Volley ball">Volley ball</option>
				<option value="Water polo">Water polo</option>

			</select>
			<label>Mixité</label> <div class="erreur"><?php echo $erreur_sexe ?></div>
			<select id="mixite" name="mixite">
				<option value="mixte" id="mixte">Mixte</option>
				<option value="homme" id="non-mixte">Homme</option>
				<option value="femme" id="non-mixte">Femme</option>
			</select><br>
			<label>Logo</label>
			<input name="logo" type="file" id="fichier_a_uploader" /><br>
			<label>Photo</label>
			<input name="photo" type="file" id="fichier_a_uploader" /><br>
			<label>Description(200)</label>
			<textarea id="comments" name="description"></textarea>
		</fieldset>

				<button type="submit" name="creation_equipe">OK</button>
				<input value="Rafraichir" type="reset">
			</form><div class="erreur">
			<?php echo $nb_max_admin ?>
		</div>
		<div class="success">
			<?php echo $equipe_success ?>
		</div>	
			</div>
			<br>

		<form method="post" action="<?php echo site_url('Gestion_equipe') ?>">
		<h1> Rejoignez une équipe ! </h1>
		<fieldset style="border-radius: 15px; background-color: #bdbdbd;  opacity: 0.80; text-align: center; ">
		<legend>Trouver votre equipe</legend>
		<label>Nom de l'équipe</label>
			<input id="nomEquipe" placeholder="DreameTeam" name="nomEquipe2" ><div class="erreur"> <?php echo $pas_equipe ?> <?php echo $appartient_deja ?> <?php echo $sexe_faux ?></div>
			<label>Mot de passe</label> 
			<input type="password" name="mdp2" required> &nbsp; <div class="erreur"><?php echo $mdp_equipe_faux ?></div>
			</fieldset>
	  <button type="submit" name="recherche_nom">OK</button>
	    <div class="success">
	  <?php echo $rejoins_equipe_success ?>
	</div>
	  </form>
	  
	  </div>
	  <br>

</article>
		
	</body>
</html>

