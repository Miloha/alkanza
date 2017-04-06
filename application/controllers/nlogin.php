<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nlogin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->database('default');
		// Include the facebook api php libraries
      
	}

	public function index()
	{

		
		switch ($this->session->userdata('perfil')) {
			case '':
				
				$data['token'] = $this->token();
				$data['titulo'] = 'Login con roles de usuario';
				$this->load->view('templates/header',$data);
				$this->load->view('nlogin_view',$data);
				$this->load->view('templates/footer',$data);
				break;

			default:
				redirect(base_url().'login');
				break;
		}
	}

	public function new_user()
	{
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
		{
			$this->form_validation->set_rules('username', 'Email', 'required|valid_email|trim|min_length[6]|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');
			$this->form_validation->set_rules('name', 'Nombre', 'required');

			//lanzamos mensajes de error si es que los hay

			if($this->form_validation->run() == FALSE)
			{
				$this->index();
			}else
			{
				$username = $this->input->post('username');
				$check_user = $this->login_model->flogin_user($username);
				
				if($check_user == TRUE)
				{
					$this->session->set_flashdata('usuario_incorrecto','El usuario ya existe');
					redirect(base_url().'login','refresh');

					
				}else
				{
					$datan['nombre'] = $this->input->post('name');
					$datan['username'] = $this->input->post('username');
					$datan['password'] = sha1($this->input->post('password'));
					$datan['perfil'] = 'suscriptor';
					$datan['id_area'] = '2';
					$datan['phone'] = $this->input->post('phone');
					$datan['id'] = $this->login_model->fuser($datan);
					$data = array(
                    'is_logued_in'     =>         TRUE,
                    'id_usuario'     =>         $datan['id'],
                    'perfil'        =>        $datan['perfil'],
                    'username'         =>         $datan['username'],
					'id_area'         =>         $datan['id_area'],
					'nombre'         =>         $datan['nombre']
					);
					$this->session->set_userdata($data);
					$this->index();

				}
			}
		}
		else{
			redirect(base_url().'login');
		}
	}

	
	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}

	public function logout_ci()
	{
		$this->session->sess_destroy();
		redirect(base_url().'login');
		//$this->index();
	}
}
