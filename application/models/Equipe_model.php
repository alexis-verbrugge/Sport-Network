<?php

class Equipe_model extends CI_Model
{
	private $table = 'equipe';
	private $table2 = 'Membre_Equipe';
	private $table3 = 'Membre';
	private $table4 = 'Equipe_Entraineur';

	public function __construct() {
		$this->load->database();
	}

	public function ajouter_equipe($nomEquipe, $password, $ville, $description,
		$mixite, $login, $sport, $photo, $logo)
	{
		$data=array(
			'nomEquipe' => $nomEquipe,
			'password' => $password,
			'ville' => $ville,
			'description' => $description,
			'mixite' => $mixite,
			'logo' => $logo,
			'photo' => $photo,
			'loginAdministrateur' => $login,
			'sport' => $sport);
		$this->db->insert($this->table,$data);
	}

// renvoie le nombre de nom d'equipe = a l'argument qui lui est passé
	public function count_nomEquipe($nomEquipe)
	{
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('nomEquipe', $nomEquipe);
		$query = $this->db->get();
		$count = $query->num_rows();
		return $count;
	}

//renvoie le nombre d'equipe ayant pour administrateur le login en argument
	public function count_Administrateur($login)
	{
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('loginAdministrateur', $login);
		$query = $this->db->get();
		$count = $query->num_rows();
		return $count;

	}
	public function getPassword($nomEquipe) {
		$this->db->select ('password');
		$this->db->from($this->table);
		$this->db->where('nomEquipe', $nomEquipe);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->row()->password;
		}
		return false;	
	}

	public function find_Equipe_detaillee($ville, $sport, $mixite) {
		$this->db->select ('*');
		$this->db->from($this->table);
		$this->db->where('nomEquipe', $nomEquipe);
		$this->db->where('sport', $sport);
		$this->db->where('mixite', $mixite);
		$query = $this->db->get();
		return $query;
	}

	public function attributs_Equipe($nomEquipe) {
		return $this->db->select('*')
		     ->from($this->table)
		     ->where('nomEquipe', $nomEquipe)
		     ->get()
			 ->result();
	}

	public function getMixite($nomEquipe) {
		$this->db->select ('mixite');
		$this->db->from($this->table);
		$this->db->where('nomEquipe', $nomEquipe);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->row()->mixite;
		}
		return false;	
	}

	public function equipe_membre($login) {
		return $this->db->select('`equipe.nomEquipe`, `ville`, `sport`,`mixite`, `logo`')
		         ->from($this->table)
		         ->join($this->table2, 'equipe.nomEquipe = Membre_Equipe.nomEquipe')
		         ->where('login', $login)
		         ->get()
	             ->result();
	}

		public function equipe_entraineur($login) {
		return $this->db->select('`equipe.nomEquipe`, `ville`, `sport`,`mixite`, `logo`')
		         ->from($this->table)
		         ->join('Equipe_Entraineur', 'equipe.nomEquipe = Equipe_Entraineur.nomEquipe')
		         ->where('loginEntraineur', $login)
		         ->get()
	             ->result();
	}


	

	public function est_administrateur($login, $nomEquipe) {
		$this->db->select ('loginAdministrateur');
		$this->db->from($this->table);
		$this->db->where('loginAdministrateur', $login);
		$this->db->where('nomEquipe', $nomEquipe);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function administrateur_equipe($login, $nomEquipe) {
		return $this->db->select('`login`, `prenom`, `nom`,`avatar`, `sexe`')
		         ->from($this->table3)
		         ->join($this->table, 'Membre.login = equipe.loginAdministrateur')
		         ->where('nomEquipe', $nomEquipe)
		         ->get()
	             ->result();
	}

	public function entraineur_equipe($login, $nomEquipe) {
		return $this->db->select('`login`, `prenom`, `nom`,`avatar`, `sexe`')
		         ->from($this->table3)
		         ->join($this->table4, 'Membre.login = Equipe_Entraineur.loginEntraineur')
		         ->where('nomEquipe', $nomEquipe)
		         ->get()
	             ->result();
	}

		public function autre_membre_equipe($login, $nomEquipe) {
		return $this->db->select('`Membre.login`, `prenom`, `nom`,`avatar`, `sexe`')
		         ->from($this->table3)
		         ->join($this->table2, 'Membre.login = Membre_Equipe.login')
		         ->where('nomEquipe', $nomEquipe)
		         ->get()
	             ->result();

}

public function supprimer_equipe($nomEquipe) {
    $this->db->where('nomEquipe', $nomEquipe);
    $this->db->delete($this->table);   
		 }
}