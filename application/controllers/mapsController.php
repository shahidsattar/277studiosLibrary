<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MapsController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
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
		$this->load->view('welcome_message');
	}
	function login_validation()
	{
		$this->load_model('model_user');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');	
		if ($this->form_validation->run() == FALSE) {
			$result['errors'] = array();
			$result['hidden'] = array();
			$result['success'] = false;
			$fields = array('email', 'password');
			foreach ($fields as $field)
			{
				if (form_error($field)) {
				$result['errors'][$field] = strip_tags(form_error($field));
				}else{
				$result['hidden'][] = $field;
				}
			}
		}
		else
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$result_row = $this->model_user->check_member($email,$password);
			if($result_row->num_rows() > 0)
			{ 
				foreach($result_row->result() as $row)
				{
					$this->session->set_userdata('email',$row->email);
					$this->session->set_userdata('is_logged_in',true);				 	
				}
				if($this->input->post('rememberme'))
				{
					$expire = time() + 1728000; // Expire in 20 days
				 	setcookie('email', $email, $expire);
					setcookie('pass', $password, $expire);

				}

		   }
		   else

		   { // If validation fails.
				$this->session->set_flashdata('error_message', '<div id="message"><strong>Sorry!</strong> Incorrect Email id or Password.</div>'); //echo json_encode($result);exit;

				redirect($this->config->item('base_url').'');

			}
			$result['success'] = 1;

		}

		  echo json_encode($result);//exit;

	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */