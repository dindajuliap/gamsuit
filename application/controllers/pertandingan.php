<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class pertandingan extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

    public function index(){
			$data['title'] = 'Ayo main GamSuit!';
			$data['id']		 = $this->input->get('p');

			$this->load->view('template/v_head', $data);
			$this->load->view('v_pertandingan', $data);
			$this->load->view('template/v_foot');
    }
  }
