<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class cari extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function pemain(){
      $this->db->where('status_pertandingan', 'Sedang bermain');
      $this->db->where('id_pemain_1', $this->session->userdata('id_pemain'));
      $this->db->or_where('id_pemain_2', $this->session->userdata('id_pemain'));
      $data1 = $this->db->get('tabel_pertandingan')->row_array();

      $this->db->limit(1);
			$this->db->where_not_in('id_pemain_1', $this->session->userdata('id_pemain'));
			$this->db->where_not_in('id_pemain_2', $this->session->userdata('id_pemain'));
      $this->db->where('status_pertandingan', 'Belum mulai');
			$data2 = $this->db->get('tabel_pertandingan')->row_array();

      if($data1){
        echo json_encode(1);
      }
      elseif($data2 AND !$data1){
        echo json_encode(2);
      }
    }

    public function pertandingan(){
      $this->db->limit(1);
			$this->db->where_not_in('id_pemain_1', $this->session->userdata('id_pemain'));
			$this->db->where_not_in('id_pemain_2', $this->session->userdata('id_pemain'));
      $this->db->where('status_pertandingan', 'Belum mulai');
			$data = $this->db->get('tabel_pertandingan')->row_array();

      $this->db->set('id_pemain_2', $this->session->userdata('id_pemain'));
      $this->db->set('status_pertandingan', 'Sedang bermain');
      $this->db->where('id_pertandingan', $data['id_pertandingan']);
      $this->db->update('tabel_pertandingan');

      redirect('pertandingan/'.$data['id_pertandingan']);
    }
  }
