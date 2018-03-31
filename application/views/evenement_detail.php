²
	</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body background="<?php echo base_url(); ?>img/fond.jpg">

			<?php foreach ($description as $info): ?>
			<h1> Evenement <?php echo $info->nom ?> </h1><br><br>
			<div class="profil">
				 <?php 
				 if ($createur==false) {
				 	echo anchor('Gestion_evenement/supprimer_evenement/'.$info->idEvenement,  '<button type="submit" class="bouton_non" >X</button>'); 
				 } ?><br>
				 <?php echo '   '.$info->description.'      <br> ce tournoi est '.$info->nature; ?><br>
			<?php echo 'Date de début: '.$info->dateDebut.' &nbsp; &nbsp; Date de fin: '.$info->dateFin.'<br> heure de début   '.$info->heureDebut.'&nbsp; &nbsp; heure de fin: '.$info->heureFin.'<br> crée par '.$info->loginEntraineur; ?><br><br>
			<?php endforeach; ?>

			Precisez votre participation a cet evenement :

           <?php echo anchor('Gestion_evenement/change_presence/oui/'.$info->idEvenement ,  '<button type="submit" class="bouton_oui" >Oui</button>'); ?>
           <?php echo anchor('Gestion_evenement/change_presence/non/'.$info->idEvenement ,  '<button type="submit" class="bouton_non"  >Non</button>');?>


			<TABLE >
				<TR>
					<TH>  </TH>
					<TH> Login </TH>
					<TH> Nom </TH>
					<TH> Prenom </TH>
					<TH> Participe </TH>
				</TR>
			<?php foreach ($membre as $membres) { ?>
			<tr><td> <img src="<?php echo base_url().'assets/avatar/'.$membres->avatar;?>" id="logo" width="50" height="50"></td><td>
				<?php echo $membres->login."</td><td>".$membres->nom."</td><td>".$membres->prenom."</td><td>".$membres->participation; ?> </td></tr>

			<?php } ?>
			</TABLE >
			<br><br>
	  </div>



	</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</html>
