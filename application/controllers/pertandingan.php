<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class pertandingan extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

    public function index(){
			$data['title'] = 'Ayo main GamSuit!';
			$data['p']		 = $this->input->get('p');
			$data['r']		 = $this->input->get('r');

			$this->db->where('id_pertandingan', $data['p']);
			$this->db->where('id_pemain_1', $this->session->userdata('id_pemain'));
			$this->db->or_where('id_pemain_2', $this->session->userdata('id_pemain'));
			$this->db->where_not_in('status_pertandingan', 'Selesai');
			$pertandingan = $this->db->get_where('tabel_pertandingan')->row_array();

			if($pertandingan){
				$this->load->view('template/v_head', $data);
				$this->load->view('v_pertandingan', $data);
				$this->load->view('template/v_foot');
			}
			else{
				$this->session->set_flashdata('gagal', 'Halaman yang ingin Anda akses tidak valid.');
        redirect($_SERVER['HTTP_REFERER']);
			}
    }
  }
