<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/demo
	 *	- or -  
	 * 		http://example.com/demo/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->data['meta']['title'] = '277StudiosLibrary';
		$this->data['meta']['description'] = '277StudiosLibrary';
		$this->data['meta']['keywords'] = '277StudiosLibrary';
		$this->data['body'] = 'home';
		$this->load->view('structure',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */