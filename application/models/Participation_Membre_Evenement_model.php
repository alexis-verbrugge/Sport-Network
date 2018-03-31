<?php

class Participation_Membre_Evenement_model extends CI_Model
{
	private $table = 'Participation_Membre_Evenement';

	public function __construct() {
		$this->load->database();
	}

	public function ajouter_membre($idEvenement, $login) {
		{
			$data=array(
				'idEvenement' => $idEvenement,
				'login' => $login,
				'participation' => 'non');
			$this->db->insert($this->table,$data);
		}
	}

	public function evenement_membre($login) {
		return $this->db->select('`nom`, `dateDebut`,`dateFin`, `nomEquipe`, `Evenement.idEvenement`')
		->from($this->table)
		->join('Evenement', 'Evenement.idEvenement = Participation_Membre_Evenement.idEvenement')
		->where('login', $login)
		->order_by('dateDebut')
		->get()
		->result();
	}

	public function get_joueur_event($idEvent) {
		return $this->db->select('`Membre.login`, `nom`, `prenom`, `avatar`, `participation`')
    ->from($this->table) // table membre
    ->join('Membre', 'Membre.login = Participation_Membre_Evenement.login') // table particpation_membre
    ->where('idEvenement', $idEvent)
    ->get()
    ->result();
}

public function count_Event($login)
	{
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('login', $login);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return true;
		}
		return false;	
	}



public function change_presence_event($idEvenement, $login, $presence) {
	$data=array(
		'idEvenement' => $idEvenement,
		'login' => $login,
		'participation' => $presence);
	$this->db->where('idEvenement', $idEvenement);
	$this->db->where('login', $login);
	$this->db->update($this->table,$data);
	
}

public function get_event_equipe($nomEquipe) {
	return $this->db->select('`idEvenement`')
	->from($this->table) 
	->where('nomEquipe', $nomEquipe)
	->get()
	->result();
}


public function supprimer_membre_event($idEvenement) {
    $this->db->where('idEvenement', $idEvenement);
    $this->db->delete($this->table);   
		 }

public function supprimer_membre_event2 ($login) {
    $this->db->where('login', $login);
    $this->db->delete($this->table);   
		 }



}