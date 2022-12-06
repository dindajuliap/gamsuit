<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class pemenang extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function index(){
			$data['title'] 	 = 'Pemenang GamSuit!';
			$id_pertandingan = $this->input->get('p');

			$this->db->where('status_pertandingan', 'Selesai');
			$this->db->where('id_pertandingan', $id_pertandingan);
			$this->db->where('id_pemain_1', $this->session->userdata('id_pemain'));
			$this->db->or_where('id_pemain_2', $this->session->userdata('id_pemain'));
			$pertandingan = $this->db->get_where('tabel_pertandingan')->row_array();

			$this->db->join('tabel_pemain', 'tabel_pemain.id_pemain = tabel_pemenang_pertandingan.id_pemain');
			$this->db->where('id_pertandingan', $id_pertandingan);
			$data['pemenang'] = $this->db->get('tabel_pemenang_pertandingan')->row_array();

			if($pertandingan){
				$this->load->view('template/v_head', $data);
				$this->load->view('v_pemenang', $data);
				$this->load->view('template/v_foot');
			}
			else{
				$this->session->set_flashdata('gagal', 'Halaman yang ingin Anda akses tidak valid.');
        redirect($_SERVER['HTTP_REFERER']);
			}
    }
  }
