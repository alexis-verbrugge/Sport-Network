

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body background="<?php echo base_url(); ?>img/fond.jpg">

<?php foreach ($equipe as $equipes):
$nom=$equipes->nomEquipe; ?>
<div class="admin">
<form method="post" action="<?php echo site_url('Affiche_equipe/index/'.$nom) ?>" >
	<h1> Nommer un entraineur ! </h1>
	<fieldset style="border-radius: 15px; text-align: center; background-color: #bdbdbd; opacity: 0.85;">
		<legend>Nommer un entraineur</legend>
		<label>Nom du membre</label>
		<input id="loginMembre" placeholder="Jean77" name="loginMembre_un" ><br>
		 <div class="erreur">
							<?php echo $deja_entraineur; ?>
		<?php echo $membre_pas_dans_equipe; ?>
<?php echo $membre_inexistant; ?>
            </div>
		 <div class="success" >
		<?php echo $entraineur_success; ?>
		</div>




	</fieldset>
	<button type="submit" name="nomme_entraineur" style="display:block; margin:auto;">OK</button>

</form>

<form method="post" action="<?php echo site_url('Affiche_equipe/index/'.$nom) ?>">


	<h1> Inviter des membres dans l'equipe ! </h1>
	<fieldset style="border-radius: 15px; text-align: center; text-align: center; background-color: #bdbdbd; opacity: 0.85;">
		<legend>Inviter un membre</legend>
		<label>Nom du membre</label>
		<input id="loginMembre2" placeholder="Jean77" name="loginMembre_deux" ><br>

	</fieldset>
	<button type="submit" name="invite_membre" style="display:block; margin:auto;">OK</button>

</form>
	 <div class="erreur">
	<?php echo $membre_inexistant_2; ?>
	<?php echo $membre_pas_dans_equipe_2; ?>
	</div>
	 <div class="success">
	<?php echo $invitation_success; ?>
	</div>

	<form method="post" action="<?php echo site_url('Affiche_equipe/index/'.$nom) ?>">
	<h1> Bannir un membre de l'equipe ! </h1>
	<fieldset style="border-radius: 15px;text-align: center;text-align: center; background-color: #bdbdbd; opacity: 0.85;">
		<legend>Bannir un membre</legend>
		<label>Nom du membre</label>
		<input id="loginMembre3" placeholder="Jean77" name="loginMembre_trois" ><br>

	</fieldset>
	<button type="submit" name="bannir_membre" style="display:block; margin:auto; ">OK</button>

	</form>
	 <div class="erreur">
	<?php echo $membre_inexistant_3; ?>
	<?php echo $membre_pas_dans_equipe_3; ?>
	</div>
	 <div class="success">
	<?php echo $banni_success; ?>
	</div>


	<?php endforeach; ?>
</div>
		</body>
				</html>
