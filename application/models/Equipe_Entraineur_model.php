<?php

class Equipe_Entraineur_model extends CI_Model
{
	private $table = 'Equipe_Entraineur';

	public function __construct() {
		$this->load->database();
	}

	public function ajouter_entraineur($loginEntraineur, $nomEquipe) {
		$data=array(
			'loginEntraineur' => $loginEntraineur,
			'NomEquipe' => $nomEquipe);
		$this->db->insert($this->table,$data);
	}

	public function est_entraineur($login, $nomEquipe) {
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('loginEntraineur', $login);
		$this->db->where('nomEquipe', $nomEquipe);
		$query = $this->db->get();
		$count = $query->num_rows();	
		if ($count==0) 
			return false;

		else 
			return true;
	}

	public function entraineur_equipe($nomEquipe) {
		return  $this->db->select ('loginEntraineur')
		->from($this->table)
		->where('nomEquipe', $nomEquipe)
		->get()
		->result();
		
	}

		public function supprimer_entraineur($nomEquipe, $login) {
    $this->db->where('nomEquipe', $nomEquipe);
    $this->db->where('loginEntraineur', $login);
    $this->db->delete($this->table);   
		 }

		public function supprimer_entraineur2($nomEquipe) {
    $this->db->where('nomEquipe', $nomEquipe);
    $this->db->delete($this->table);   
		 }
	
public function count_equipe($login)
	{
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('loginEntraineur', $login);
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