<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class beranda extends CI_Controller{
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}

		public function index(){
			$this->form_validation->set_rules('nama_pemain', 'Nama', 'required|trim');

      if($this->form_validation->run() == FALSE){
				$data['title'] = 'Ayo main GamSuit!';

				$this->db->where('status_pertandingan', 'Sedang bermain');
				$this->db->where('id_pemain_1', $this->session->userdata('id_pemain'));
				$this->db->or_where('id_pemain_2', $this->session->userdata('id_pemain'));
				$pertandingan1 = $this->db->get('tabel_pertandingan')->row_array();

				$this->db->where('status_pertandingan', 'Belum mulai');
				$this->db->where('id_pemain_1', $this->session->userdata('id_pemain'));
				$this->db->or_where('id_pemain_2', $this->session->userdata('id_pemain'));
				$pertandingan2 = $this->db->get('tabel_pertandingan')->row_array();

				if($pertandingan1){
					$this->db->where('id_pertandingan', $pertandingan1['id_pertandingan']);
					$this->db->delete('tabel_rincian_pertandingan');

					$this->db->where('id_pertandingan', $pertandingan1['id_pertandingan']);
					$this->db->delete('tabel_pemenang');

					if($pertandingan1['id_pemain_1'] == $this->session->userdata('id_pemain')){
						$this->db->set('id_pemain_1', NULL);
						$this->db->set('status_pertandingan', 'Belum mulai');
						$this->db->where('id_pertandingan', $pertandingan1['id_pertandingan']);
						$this->db->update('tabel_pertandingan');

						$this->db->where('id_pemain', $this->session->userdata('id_pemain'));
						$this->db->delete('tabel_pemain');
					}
					elseif($pertandingan1['id_pemain_2'] == $this->session->userdata('id_pemain')){
						$this->db->set('id_pemain_2', NULL);
						$this->db->set('status_pertandingan', 'Belum mulai');
						$this->db->where('id_pertandingan', $pertandingan1['id_pertandingan']);
						$this->db->update('tabel_pertandingan');

						$this->db->where('id_pemain', $this->session->userdata('id_pemain'));
						$this->db->delete('tabel_pemain');
					}
				}
				elseif($pertandingan2){
					$this->db->where('id_pertandingan', $pertandingan2['id_pertandingan']);
					$this->db->delete('tabel_pertandingan');

					$this->db->where('id_pemain', $this->session->userdata('id_pemain'));
					$this->db->delete('tabel_pemain');
				}

				$this->session->unset_userdata('id_pemain');

				$this->load->view('template/v_head', $data);
				$this->load->view('v_beranda');
				$this->load->view('template/v_foot');
      }
      else{
				$nama_pemain = $this->input->post('nama_pemain');

				$this->db->limit(1);
				$cek = $this->db->get_where('tabel_pertandingan', ['status_pertandingan' => 'Belum mulai'])->row_array();

				$this->db->limit(1);
        $this->db->order_by('id_pemain', 'DESC');
        $pemain = $this->db->get('tabel_pemain')->row_array();

        if($pemain){
          $id_pemain = $pemain['id_pemain'] + 1;
        }
        else{
          $id_pemain = 1;
        }

				$data_pemain = [
					'id_pemain' 	=> $id_pemain,
					'nama_pemain' => $nama_pemain
				];
				$this->db->insert('tabel_pemain', $data_pemain);

				if($cek){
					$this->db->set('id_pemain_2', $id_pemain);
					$this->db->set('status_pertandingan', 'Sedang bermain');
					$this->db->where('id_pertandingan', $cek['id_pertandingan']);
					$this->db->update('tabel_pertandingan');
				}
				else{
					$this->db->limit(1);
	        $this->db->order_by('id_pertandingan', 'DESC');
	        $pertandingan = $this->db->get('tabel_pertandingan')->row_array();

	        if($pertandingan){
	          $id_pertandingan = $pertandingan['id_pertandingan'] + 1;
	        }
	        else{
	          $id_pertandingan = 1;
	        }

					$data_pertandingan = [
						'id_pertandingan' 		=> $id_pertandingan,
						'id_pemain_1'					=> $id_pemain,
						'id_pemain_2'					=> NULL,
						'status_pertandingan' => 'Belum mulai'
					];
					$this->db->insert('tabel_pertandingan', $data_pertandingan);
				}

				$data = ['id_pemain' => $id_pemain];
				$this->session->set_userdata($data);
				redirect('menunggu-pemain');
			}
		}
	}
