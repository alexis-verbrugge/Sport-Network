<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body background="<?php echo base_url(); ?>img/fond.jpg">
		

			<?php foreach ($infos as $info): ?>
			<h1> Bienvenue sur votre profil <?php echo $info->login; ?></h1>
			<div class="profil"><br><br>
				<img src="<?php echo base_url().'assets/avatar/'.$info->avatar;?>" id="avatar" width="250" height="250" ><br>

				<p style="text-align: center;"> 	<?php echo $info->nom.'   '.$info->prenom.'      '.$info->sexe; ?><br>
				<?php echo 'pseudo: '.$info->login; ?><br>
				creer le : <?php echo $info->dateCreation; ?></p>
			
			
			<?php endforeach; ?>
		</div>


		<h1> Accéder à mes équipes</h1><br>
		<div class="Presentation">
		<p> Vous avez ici la possibilité d'accéder à toutes les equipes où vous êtes membres ou bien entraineur.
			Vous pouvez ainsi en consulter les informations de base, c'est à dire les membres et les entraineurs qui la compose.
			L'administrateur a la possibilté d'inviter des membres  dans l'equipe, d'en ejecter ou encore de nommer des entraineurs.
			Les entraineurs ont eux la possibilité de créer des évènements que vous pouvez consulter sur la barre de navigation avec l'onglet
			en forme de calendrier. En appuyant sur la croix vous quitterez l'equipe </p>
		</div>

		<h1> Equipes où vous êtes membre</h1>
		
		 <?php if ($a_des_equipes_membre==false && $a_des_equipes_entraineur==false) { ?>
		 	<p>Vous n'avez pas encore d'équipe mais sur l'accueil vous pouvez en créer une ou bien en rejoindre une si vous en connaissez le mot de passe.
			<a href="<?php echo site_url('Gestion_equipe') ?>" >ici</a> </p>
		<?php 	} else { 
		  foreach ($equipes as $equipe): ?>


		 <div class="equipe">
		 	<?php $nom = $equipe->nomEquipe; ?>
		 
		 	<img src="<?php echo base_url().'assets/avatar/'.$equipe->logo ?>" id="logo" width="50" height="50">
		  <a href="<?php echo site_url('Affiche_equipe/index/'.$nom) ?>"> <?php echo $equipe->nomEquipe ?> </a>
		  <?php echo anchor('Profil/quitter_equipe/'.$equipe->nomEquipe,  '<button type="submit" class="bouton_non" >X</button>'); ?><br>

		<p> 	<?php echo "ville : ".$equipe->ville."&nbsp; &nbsp; sport : ".$equipe->sport."&nbsp; &nbsp; mixite : ".$equipe->mixite ?> </p></div>

	    <div>
		<?php endforeach; ?> 
		<h1> Equipes où vous êtes entraîneur</h1>
		 <?php foreach ($equipes_entraineur as $equipe): ?>


		 <div class="equipe">
		 	<?php $nom = $equipe->nomEquipe; ?>
		 	<img src="<?php echo base_url().'assets/avatar/'.$equipe->logo ?>" id="logo" width="50" height="50">
		  <a href="<?php echo site_url('Affiche_equipe/index/'.$nom) ?>"> <?php echo $equipe->nomEquipe ?> </a><br>

		<p> 	<?php echo "ville : ".$equipe->ville."&nbsp; &nbsp; sport : ".$equipe->sport."&nbsp; &nbsp; mixite : ".$equipe->mixite ?> </p></div>

	    <div>
		<?php endforeach; 
	} ?> 
	</body>
</html>
