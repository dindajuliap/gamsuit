<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class pilihan extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function index($id_pertandingan, $ronde){
      $this->db->where('id_pertandingan', $id_pertandingan);
      $this->db->where('ronde', $ronde);
      $this->db->where('pilihan_pemain', NULL);
      $this->db->where_not_in('id_pemain', $this->session->userdata('id_pemain'));
      $data = $this->db->get('tabel_rincian_pertandingan')->row_array();

      if(!$data){
        echo json_encode(1);
      }
    }

    public function main($id_pertandingan, $ronde){
      $p = $this->db->get_where('tabel_pertandingan', ['id_pertandingan' => $id_pertandingan])->row_array();
      $r = $ronde + 1;

      $this->db->where('id_pemain', $p['id_pemain_1']);
      $this->db->where('id_pertandingan', $id_pertandingan);
      $menang_1 = $this->db->get('tabel_pemenang')->num_rows();

      $this->db->where('id_pemain', $p['id_pemain_2']);
      $this->db->where('id_pertandingan', $id_pertandingan);
      $menang_2 = $this->db->get('tabel_pemenang')->num_rows();

			if($menang_1 >= 3){
				$this->db->set('status_pertandingan', 'Selesai');
				$this->db->where('id_pertandingan', $id_pertandingan);
				$this->db->update('tabel_pertandingan');

				$this->db->limit(1);
				$this->db->order_by('id_pemenang_pertandingan', 'DESC');
				$pemenang_pertandingan = $this->db->get('tabel_pemenang_pertandingan')->row_array();

				if($pemenang_pertandingan){
					$id_pemenang_pertandingan = $pemenang_pertandingan['id_pemenang_pertandingan'] + 1;
				}
				else{
					$id_pemenang_pertandingan = 1;
				}

				$data = [
					'id_pemenang_pertandingan' => $id_pemenang_pertandingan,
					'id_pertandingan' 				 => $id_pertandingan,
					'id_pemain' 							 => $p['id_pemain_1']
				];
				$this->db->insert('tabel_pemenang_pertandingan', $data);

				$this->session->set_flashdata('selesai');
				redirect('pemenang?p='.$id_pertandingan);
			}
			elseif($menang_2 >= 3){
				$this->db->set('status_pertandingan', 'Selesai');
				$this->db->where('id_pertandingan', $id_pertandingan);
				$this->db->update('tabel_pertandingan');

				$this->db->limit(1);
				$this->db->order_by('id_pemenang_pertandingan', 'DESC');
				$pemenang_pertandingan = $this->db->get('tabel_pemenang_pertandingan')->row_array();

				if($pemenang_pertandingan){
					$id_pemenang_pertandingan = $pemenang_pertandingan['id_pemenang_pertandingan'] + 1;
				}
				else{
					$id_pemenang_pertandingan = 1;
				}

				$data = [
					'id_pemenang_pertandingan' => $id_pemenang_pertandingan,
					'id_pertandingan' 				 => $id_pertandingan,
					'id_pemain' 							 => $p['id_pemain_2']
				];
				$this->db->insert('tabel_pemenang_pertandingan', $data);

				$this->session->set_flashdata('selesai');
				redirect('pemenang?p='.$id_pertandingan);
			}
      else{
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
          'id_pertandingan'         => $id_pertandingan,
          'ronde'										=> $r,
          'pilihan_pemain'        	=> NULL,
          'id_pemain'             	=> $this->session->userdata('id_pemain')
        ];
        $this->db->insert('tabel_rincian_pertandingan', $data);

				$pemenang = $this->db->get_where('tabel_pemenang', ['id_pertandingan' => $id_pertandingan, 'ronde' => $ronde])->row_array();

        if($pemenang['id_pemain'] == $this->session->userdata('id_pemain')){
          $this->session->set_flashdata('menang', $ronde);
        }
				elseif($pemenang['id_pemain'] == NULL){
					$this->session->set_flashdata('seri', $ronde);
				}
        elseif(($pemenang['id_pemain'] != $this->session->userdata('id_pemain')) AND ($pemenang['id_pemain'] != NULL)){
          $this->session->set_flashdata('kalah', $ronde);
        }
        redirect('pertandingan?p='.$id_pertandingan.'&r='.$r);
      }
    }
  }
