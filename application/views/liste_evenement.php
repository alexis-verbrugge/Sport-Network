
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body background="<?php echo base_url(); ?>img/fond.jpg">


	<h1> Mes evenements prevus </h1>
		<div class="profil"><br><br>
			<?php if ($pas_event==true) { ?>
			<TABLE >
				<TR>

					<TH> Nom de l'event </TH>
					<TH> Nom de l'equipe </TH>
					<TH> Date de debut </TH>
					<TH> Date de fin </TH>
				</TR>
			<?php foreach ($event as $info): ?>

				<tr><td> <a href="<?php echo site_url('Gestion_evenement/evenement_detail/'.$info->idEvenement) ?>"> <?php echo $info->nom ?></a> </td><td><?php echo $info->nomEquipe."</td><td>".$info->dateDebut."</td><td>".$info->dateFin."</td></tr>" ?><br><br>

			<?php endforeach; ?>
			</TABLE >
			<?php }
			else {  ?>
			Vous n'avez pas encore d'évènements organisés demandez a votre entraineur d'en créer un ou bien si vous l'êtes vous pouvez le faire sur les détails de votre equipe.
			<a href="<?php echo site_url('Profil') ?>" >ici</a> 
		<?php	} ?>
		</div>

	</body>
</html>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
