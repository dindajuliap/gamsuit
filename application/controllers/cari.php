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

			$this->session->set_flashdata('sukses','Pemain ditemukan. Selamat bermain!');
      redirect('pertandingan?p='.$data['id_pertandingan']);
    }

		public function ruangan(){
			$this->db->where('status_pertandingan', 'Sedang bermain');
			$this->db->where('id_pemain_1', $this->session->userdata('id_pemain'));
			$this->db->or_where('id_pemain_2', $this->session->userdata('id_pemain'));
			$ruangan = $this->db->get('tabel_pertandingan')->row_array();

			$this->db->limit(1);
      $this->db->order_by('id_rincian_pertandingan', 'DESC');
      $rincian = $this->db->get('tabel_rincian_pertandingan')->row_array();

      if($rincian){
        $id_rincian_pertandingan = $rincian['id_rincian_pertandingan'] + 1;
      }
      else{
        $id_rincian_pertandingan = 1;
      }

			$data = [
				'id_rincian_pertandingan' => $id_rincian_pertandingan,
				'id_pertandingan'         => $ruangan['id_pertandingan'],
				'ronde'										=> 1,
				'pilihan_pemain'        	=> NULL,
				'id_pemain'             	=> $this->session->userdata('id_pemain')
			];
			$this->db->insert('tabel_rincian_pertandingan', $data);

			$this->session->set_flashdata('ronde', 1);
			redirect('pertandingan?p='.$ruangan['id_pertandingan'].'&r=1');
		}
  }
