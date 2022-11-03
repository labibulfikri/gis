<?php defined('BASEPATH') or exit('No direct script access allowed');




class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
	}


	public function index()
	{
		$data = array(
			'masterpage' => 'layout/layout',
			'navbar' => 'layout/navbar',
			'sidebar' => 'layout/sidebar',
			'content' => 'home',
			'footer' => 'layout/footer',
			'title' => 'Home',
		);
		$this->load->view($data['masterpage'], $data);
	}

	public function simpan()
	{
		$simpan = array(
			'nama_gis' => $this->input->post('nama_gis'),
			'alamat' => $this->input->post('alamat'),
			'kelurahan' => $this->input->post('kelurahan'),
			'kordinat' => $this->input->post('polygon'),
		);

		$exe = $this->m_home->simpan('polygon', $simpan);
		if ($exe) {
			echo "<script type='text/javascript'>
				Swal.fire('Any fool can use a computer')
				</script>";
		}
	}
}
