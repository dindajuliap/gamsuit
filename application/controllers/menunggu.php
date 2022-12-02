<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class menunggu extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function pemain(){
			$data['title'] = 'Ayo main GamSuit!';

			$this->load->view('template/v_head', $data);
			$this->load->view('v_menunggu_pemain');
			$this->load->view('template/v_foot');
    }
  }
