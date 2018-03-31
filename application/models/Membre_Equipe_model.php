<?php

class Membre_Equipe_model extends CI_Model
{
	private $table = 'Membre_Equipe';

		public function __construct() {
		$this->load->database();
	}

	public function ajouter_membre($nomEquipe, $login)
	{
	 	$data=array(
					'nomEquipe' => $nomEquipe,
				    'login' => $login);
					$this->db->insert($this->table,$data);
	}

	public function est_dans_equipe($nomEquipe, $login) {
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('nomEquipe', $nomEquipe);
		$this->db->where('login', $login);
		$query = $this->db->get();
		$count = $query->num_rows();
		if ($count==0) 
			return false;
		
		else 
			return true;
	}

	public function supprimer_membre($nomEquipe, $login) {
    $this->db->where('nomEquipe', $nomEquipe);
    $this->db->where('login', $login);
    $this->db->delete($this->table);   
		 }

	public function get_membre($nomEquipe) {
		return $this->db->select ('login')
		->from($this->table)
		->where('nomEquipe', $nomEquipe)
		->get()
		->result();	
}
	
	public function supprimer_membre2($nomEquipe) {
    $this->db->where('nomEquipe', $nomEquipe);
    $this->db->delete($this->table);   
		 }

	public function count_equipe($login)
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

	public function count_membre($nomEquipe)
	{
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('nomEquipe', $nomEquipe);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return true;
		}
		return false;	
	}




}