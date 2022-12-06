<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class cek extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function pemain($id_pertandingan){
      $this->db->where('id_pertandingan', $id_pertandingan);
      $this->db->where('id_pemain_1', NULL);
      $this->db->or_where('id_pemain_2', NULL);
      $data = $this->db->get('tabel_pertandingan')->row_array();

      if($data){
        echo json_encode(1);
      }
    }
  }
