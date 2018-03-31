<?php

class Membre_model extends CI_Model
{
	private $table = 'Membre';

	public function __construct() {
		$this->load->database();
	}
	
	public function ajouter_membre($login, $password, $nom, $prenom,
		$email, $avatar, $sexe)
	{
	 	$data=array(
					'login' => $login,
				    'prenom' => $prenom,
				    'nom' => $nom,
				    'password' => $password,
				    'email' => $email,
				    'avatar' => $avatar,
				    'sexe' => $sexe
				    );
	 				$this->db->set('dateCreation','NOW()', FALSE);
					$this->db->insert($this->table,$data);
	}

	
	// permet de comparer si un login est deja dans la BD
	public function count_login($login)
	{
		             $this->db->select ('*');
					 $this->db->from($this->table);
					 $this->db->where('login', $login);
					$query = $this->db->get();
					$count = $query->num_rows();
					return $count;
	}

		public function count_email($email){
		             $this->db->select ('*');
					 $this->db->from($this->table);
					 $this->db->where('email', $email);
					$query = $this->db->get();
					$count = $query->num_rows();
					return $count;
	}

	public function est_membre($login) {
		 $this->db->select('*');  
			  $this->db->from($this->table);
			  $this->db->where('login', $login);
	   		  $query = $this->db->get();
	   		  if ($query->num_rows()>0) {
	   		  	return true;
	   		  }
	   		  return false;	
	}
	
	
		public function attributs_membre($login) {

				return $this->db->select('`login`, `nom`, `prenom`,`avatar`,`sexe`,`avatar`,`dateCreation`')
				->from($this->table)
				->where('login', $login)
				->get()
				->result();
	}

	// permet de comparer si un login correspond au mot de passe lors de la connexion
	public function getPassword($login) {
		      $this->db->select('password');  
			  $this->db->from($this->table);
			  $this->db->where('login', $login);
	   		  $query = $this->db->get();
	   		  if ($query->num_rows()>0) {
	   		  	return $query->row()->password;
	   		  }
	   		  return false;	
	}

	public function getSexe($login) {
		 $this->db->select('sexe');  
			  $this->db->from($this->table);
			  $this->db->where('login', $login);
	   		  $query = $this->db->get();
	   		  	  if ($query->num_rows()>0) {
	   		  	return $query->row()->sexe;
	   		  }
	   		  return false;	
	}
}
