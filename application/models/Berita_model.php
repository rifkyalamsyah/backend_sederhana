<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Berita_model extends CI_Model
{
	public function get_berita($id = '')
	{
		$this->db->select('berita.*, kategori_berita.nama_kategori');
		$this->db->from('berita');
		$this->db->join('kategori_berita', 'kategori_berita.id_kategori_berita = berita.id_kategori_berita', 'LEFT');

		if ($id != '') {
			$this->db->where('berita.id_berita', $id);
		}

		return $this->db->get();
	}
}
