<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class home extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function index(){
			$data['title'] = 'Selamat Datang di SUIT';

			$this->load->view('template/v_head', $data);
			$this->load->view('v_home');
      $this->load->view('template/v_footer');
			$this->load->view('template/v_foot');
		}
	}
