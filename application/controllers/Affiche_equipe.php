<?php
class Affiche_equipe extends CI_Controller {
  
 private $data = array();

public function index($nomEquipe) {
  if($this->session->userdata('username')!=null) {
 $this->login = $this->session->userdata('username');
 
 $this->data['deja_entraineur']='';
 $this->data['entraineur_success']='';
 $this->data['membre_pas_dans_equipe']='';
 $this->data['pas_dans_equipe']='';
 $this->data['membre_inexistant']='';
 $this->data['membre_inexistant_2']='';
 $this->data['membre_pas_dans_equipe_2']='';
 $this->data['invitation_success']='';
 $this->data['membre_inexistant_3']='';
 $this->data['membre_pas_dans_equipe_3']='';
 $this->data['banni_success']='';
 $this->data['event_success']='';
 $this->data['event_fail']='';
 $this->data['erreur_date']='';

 $this->data['equipe']=$this->Equipe_model->attributs_equipe($nomEquipe);
 $this->data['admin_equipe']=$this->Equipe_model->administrateur_equipe($this->login, $nomEquipe);
 $this->data['entraineur_equipe']=$this->Equipe_model->entraineur_equipe($this->login, $nomEquipe);
 $this->data['autre_membre_equipe']=$this->Equipe_model->autre_membre_equipe($this->login, $nomEquipe);

 $this->data['pas_entraineur']=$this->Equipe_Entraineur_model->count_membre($nomEquipe);
 $this->data['pas_membre']=$this->Membre_Equipe_model->count_membre($nomEquipe);

 $this->load->view('header');
 $this->load->view('description_equipe',$this->data);
 
 $this->data['nom']=$nomEquipe;
 if ($this->Equipe_model->est_administrateur($this->login, $nomEquipe)) {
  if (isset($_POST['nomme_entraineur'])) {
  $this->nommer_entraineur($nomEquipe);
 }
  if (isset($_POST['invite_membre'])) {
  $this->inviter_membre($nomEquipe);
 }
  if (isset($_POST['bannir_membre'])) {
  $this->bannir_membre($nomEquipe);
 }
  $this->load->view('equipe_administrateur', $this->data);
 }
 if ($this->Equipe_Entraineur_model->est_entraineur($this->login, $nomEquipe)) {
  if (isset($_POST['creation_evenement'])) {
  $this->ajouter_evenement($nomEquipe);
 }
  $this->load->view('equipe_entraineur', $this->data);
 }
 $this->load->view('footer');
}
else {
    redirect('');
  }
}
public function nommer_entraineur($nomEquipe) {
 
  $loginMembre=$this->input->post('loginMembre_un');
  $estEntraineur=$this->Equipe_Entraineur_model->est_entraineur($loginMembre, $nomEquipe);
  $estMembre=$this->Membre_model->est_membre($loginMembre);
  $estMembreEquipe=$this->Membre_Equipe_model->est_dans_equipe($nomEquipe, $loginMembre);
  if ($estMembre==false) {
   $this->data['membre_inexistant']='Ce membre est inexistant';
  } else {
   if ($estMembreEquipe==false) {
    $this->data['membre_pas_dans_equipe']='Ce membre est deja dans lequipe !';
   }
   if ($estEntraineur==true) {
    $this->data['deja_entraineur']='Ce membre est deja entraineur de lequipe';
   }
   if ($estEntraineur==false && $estMembreEquipe==true) {
    // delete de la table membre 
    $this->Membre_Equipe_model->supprimer_membre($nomEquipe, $loginMembre);
    $this->Equipe_Entraineur_model->ajouter_entraineur($loginMembre, $nomEquipe);
    $this->data['entraineur_success']=$loginMembre.' nommé entraineur avec succes! ';
   }
  }
}
public function inviter_membre($nomEquipe) {
  $loginMembre2= $this->input->post('loginMembre_deux');
  $estMembre=$this->Membre_model->est_membre($loginMembre2);
  $estMembreEquipe=$this->Membre_Equipe_model->est_dans_equipe($nomEquipe, $loginMembre2);
  if ($estMembre==false) {
   $this->data['membre_inexistant_2']='Ce membre est inexistant';
  }
  else {
   if ($estMembreEquipe==true) {
    $this->data['membre_pas_dans_equipe_2']='Ce membre est deja dans lequipe!';
   }
   else {
    $this->Membre_Equipe_model->ajouter_membre($nomEquipe, $loginMembre2);
    $this->data['invitation_success']=''.$loginMembre2.' ajouté avec succès !';
    //$this->Membre_Equipe_model->ajouter_membre($nomEquipe, $this->login);

    $this->data['rejoindre_evenement']=$this->Evenement_model->get_event_equipe($nomEquipe);
    foreach ($this->data['rejoindre_evenement'] as $rejoindre_evenement) {
    $this->Participation_Membre_Evenement_model->ajouter_membre($rejoindre_evenement->idEvenement, $loginMembre2);
  }
   }
  }
}
public function bannir_membre($nomEquipe) {

  $loginMembre3= $this->input->post('loginMembre_trois');
  $estMembre=$this->Membre_model->est_membre($loginMembre3);
  $estEntraineur=$this->Equipe_Entraineur_model->est_entraineur($nomEquipe, $loginMembre3);
  $estMembreEquipe=$this->Membre_Equipe_model->est_dans_equipe($nomEquipe, $loginMembre3);
  if ($estMembre==false) {
   $this->data['membre_inexistant_3']="Ce membre est inexistant";
  }
   if ($estMembreEquipe==false && $estMembreEquipe==false) {
    $this->data['membre_pas_dans_equipe_3']="Ce membre n'est pas dans l'equipe !";
   }
   else {
    $this->Participation_Membre_Evenement_model->supprimer_membre_event2($loginMembre3);
    $this->Membre_Equipe_model->supprimer_membre($nomEquipe, $loginMembre3);
    $this->Equipe_Entraineur_model->supprimer_entraineur($nomEquipe, $loginMembre3);
    $this->data['banni_success']=''.$loginMembre3.' banni avec succès !';
  }
 }


public function ajouter_evenement($nomEquipe) {
 
  $nomEvent = $this->input->post('nomEvent');
  $dateDebut = $this->input->post('dateDebut');
  $dateFin = $this->input->post('dateFin');
  $heureDebut = $this->input->post('heureDebut');
  $heureFin = $this->input->post('heureFin');
  $nature = $this->input->post('type');
  if ($nature=='regulier') {
   $periodicite = $this->input->post('periodicite');
  }
  else {
   $periodicite = 0;
  }
  $description = $this->input->post('description');
 if ($dateDebut > $dateFin) {
   $this->data['erreur_date']="la date de fin est supérieure a la date de début";
 } else if ($dateFin==$dateDebut && $heureFin < $heureDebut) {
   $this->data['erreur_date']="Il y'a un problème de concordance avec l'heure";
 } else  if ($this->Evenement_model->evenement_creable($nomEvent, $this->login)==true) {
   $this->Evenement_model->ajouter_evenement($heureDebut, $heureFin, $dateDebut, $dateFin ,$periodicite,$description, $nature, $nomEvent, $this->login, $nomEquipe);
   $id=$this->Evenement_model->trouver_id($this->login, $nomEvent, $nomEquipe);

   $data['mbr']=$this->Membre_Equipe_model->get_membre($nomEquipe);
   $data['mbr_entraineur']=$this->Equipe_Entraineur_model->entraineur_equipe($nomEquipe);

   foreach ($data['mbr'] as $membres) {
    $this->Participation_Membre_Evenement_model->ajouter_membre($id, $membres->login);
   }

   foreach ($data['mbr_entraineur'] as $membre_entraineur) {
    $this->Participation_Membre_Evenement_model->ajouter_membre($id, $membre_entraineur->loginEntraineur);
   }

   $this->data['event_success']="Evenement ".$nomEvent." creer avec success";
        
  }
}



}