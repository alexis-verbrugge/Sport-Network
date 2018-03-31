
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body background="<?php echo base_url(); ?>img/fond.jpg">
	<article>
		<div class="equipe"><br><br>
			

			<?php foreach ($equipe as $equipes): ?>
			<h1> Bienvenue sur votre equipe: <?php echo $equipes->nomEquipe ?> </h1>
			<img src="<?php echo base_url().'assets/avatar/'.$equipes->logo;?>" id="logo" width="200" height="200"><br>
				<img src="<?php echo base_url().'assets/avatar/'.$equipes->photo;?>" id="photo" width="200" height="200">
				
				
				<p> <?php echo 'sport: '.$equipes->sport."&nbsp &nbsp mixite: ".$equipes->mixite; ?><br>
				<?php echo 'description: <br>'.$equipes->description; ?><br> </p>
			<?php endforeach; ?>
			<h1> Admin </h1>
			<TABLE > 
				<TR> 
					<TH>  </TH> 
					<TH> Login </TH> 
					<TH> Nom </TH> 
					<TH> Prenom </TH>
					<TH> sexe </TH> 
				</TR> 
				<?php foreach ($admin_equipe as $admin_equipes): ?>
					<tr><td><img src="<?php echo base_url().'assets/avatar/'.$admin_equipes->avatar;?>" width="50" height="50" class="avatar"></td><td>
						<?php echo $admin_equipes->login?></td><td><?php echo  $admin_equipes->nom ?></td><td><?php echo $admin_equipes->prenom ?></td><td> <?php echo  $admin_equipes->sexe; ?></td>			<?php endforeach; ?>
					</TABLE> 

					<h1> Entraineur(s) </h1>

					<?php if($pas_entraineur==true) { ?>

					<TABLE > 
						<TR> 
							<TH>  </TH> 
							<TH> Login </TH> 
							<TH> Nom </TH> 
							<TH> Prenom </TH>
							<TH> sexe </TH> 
						</TR> 
						<?php foreach ($entraineur_equipe as $entraineur_equipes): ?>
							<tr><td><img src="<?php echo base_url().'assets/avatar/'.$entraineur_equipes->avatar;?>" width="50" height="50" class="avatar"></td><td>
								<?php echo $entraineur_equipes->login."</td><td>".$entraineur_equipes->nom."</td><td>".$entraineur_equipes->prenom."</td><td>".$entraineur_equipes->sexe; ?></td></tr>
							<?php endforeach; ?>
						</TABLE> 

						<?php } else { ?>
						Il n'y'a pas encore d'entraineurs.
						<?php } ?>

						<h1> Membre(s) </h1>

						<?php if($pas_membre==true) { ?>

						<TABLE > 
							<TR> 
								<TH>  </TH> 
								<TH> Login </TH> 
								<TH> Nom </TH> 
								<TH> Prenom </TH>
								<TH> sexe </TH> 
							</TR> 
							<?php foreach ($autre_membre_equipe as $autre_membre_equipes): ?>
								<tr><td><img src="<?php echo base_url().'assets/avatar/'.$autre_membre_equipes->avatar;?>" width="50" height="50" class="avatar"></td>
									<td><?php echo $autre_membre_equipes->login."</td><td>".$autre_membre_equipes->nom."</td><td>".$autre_membre_equipes->prenom."</td><td>".$autre_membre_equipes->sexe; ?></td></tr>
								<?php endforeach; ?>
							</TABLE> 
							<?php } else { ?>
							 Il n'y'a pas encore de membres.
							<?php } ?>
						</div>

					</article>

				</body>
				</html>