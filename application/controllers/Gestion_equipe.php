<?php
class Gestion_equipe extends CI_Controller {

	private $data = array();
	private $login;

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		if($this->session->userdata('username')!=null) {
			$this->load->model('Equipe_model');
			$this->load->model('Membre_Equipe_model');
			$this->load->model('Membre_model');

			$this->data['nb_max_admin']='';
			$this->data['nom_utilise']='';
			$this->data['mdp_non_concordant']='';
			$this->data['equipe_success']='';
			$this->data['mdp_equipe_faux']='';
			$this->data['rejoins_equipe_success']='';
			$this->data['pas_equipe']='';
			$this->data['appartient_deja']='';
			$this->data['sexe_faux']='';
			$this->data['erreur_sexe']='';


			$this->login = $this->session->userdata('username');
			$this->data['login']=$this->login;
			$nb_login=$this->Membre_model->count_login($this->login);
		// le login de la personne connectee 

			if(isset( $_POST['nomEquipe'])) {
				$this->creer_equipe();
		}

		if (isset($_POST['nomEquipe2'], $_POST['mdp2'])) 	{
			$this->rejoindre_equipe();
		}

		$this->load->view('header');
		$this->load->view('connecte',$this->data);
		$this->load->view('footer');

	}else {
		redirect('');
	}
}

public function creer_equipe() {

    $config['upload_path']          = './assets/avatar';
	$config['allowed_types']        = 'gif|jpg|png|jpeg';
	$config['max_size']             = 0;
	$config['max_width']            = 0;
	$config['max_height']           = 0;

	$this->load->library('upload', $config); 

	$nomEquipe = $this->input->post('nomEquipe');
	$nomEquipe=str_replace(' ','',$nomEquipe);
	$password = $this->input->post('mdp');
	$confirm = $this->input->post('confirm');
	$ville = $this->input->post('ville'); 
	$mixite = $this->input->post('mixite');
	$description = $this->input->post('description');
	$sport = $this->input->post('sport');
	$logo = $this->input->post('logo');
	$photo = $this->input->post('photo');
	
	$nb_nomEquipe=$this->Equipe_model->count_nomEquipe($nomEquipe);
	//$nb_nomEquipe=0;
	$nb_admin=$this->Equipe_model->count_Administrateur($this->login);
	//$nb_admin=0;
	$sexe=$this->Membre_model->getSexe($this->login);

	 $up=$this->upload->do_upload('logo');
	$up2=$this->upload->do_upload('photo');

	if($up==false) {
		$logo="logo_default.jpg";
		
	}
	else {
		$logo=$_FILES['logo']['name'];
	}
	if ($up2==false) {
		$photo="photo_default.jpg";
	}
	else {
		$photo=$_FILES['photo']['name'];
	}
	
	$sexe_success=true;
	if ($mixite!='mixte') {
		if ($sexe!=$mixite) {
			$this->data['erreur_sexe']='Vous ne pouvez pas creer une equipe du sexe opposé !';
			$sexe_success=false;
		}
	}

	else {
		$sexe_success=true;
	}

	if ($password!=$confirm) {
	   		//echo 'erreur pswd differents';
		$this->data['mdp_non_concordant']='Les 2 mots de passe ne concordent pas';
	} 

	if ($nb_admin>=5) {
	    	//echo 'erreur login deja utilise';
		$this->data['nb_max_admin']="vous avez deja 5 equipes en tant qu'administrateur";
	}

	if ($nb_nomEquipe>0) {
	    	//echo 'erreur email deja utilise';
		$this->data['nom_utilise'] = "le nom d'equipe est deja utilisee";
	}

	if ($nb_nomEquipe==0 && $nb_admin<=5 && $password==$confirm && $sexe_success==true) {
		
		$this->Equipe_model->ajouter_equipe($nomEquipe, $password, $ville, $description, $mixite, $this->login,  $sport, $photo, $logo);
		$this->Membre_Equipe_model->ajouter_membre($nomEquipe, $this->login);
		$this->data['equipe_success']='creation de '.$nomEquipe.' reussie !';
	    	//$this->load->view('connecte',$this->data);
	}
}

public function rejoindre_equipe() {
	$nomEquipe = $this->input->post('nomEquipe2');
	$password = $this->input->post('mdp2');
	$nb_nomEquipe=$this->Equipe_model->count_nomEquipe($nomEquipe);
	$verify=''.$this->Equipe_model->getPassword($nomEquipe);
	$sexe=''.$this->Membre_model->getSexe($this->login);
	$mixite=''.$this->Equipe_model->getMixite($nomEquipe);
	$sexe_okay=true;
	if ($mixite=='mixte')
		$sexe_okay=true;
	else if ($mixite!=$sexe)
		$sexe_okay=false;	

	if ($nb_nomEquipe==0) {
		$this->data['pas_equipe']='Equipe inexistante';
		$sexe_okay=true;
	} else if ($password!=$verify) {
		$this->data['mdp_equipe_faux']='mot de passe incorrect';
	}

	if ($sexe_okay==false) {
		$this->data['sexe_faux']='Equipe non mixte ou du sexe opposé';
	}

	if ($this->Membre_Equipe_model->est_dans_equipe($nomEquipe, $this->login)==true) {
		$this->data['appartient_deja']='Vous appartenez deja a cette equipe !';
	}

	if ($verify==$password && $nb_nomEquipe>0 && $this->Membre_Equipe_model->est_dans_equipe($nomEquipe, $this->login)==false
		&& $sexe_okay==true) {
		$this->Membre_Equipe_model->ajouter_membre($nomEquipe, $this->login);

		$this->data['rejoindre_evenement']=$this->Evenement_model->get_event_equipe($nomEquipe);
		foreach ($this->data['rejoindre_evenement'] as $rejoindre_evenement) {
		$this->Participation_Membre_Evenement_model->ajouter_membre($rejoindre_evenement->idEvenement, $this->login);
	}  
	$this->data['rejoins_equipe_success']='vous avez rejoins l"equipe '.$nomEquipe;
}
}



}
?>