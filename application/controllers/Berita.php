<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); //bisa juga di autoload libraries
		$this->load->model('Berita_model');
	}


	public function index()
	{
		$list_berita = $this->Berita_model->get_berita();

		$arr_view = array(
			'list_berita' => $list_berita
		);

		$html_view = $this->load->view('daftar_berita', $arr_view, true);

		$data_json = array(
			'jumlah_berita' => $list_berita->num_rows(),
			'konten' => $html_view,
			'title' => 'Homepage',
		);

		echo json_encode($data_json);
	}


	public function detail_berita()
	{
		$id = $this->input->get('id');
		$list_berita = $this->Berita_model->get_berita($id);
		$single_berita = $list_berita->row();

		$arr_view = array(
			'list_berita' => $single_berita
		);

		$html_view = $this->load->view('detail_berita', $arr_view, true);

		$data_json = array(
			'jumlah_berita' => $list_berita->num_rows(),
			'konten' => $html_view,
			'title' => $single_berita->judul_berita,
		);

		echo json_encode($data_json);
	}


	public function form_input()
	{
		$list_kategori = $this->Berita_model->get_kategori();

		$arr_view = array(
			'list_kategori' => $list_kategori,
		);
		$html_view = $this->load->view('form_berita', $arr_view, true);

		$data_json = array(
			'konten' => $html_view,
			'title' => 'Input Berita',
		);

		echo json_encode($data_json);
	}


	public function create_data()
	{
		$this->db->trans_start();

		$arr_input = array(
			'id_kategori_berita' => $this->input->post('id_kategori_berita'),
			'judul_berita' => $this->input->post('judul_berita'),
			'isi_berita' => $this->input->post('isi_berita'),
			'waktu_post' => date("Y-m-d H:i:s")
		);

		$this->Berita_model->input($arr_input);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal Input Data');
		} else {
			$this->db->trans_commit();
			$data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil Input Data');
		}

		echo json_encode($data_output);
	}
}
