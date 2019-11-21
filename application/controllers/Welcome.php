<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('DemandeModel');
		$this->load->library('form_validation');
	}
	public function index()
	{
		header('Access-Control-Allow-Origin: *');
		$this->load->database();
		$demandes= $this->DemandeModel->getAll();
		echo json_encode($demandes);
	}

	function insert()
	{
		header('Access-Control-Allow-Origin: *');
		$this->form_validation->set_rules('titre_demande', 'Titre', 'required');
		$this->form_validation->set_rules('nom_utilisateur', 'Utilisateur', 'required');
		$this->form_validation->set_rules('description_demande', 'Description', 'required');
		$this->form_validation->set_rules('budget_demande', 'Budget', 'required');
		$array = array();
		if($this->form_validation->run())
		{
			$data = array(
				'titre_demande' => trim($this->input->post('titre_demande')),
				'nom_utilisateur'  => trim($this->input->post('nom_utilisateur')),
				'description_demande' => trim($this->input->post('description_demande')),
				'budget_demande'  => trim($this->input->post('budget_demande')),
				'date_demande'  => trim($this->input->post(now()))
			);
			$this->DemandeModel->insert_data($data);
			$array = array(
				'success'  => true
			);
		}
		else
		{
			$array = array(
				'error'    => true,
				'titre_demande_error' => form_error('titre_demande'),
				'nom_utilisateur_error' => form_error('nom_utilisateur'),
				'description_demande_error' => form_error('description_demande'),
				'budget_demande_error' => form_error('budget_demande')
			);
		}
		echo json_encode($array, true);
	}
}
