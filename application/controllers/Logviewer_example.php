<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI Logviewer example
 *
 * Just a test controller to see how the library works
 */
class Logviewer_example extends CI_Controller
{

	public function index()
	{
		// load the library
		$this->load->library('logviewer');

		// get logs data
		$data = $this->logviewer->get_logs();

		// load the view
		$this->load->view('logviewer', $data);
	}

}

/* End of file Logviewer_example.php */
/* Location: ./application/controllers/Logviewer_example.php */
