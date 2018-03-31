<?php

class Evenement_model extends CI_Model
{
	private $table = 'Evenement';

	public function __construct() {
		$this->load->database();
	}

	public function ajouter_evenement($heureDebut, $heureFin, $dateDebut, $dateFin ,$periodicite,$description, $nature, $nom, $loginEntraineur, $nomEquipe) {
		$data=array(
			'heureDebut' => $heureDebut,
			'heureFin' => $heureFin,
			'dateDebut' => $dateDebut,
			'dateFin' => $dateFin,
			'periodicite' => $periodicite,
			'description' => $description,
			'nature' => $nature,
			'loginEntraineur' => $loginEntraineur,
			'Nom' => $nom, 
			'nomEquipe' => $nomEquipe);
		$this->db->insert($this->table,$data);
	}

	public function trouver_id($loginEntraineur, $nom, $nomEquipe) {
		$this->db->select('idEvenement');  
		$this->db->from($this->table);
		$this->db->where('loginEntraineur', $loginEntraineur);
		$this->db->where('nom', $nom);
		$this->db->where('nomEquipe', $nomEquipe);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->row()->idEvenement;
		}
		return false;	
	}

	public function evenement_creable($nom, $loginEntraineur) {
		$this->db->select('idEvenement');  
		$this->db->from($this->table);
		$this->db->where('loginEntraineur', $loginEntraineur);
		$this->db->where('nom', $nom);
		$query = $this->db->get();
		$count = $query->num_rows();
		if ($count==0) 
			return true;
		
		else 
			return false;
	}

	public function attributs_evenement($idEvent) {
 return $this->db->select('`description`, `nom`, `dateDebut`,`dateFin`,`heureDebut`,`heureFin`,`nature`,`loginEntraineur`, `idEvenement`, `nomEquipe`')
    ->from($this->table)
    ->where('idEvenement', $idEvent)
    ->get()
    ->result();
}


 public function get_event_equipe($nomEquipe) {
	 return $this->db->select('`idEvenement`')
    ->from($this->table) 
    ->where('nomEquipe', $nomEquipe)
    ->get()
    ->result();
}

  public function find_event_perime() {
  	    $today = date('Y-m-d');  
  	    return $this->db->select('`description`, `nom`, `dateDebut`,`dateFin`,`heureDebut`,`heureFin`,`nature`, `periodicite`, `loginEntraineur`, `idEvenement`, `nomEquipe`')
  	     ->from($this->table)
  	     ->where('dateFin <', $today)
  	   	 ->get()
         ->result();
  }

  public function supprimer_event($idEvenement) {
    $this->db->where('idEvenement', $idEvenement);
    $this->db->delete($this->table);   
		 }

	public function increment_evenement($heureDebut, $heureFin, $dateDebut, $dateFin ,$periodicite,$description, $nature, $nom, $loginEntraineur, $nomEquipe) {
		//$dateDebut = strtotime($dateDebut." +".$periodicite." day");
		//$dateFin = strtotime($dateFin." +".$periodicite." day");

			//$dateDebut = date('Y-m-d', mktime(0, 0, 0, date('Y')  , date('m') , date('d') + $periodicite ));
			//$dateFin  = date('Y-m-d', mktime(0, 0, 0, date('Y')  , date('m') , date('d') + $periodicite) );

			
list($y,$m,$d)=explode('-',$dateDebut);
$dateDebut = Date("Y-m-d", mktime(0,0,0,$m,$d+$periodicite,$y));

list($y,$m,$d)=explode('-',$dateFin);
$dateFin = Date("Y-m-d", mktime(0,0,0,$m,$d+$periodicite,$y));
			
		
		$data=array(
			'heureDebut' => $heureDebut,
			'heureFin' => $heureFin,
			'dateDebut' => $dateDebut,
			'dateFin' => $dateFin,
			'periodicite' => $periodicite,
			'description' => $description,
			'nature' => $nature,
			'loginEntraineur' => $loginEntraineur,
			'Nom' => $nom, 
			'nomEquipe' => $nomEquipe);
		$this->db->insert($this->table,$data);
	}

	public function est_createur($idEvenement, $login) {
		$this->db->select('loginEntraineur');  
		$this->db->from($this->table);
		$this->db->where('loginEntraineur', $login);
		$this->db->where('idEvenement', $idEvenement);
		$query = $this->db->get();
		$count = $query->num_rows();
		if ($count==0) 
			return true;
		
		else 
			return false;
	}




}
