<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addplace extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Place_model');
	}

	public function index(){
		$this->load->view(
			'addplace_page',array(
				'message' => ""
			)
		);
	}

	public function addplacecheck(){
		$place = $this->Place_model;
		$placename = $_POST['placename'];
		$placefullname = $_POST['placefullname'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$radius = $_POST['radius'];
		$placetype = $_POST['placetype'];
		$qrcode = $place->getqrcode();
		$sensorid = $place->getsensorid();

		$this->form_validation->set_rules('placename', 'placename', 'required|max_length[50]');
		$this->form_validation->set_rules('placefullname', 'placefullname', 'required|max_length[255]');
		$this->form_validation->set_rules('latitude', 'latitude', 'required|numeric');
		$this->form_validation->set_rules('longitude', 'longitude', 'required|numeric');
		$this->form_validation->set_rules('radius', 'radius', 'required|numeric');
		$this->form_validation->set_rules('placetype', 'placetype', 'required|alpha_numeric');
	
		if ($this->form_validation->run()==TRUE){
			if($place->addplace($placename, $placefullname, $qrcode, $sensorid, $latitude, $longitude, $radius, $placetype, null, null, null)==TRUE){
				$this->load->view(
					'addplace_page',array(
					'message' => 'Add Place successful.'
					)
				);
			}else{
				$this->load->view(
					'addplace_page',array(
					'message' => 'Add Place failed.'
					)
				);
			}
		}else{
			$this->load->view(
			'addplace_page',array(
				'message' => 'From validation error. please check again.'
				)
			);
		}
	}
}