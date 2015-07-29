<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
	}

	public function index()
	{
		$data['users']=$this->user->get_all_user_details();
		$this->_render_page('register/index',$data);
	}


	public function register_new_user(){
		$create_flag=$this->user->create_user();
		if($create_flag==1){
			$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
                    'text' => 'User registered!',
                    'type' => 'success'
            )));
		}
		elseif ($create_flag==2) {
			$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
                    'text' => 'User already exists!',
                    'type' => 'info'
            )));
		}
		else{
			$this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode(array(
                    'text' => 'Error occured!',
                    'type' => 'danger'
            )));
		}

	}

	public function get_user_details(){
		$username=$this->input->post('username');
		$user_details=$this->user->get_user_details($username);
		if($user_details)
		$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($user_details));
		else 
		$this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode(array('text'=>"User not found!",'type'=>'danger')));
		
	}

	public function update_user_details(){
		$username=$this->input->post('username');
		if($this->user->update_user($username)){
			$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
                    'text' => 'User updated!',
                    'type' => 'success'
            )));
		}
	}

	public function delete_user(){
		$username=$this->input->post('username');
		$del_op=$this->user->delete_user($username);
		if($del_op){
			$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
                    'text' => 'User deleted!',
                    'type' => 'success'
            )));
		}
		else{
			$this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode(array('text'=>"User not found!",'type'=>'danger')));
		}
	}


	function _render_page($view, $data=null, $render=false)
	{
		$data['current_section'] = 'registration';
		$view_html = array(
			$this->load->view('base/header', $data, $render),
			$this->load->view($view, $data, $render),
			$this->load->view('base/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}

}

/* End of file registration.php */
/* Location: ./application/controllers/welcome.php */