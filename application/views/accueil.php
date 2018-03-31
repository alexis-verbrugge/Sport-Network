<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css">
	</head>
	

<body background="<?php echo base_url(); ?>img/fond.jpg">
		<header>
			<nav>
				<div class="barre">
						<li><img src="<?php echo base_url(); ?>img/bouton_home.png" alt="Bouton Home" /></li>
						
					<div class="connect">
						<form method="post" action="<?php echo site_url('Inscription') ?>">
							Identifiant :
							<input type="text" name="id" required> &nbsp; 
							
							Mot de passe:
							<input type="password" name="mdp" required> &nbsp;
							<input type="submit" value="Se connecter">
						</form>
					</div>
				</div>
				<div class="erreur" id="erreur_con">
							<?php echo $pseudo_inexistant ?>
							<?php echo $mdp_incorrect ?>
							</div>
			</nav>
		</header>
		<article>
			
				
				<h1> SportNetworks</h1>
				<div class="Presentation">
						<p> Bienvenue sur SportNetworks, le réseau social lié au domaine du sport.<br> Inscrivez vous et profitez dés maintenant des differentes fonctionalités
					de notre site. Vous faites parti d'un club de n'importe quel sport, que vous soyez entraineur ou bien joueur, facilitez vous la tache pour l'organisation
					de vos evenements des aujourd'hui car avec ce site vous pourrez automatiquement signaler votre presence eventuelle aux evenements crées par vos entraineurs.
					 </p>
				</div>
			
				<h1> Inscription </h1>
					<div class="Inscription">
				<?php echo validation_errors(); ?>
				<?php echo form_open_multipart('Inscription'); ?>
				<form>
				<fieldset style="border-radius: 15px; text-align: center; background-color: #bdbdbd; opacity: 0.85;">
		<legend>Nommer un entraineur</legend>
					
				
					<input type="text"  class="inscrip" onblur="javascript: if(this.value == '') { this.value='Nom' }" onfocus="javascript:if(this.value =='Nom') {this.value = ''}" name="nom" class="nom" value="Nom"/>
					<input type="text" class="inscrip" onblur="javascript: if(this.value == '') { this.value='Prenom' }" onfocus="javascript:if(this.value =='Prenom') {this.value = ''}" name="prenom" class="prenom" value="Prenom" /> 
					<input type="text"  class="inscrip" onblur="javascript: if(this.value == '') { this.value='Identifiant' }" onfocus="javascript:if(this.value =='Identifiant') {this.value = ''}" name="login" class="login" value="Identifiant" /> <div class="erreur"><?php echo $pseudo_deja_pris ?> </div>
					<input type="text" class="inscrip" onblur="javascript: if(this.value == '') { this.type='text';this.value='Mot de passe' }" onfocus="javascript:if(this.value =='Mot de passe') {this.value = '';this.type='password'}" name="password" class="password" value="Mot de passe"/>  
					 <input type="text" class="inscrip" onblur="javascript: if(this.value == '') { this.type='text';this.value='Confirmation' }" onfocus="javascript:if(this.value =='Confirmation') {this.value = '';this.type='password'}" name="confirm_password" class="password" value="Confirmation"/> <div class="erreur"> <?php echo $mdp_non_concordant ?> </div>
					<input type="email" class="inscrip" onblur="javascript: if(this.value == '') { this.value='Email' }" onfocus="javascript:if(this.value =='Email') {this.value = ''}" name="email" class="email" value="Email" name="email" /> <div class="erreur"> <?php echo $email_deja_pris ?>  </div>
					<label>Avatar</label>
		         	<input name="avatar" type="file" id="fichier_a_uploader" required/>	<br><br>
		         	<label>Sexe</label>
		     	<select id="sexe" name="sexe">
				<option value="homme" id="homme">Homme</option>
				<option value="femme" id="femme">Femme</option>
			    </select><br><br>
					<input type="submit" value="S'inscire">

				</fieldset>
				</form>
				<div class="success">
				<?php echo form_close(); ?>

				<?php echo $connexion_success; ?>
				</div>
			</div>
		</article>

		  <marquee SCROLLAMOUNT="15"> 

		    <img src="<?php echo base_url(); ?>img/sport1.jpg" width="auto"  height="300px" alt="Photo sport">
		    <img src="<?php echo base_url(); ?>img/sport2.jpg" width="auto"  height="300px" alt="Photo sport">
		    <img src="<?php echo base_url(); ?>img/sport3.jpg" width="auto"  height="300px" alt="Photo sport">
		  </marquee>
	</body>
</html>
