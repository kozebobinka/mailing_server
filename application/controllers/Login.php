<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	public function index()
	{
		if (isset($this->session->username)) {
			redirect('mailing');
		}
		
		$this->form_validation->set_rules('login', 'логін', 'required');
		$this->form_validation->set_rules('password', 'пароль', 'required');
		
		if ($this->form_validation->run()) {	
			if ($user = $this->login_model->chesk_user($this->input->post())) {
				$this->session->set_userdata($user);
				redirect('mailing');
			}
		}
		
		$this->load->view('login/login');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}
}
