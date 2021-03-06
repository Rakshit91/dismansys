<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {
	public function index(){
		$this->staff_login();
	}

	public function staff_login() {
		$this->load->view('staff_login');
	}
	
	public function login() {
		$this->load->view('login');
	}

	public function signup(){
		$this->load->view('signup');
	}

	public function members() {
		$this->load->model('model_staff');
		if($this->session->userdata('is_logged_in')) {
			$data['results'] = $this->model_staff->get_all_disasters();
			$this->load->view('staff', $data);
		} else {
			redirect('main/restricted');
		}
	}

	public function select_disaster() {
		$this->load->model('model_staff');
		$this->session->set_userdata('disaster_id', $this->input->post('disaster_id'));
		$data['results'] = $this->model_staff->get_all_resource_category();
		$this->load->view('staff_disaster', $data);
	}
	
	public function select_resource_category() {
		$this->load->model('model_staff');
		$this->session->set_userdata('resource_category_id', $this->input->post('resource_category_id'));
		$data['results'] = $this->model_staff->get_all_resources($this->input->post('resource_category_id'));
		$this->load->view('staff_disaster', $data);
	}

	public function restricted(){
		$this->load->view('restricted');
	}

	public function login_validation(){
		$this->load->model('model_staff');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_cradentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if($this->form_validation->run()){

			$data = array(
				'name' => $this->model_staff->get_name($this->input->post('email')),
				'email' => $this->input->post('email'),
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			redirect('staff/members');
		} else {
			$this->load->view('login');
		}
	}


	public function signup_validation(){
		$this->load->library('form_validation');
		$this->load->model('model_users');
		
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

		$this->form_validation->set_message('is_unique', "This email address already exists.");
		
		
		if($this->form_validation->run()){
			$key = md5(uniqid());

			$this->load->library('email', array('mailtype' => 'html'));

			$this->email->from('admin@dismansys.url.ph', "Rakshit");
			$this->email->to($this->input->post('email'));
			$this->email->subject("Confirm you account.");
			
			$message = "<p>Thank you signing up.</p>";
			$message .= "<p><a href = '".base_url(). "main/register_user/$key' >click here</a> to confirm your account</p>";
			$this->email->message($message);
			
			if($this->model_users->add_temp_user($key)) {
				if($this->email->send()) {
					echo "The mail has been sent";
				} else echo "The mail has not been sent";				
			} else echo "Problem adding to database";
			
			echo "done";

		} else {
			echo "fail";
			$this->load->view('signup');
		}
		
		
	}

	public function validate_cradentials(){
		$this->load->model('model_users');
		if($this->model_users->can_log_in('user_staff')){
			return true;
		} else {
			$this->form_validation->set_message('validate_cradentials', 'Invalid username/password.');
			return false;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('staff');
	}

	public function register_user($key) {
		$this->load->model('model_users');
		
		if($this->model_users->is_valid_key($key)) {
			if($newemail = $this->model_users->add_user($key)) {
				
				$data = array(
					'email' => $newemail,
					'is_logged_in' => 1
				);
				
				$this->session->set_userdata($data);
				redirect('main/members');
			} else {
				echo "failed to add the user, please try again";
			}
		} else {
			echo "invalid key";
		}
		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */