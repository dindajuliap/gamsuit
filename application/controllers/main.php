<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class main extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function index($pilihan, $id_pertandingan, $ronde){
			$this->db->set('pilihan_pemain', $pilihan);
			$this->db->where('id_pertandingan', $id_pertandingan);
			$this->db->where('ronde', $ronde);
			$this->db->where('id_pemain', $this->session->userdata('id_pemain'));
			$this->db->update('tabel_rincian_pertandingan');

			$r 	 = $ronde + 1;
			$p	 = $this->db->get_where('tabel_pertandingan', ['id_pertandingan' => $id_pertandingan])->row_array();
			$cek = $this->db->get_where('tabel_rincian_pertandingan', ['id_pertandingan' => $id_pertandingan, 'ronde' => $ronde, 'pilihan_pemain' => NULL])->num_rows();

			if($cek == 0){
				$this->db->limit(1);
				$this->db->order_by('id_rincian_pertandingan', 'ASC');
				$this->db->where('id_pertandingan', $id_pertandingan);
				$this->db->where('ronde', $ronde);
				$pemain_1 = $this->db->get('tabel_rincian_pertandingan')->row_array();

				$this->db->limit(1);
				$this->db->order_by('id_rincian_pertandingan', 'DESC');
				$this->db->where('id_pertandingan', $id_pertandingan);
				$this->db->where('ronde', $ronde);
				$pemain_2 = $this->db->get('tabel_rincian_pertandingan')->row_array();

				if($pemain_1['pilihan_pemain'] == 'Batu' AND $pemain_2['pilihan_pemain'] == 'Gunting'){
					$id_pemain = $pemain_1['id_pemain'];
					$id_kalah  = $pemain_2['id_pemain'];
				}
				elseif($pemain_1['pilihan_pemain'] == 'Gunting' AND $pemain_2['pilihan_pemain'] == 'Kertas'){
					$id_pemain = $pemain_1['id_pemain'];
					$id_kalah  = $pemain_2['id_pemain'];
				}
				elseif($pemain_1['pilihan_pemain'] == 'Kertas' AND $pemain_2['pilihan_pemain'] == 'Batu'){
          $id_pemain = $pemain_1['id_pemain'];
					$id_kalah  = $pemain_2['id_pemain'];
        }
        elseif($pemain_2['pilihan_pemain'] == 'Batu' AND $pemain_1['pilihan_pemain'] == 'Gunting'){
					$id_pemain = $pemain_2['id_pemain'];
					$id_kalah  = $pemain_1['id_pemain'];
				}
				elseif($pemain_2['pilihan_pemain'] == 'Gunting' AND $pemain_1['pilihan_pemain'] == 'Kertas'){
					$id_pemain = $pemain_2['id_pemain'];
					$id_kalah  = $pemain_1['id_pemain'];
				}
				elseif($pemain_2['pilihan_pemain'] == 'Kertas' AND $pemain_1['pilihan_pemain'] == 'Batu'){
          $id_pemain = $pemain_2['id_pemain'];
					$id_kalah  = $pemain_1['id_pemain'];
        }
				elseif($pemain_1['pilihan_pemain'] == $pemain_2['pilihan_pemain']){
					$id_pemain = NULL;
				}

				$this->db->limit(1);
	      $this->db->order_by('id_pemenang', 'DESC');
	      $pemenang = $this->db->get('tabel_pemenang')->row_array();

	      if($pemenang){
	        $id_pemenang = $pemenang['id_pemenang'] + 1;
	      }
	      else{
	        $id_pemenang = 1;
	      }

				$data = [
					'id_pemenang' 		=> $id_pemenang,
					'id_pertandingan' => $id_pertandingan,
					'ronde' 					=> $ronde,
					'id_pemain' 		  => $id_pemain
				];
				$this->db->insert('tabel_pemenang', $data);

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

					if($id_pemain == $this->session->userdata('id_pemain')){
						$this->session->set_flashdata('menang', $ronde);
					}
					elseif($id_pemain == NULL){
						$this->session->set_flashdata('seri', $ronde);
					}
					elseif($id_kalah == $this->session->userdata('id_pemain')){
						$this->session->set_flashdata('kalah', $ronde);
					}
					redirect('pertandingan?p='.$id_pertandingan.'&r='.$r);
				}
			}
			else{
				redirect('menunggu-pilihan?p='.$id_pertandingan.'&r='.$ronde);
			}
    }
  }
