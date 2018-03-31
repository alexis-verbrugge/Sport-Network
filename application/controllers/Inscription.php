<?php
class Inscription extends CI_Controller {

	private $data = array();

	public function index() {
		$this->load->helper('url');
		$this->data['pseudo_inexistant']='';
		$this->data['mdp_incorrect']='';
		$this->data['pseudo_deja_pris']='';
		$this->data['email_deja_pris']='';
		$this->data['mdp_non_concordant']='';
		$this->data['connexion_success']='';

		if(isset($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'],
			$_POST['email'])) {
			$this->inscript();
	}
	if(isset($_POST['id'], $_POST['mdp'])) {
		$this->connexion();
	}

	$this->load->view('accueil',$this->data);
}


public function inscript() {

	$this->load->library('form_validation');
	$this->form_validation->set_rules('login', '', 'trim|required|min_length[8]|max_length[52]|alpha_dash|encode_php_tags|xss_clean|is_unique');
	$this->form_validation->set_rules('password', '', 'trim|required');
	$this->form_validation->set_rules('confirm_password', '', 'trim|required');
	$this->form_validation->set_rules('nom', '', 'trim|required|xss_clean');
	$this->form_validation->set_rules('prenom', '', 'trim|required|xss_clean');
	$this->form_validation->set_rules('email', '', 'trim|required|xss_clean|is_unique');
	$this->form_validation->set_rules('avatar', '', 'trim|required');
	$this->form_validation->set_rules('sexe', '', 'trim|required');

	$config['upload_path']          = './assets/avatar';
	$config['allowed_types']        = 'gif|jpg|png|jpeg';
	$config['max_size']             = 0;
	$config['max_width']            = 0;
	$config['max_height']           = 0;
	 $this->load->library('upload', $config);

	$pseudo = $this->input->post('login');
	$password = $this->input->post('password');
	$confirm = $this->input->post('confirm_password');
	$nom = $this->input->post('nom');
	$prenom = $this->input->post('prenom');
	$email = $this->input->post('email');
	$avatar= $this->input->post('avatar');
	$sexe = $this->input->post('sexe');

	$nb_login=$this->Membre_model->count_login($pseudo);
	$nb_email=$this->Membre_model->count_email($email);

	$up=$this->upload->do_upload('avatar');

	if($up==false) {
		$avatar="avatar_default.jpeg";
	}
	else {
		$avatar=$_FILES['avatar']['name'];
	}

	if ($password!=$confirm) {
	   		//echo 'erreur pswd differents';
		$this->data['mdp_non_concordant']='Les 2 mots de passe ne concordent pas';
	} 

	if ($nb_login>0) {
	    	//echo 'erreur login deja utilise';
		$this->data['pseudo_deja_pris'] = 'Le pseudo que vous avez choisi est deja utilisé.';
	}

	if ($nb_email>0) {
	    	//echo 'erreur email deja utilise';
		$this->data['email_deja_pris'] = 'Vous avez déjà un compte sur le site';
	}

	if ($nb_email==0 && $nb_login==0 && $password==$confirm) {

		$password=password_hash($password, PASSWORD_BCRYPT);
		$this->Membre_model->ajouter_membre($pseudo, $password, $nom, $prenom,$email, $avatar, $sexe);
		$this->data['connexion_success']='inscription reussie !';
	}
}


public function connexion() {
	
	$pseudo = $this->input->post('id');
	$password = $this->input->post('mdp');

	$nb_login=$this->Membre_model->count_login($pseudo);
	if ($this->Membre_model->count_login($pseudo)>0) {
		$hash = $this->Membre_model->getpassword($pseudo);
		if (password_verify($password,$hash)) {
			$newdata = array(
				'username' => $pseudo);
			$this->session->set_userdata($newdata);

					//$ses = array('login'=>$this->input->post('login'), 'logged'=>true);
					//$this->sesssion->set_userdata($ses);
			header('Location: Gestion_equipe');
					//$this->load->view('connecte');
		}
		else {
			$this->data['mdp_incorrect']="Le mot de passe est incorrect";
		}
	}

	else {
		$this->data['pseudo_inexistant']="Ce login n'existe pas";
	}
}

public function deconnexion() {
	$this->load->helper('url');

	$this->session->sess_destroy();
	//header('Location: Inscription');
	redirect('');
}

public function affiche_rapport() {
	$this->load->view('header');
	$this->load->view('rapport');
	$this->load->view('footer');
}


}