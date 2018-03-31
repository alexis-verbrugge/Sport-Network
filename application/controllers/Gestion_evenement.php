<?php
class Gestion_evenement extends CI_Controller {

	private $data = array();
	private $login;

	public function __construct() {
		parent::__construct();
		$this->login = $this->session->userdata('username');
	}

	public function index() {
		if($this->session->userdata('username')!=null) {

			$this->data['event_perime']=$this->Evenement_model->find_event_perime();

			foreach ($this->data['event_perime'] as $event_perime) {

				if ($event_perime->nature == 'regulier') {

					$this->Evenement_model->increment_evenement($event_perime->heureDebut, $event_perime->heureFin, $event_perime->dateDebut,
						$event_perime->dateFin ,$event_perime->periodicite,$event_perime->description, $event_perime->nature, $event_perime->nom,
						$event_perime->loginEntraineur, $event_perime->nomEquipe);

					    $this->Participation_Membre_Evenement_model->supprimer_membre_event($event_perime->idEvenement);
				        $this->Evenement_model->supprimer_event($event_perime->idEvenement);

					 $id=$this->Evenement_model->trouver_id($event_perime->loginEntraineur,$event_perime->nom, $event_perime->nomEquipe);
					 
					$data['mbr']=$this->Membre_Equipe_model->get_membre($event_perime->nomEquipe);
					$data['mbr_entraineur']=$this->Equipe_Entraineur_model->entraineur_equipe($event_perime->nomEquipe);
   // ajouter tous les entraineurs 
					foreach ($data['mbr'] as $membres) {
						$this->Participation_Membre_Evenement_model->ajouter_membre($id, $membres->login);
					}

					foreach ($data['mbr_entraineur'] as $membres) {
						$this->Participation_Membre_Evenement_model->ajouter_membre($id, $membres->loginEntraineur);
					}
				} else {
				$this->Participation_Membre_Evenement_model->supprimer_membre_event($event_perime->idEvenement);

				$this->Evenement_model->supprimer_event($event_perime->idEvenement);
			}
			}
			$this->data['pas_event']=$this->Participation_Membre_Evenement_model->count_Event($this->login);
			$this->data['event']=$this->Participation_Membre_Evenement_model->evenement_membre($this->login);
			$this->load->view('header', $this->data);
			$this->load->view('liste_evenement', $this->data);
		}
		else {
			redirect('');
		}
	}


	public function evenement_detail($id) {
		if($this->session->userdata('username')!=null) {
			$this->data['description']=$this->Evenement_model->attributs_evenement($id);
			$this->data['membre']=$this->Participation_Membre_Evenement_model->get_joueur_event($id);
			$this->data['createur']=false;
			if ($this->Evenement_model->est_createur($id, $this->login)==true) {
				$this->data['createur']=true;
			}
			$this->load->view('header', $this->data);
			$this->load->view('evenement_detail', $this->data);
		}
		else {
			redirect('');
		}
	}

	public function change_presence($reponse,$id) {
		$this->Participation_Membre_Evenement_model->change_presence_event($id, $this->login, $reponse);
		$this->evenement_detail($id);
	}

	public function supprimer_evenement($id) {
		$this->Evenement_model->supprimer_event($id);
		redirect('Gestion_evenement');
	}

}
?>