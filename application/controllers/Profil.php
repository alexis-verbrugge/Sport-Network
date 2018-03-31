<?php
class Profil extends CI_Controller {

	private $login;

	public function __construct() {
		parent::__construct();
	}

	public function index() {	
			if($this->session->userdata('username')!=null) {
		$data=array();
		$data['pas_equipe']='';
		$this->login = $this->session->userdata('username');
		$data['infos']=$this->Membre_model->attributs_membre($this->login);

		$data['equipes']=$this->Equipe_model->equipe_membre($this->login);
		$data['equipes_entraineur']=$this->Equipe_model->equipe_entraineur($this->login);

		$data['a_des_equipes_membre']=$this->Membre_Equipe_model->count_equipe($this->login);
		$data['a_des_equipes_entraineur']=$this->Equipe_Entraineur_model->count_equipe($this->login);
		$this->load->view('header');
		$this->load->view('profil', $data);
		$this->load->view('footer');
	}
	else {
		redirect('');
	}

}


	public function supprimer_equipe($nomEquipe) {
		$event=$this->Evenement_model->get_event_equipe($nomEquipe);
		foreach ($event as $events) {
		$this->Participation_Membre_Evenement_model->supprimer_membre_event($events->idEvenement);
	    $this->Evenement_model->supprimer_event($events->idEvenement);
	}
	    $this->Membre_Equipe_model->supprimer_membre2($nomEquipe);
	    $this->Equipe_Entraineur_model->supprimer_entraineur2($nomEquipe);
	    $this->Equipe_model->supprimer_equipe($nomEquipe);
	    redirect('Profil');
		}

	public function quitter_equipe($nomEquipe) {
		$this->login = $this->session->userdata('username');
		$this->Membre_Equipe_model->supprimer_membre($nomEquipe, $this->login);
		//$this->Equipe_Entraineur_model->supprimer_entraineur($nomEquipe, $this->login);
		redirect('Profil');
	}
		
}