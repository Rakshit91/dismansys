<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){

//		$this->load->model("model_staff");
//		$data['results'] = $this->model_staff->get_all_staff();
//		if($this->session->userdata('is_logged_in') && ($this->session->userdata('user_type') == "admin")) {
//			$this->load->view('admin', $data);
//		} else {
		$this->load->view('admin_login');
//		}
	}
	
	public function login_validation(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_cradentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if($this->form_validation->run()){

			$data = array(
				'email' => $this->input->post('email'),
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			$this->load->view('admin');
		} else {
			$this->load->view('admin_login');
		}
	}
	
	public function validate_cradentials(){
		$this->load->model('model_users');
		if($this->model_users->can_log_in('adminUser')){
			return true;
		} else {
			$this->form_validation->set_message('validate_cradentials', 'Invalid username/password.');
			return false;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('admin');
	}

	public function add_disaster() {
		$this->load->model('model_disasters');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required|callback_date_validation');
		$this->form_validation->set_rules('city', 'City', 'required');
		
		if($this->form_validation->run()) {
			if($this->model_disasters->add_disaster()) {
				$this->session->set_flashdata('msg', 'disaster successfully added');
			} else {
				$this->session->set_flashdata('msg', 'disaster already exists');
			}
		}

		redirect('admin/disasters');

	}

	public function date_validation() {
		$date = $this->input->post('date');
		$year = (int) substr($date, 0, 4);
		$month = (int) substr($date, 5, 2);
		$day = (int) substr($date, 8, 2);
	    if (checkdate($month, $day, $year)) {
	    	$date = date('Y/m/d');
		    $yearNow = (int) substr($date, 0, 4);
			$monthNow = (int) substr($date, 5, 2);
			$dayNow = (int) substr($date, 8, 2);
			if(($year<=$yearNow)&&($month<=$monthNow)&&($day<=$dayNow)) {
				return true;
			} else {
				$this->form_validation->set_message('date_validation', 'date should be on or before today');
			}
	    } else {
	    	$this->form_validation->set_message('date_validation', 'date formate incorrect');
	    }
	    //$this->form_validation->set_message('date_validation', 'Invalid DATE.');
	    return false;
	}

	public function disasters() {
		$this->load->model("model_disasters");
		$data['results'] = $this->model_disasters->get_all_disasters();
		$this->load->view('admin_disasters', $data);
	}

	public function staff() {
		$this->load->model("model_staff");
		$data['results'] = $this->model_staff->get_all_staff();
		$this->load->view('admin_staff', $data);
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

	public function restricted(){
		$this->load->view('restricted');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */