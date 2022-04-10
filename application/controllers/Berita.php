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
			'titel' => 'Homepage',
		);

		echo json_encode($data_json);
	}


	public function detail_berita()
	{
		$id = $this->input->get('id');
		$list_berita = $this->Berita_model->get_berita($id);
		$singel_berita = $list_berita->row();

		$arr_view = array(
			'list_berita' => $singel_berita
		);

		$html_view = $this->load->view('detail_berita', $arr_view, true);

		$data_json = array(
			'jumlah_berita' => $list_berita->num_rows(),
			'konten' => $html_view,
			'titel' => $singel_berita->judul_berita,
		);

		echo json_encode($data_json);
	}
}
