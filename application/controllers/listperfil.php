<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Listperfil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}

	public function index()
	{
		if($this->session->userdata('perfil') == FALSE or  $this->session->userdata('perfil') == 'suscriptor')
		{
			redirect(base_url().'login');
		}


		$crud = new grocery_CRUD();
		
		
		$data['titulo'] = 'Bienvenido';
		$crud->set_table('users');
		$crud->change_field_type('id', 'hidden', $this->session->userdata('id_usuario'));
		$crud->columns('username','perfil','nombre','phone','id_area');

		
		$crud->field_type('perfil','dropdown',
		array('administrador' => 'administrador', 'editor' => 'editor','suscriptor' => 'suscriptor'));
		
		$crud->set_relation('id_area','areas','nombre');

		$crud->unique_fields('username');
		
		
		$crud->display_as('username','Email');
		$crud->display_as('password','Clave');
		$crud->display_as('nombre', 'Nombre');
		$crud->display_as('phone', 'Telefono');
		$crud->display_as('id_area', 'SRC');
		
		$crud->field_type('password', 'password');
		
		
   	 	#$crud->callback_edit_field('password',array($this,'decrypt_password_callback'));
		
		
		if($this->session->userdata('perfil') == 'editor')
		{
			$crud->fields('username','perfil','nombre','phone');
			$crud->unset_delete();
			$crud->unset_add();
			$crud->unset_edit();

		}
		elseif ($this->session->userdata('perfil') == 'administrador') 
		{
			#$crud->fields('username','nombre','perfil','phone','password');
			$crud->unset_add_fields(array('id_area'));
			
		}
		$crud->unset_edit_fields(array('username','id_area'));
		
		$crud->callback_before_insert(array($this,'encrypt_password_callback_insert'));
    	$crud->callback_before_update(array($this,'encrypt_password_callback'));
    	$crud->callback_edit_field('password',array($this,'decrypt_password_callback'));

		$crud->set_language("spanish");
		$crud->required_fields('nombre','perfil');
		
		
//		$crud->field_type('porcentaje_resuelto','enum',array('10','30','50','100'));
		$data['output'] = $crud->render();
		
		$data['css_files'] = $data['output']->css_files;
		$data['js_files'] = $data['output']->js_files;
		
		$this->load->view('templates/header',$data);
		$this->load->view('admin_view',$data);
		$this->load->view('templates/footer',$data);
	}
	
	
	function encrypt_password_callback($post_array, $primary_key = null)
	{
		if(!empty($post_array['password']))
		{
			$post_array['password'] = sha1($post_array['password']);

		}else{
			unset($post_array['password']);
		}
	 	
	   
	    return $post_array;
	}

	function encrypt_password_callback_insert($post_array, $primary_key = null)
	{
		if(!empty($post_array['password']))
		{
			$post_array['password'] = sha1($post_array['password']);

		}else{
			$post_array['password'] = sha1('click' . rand());
		}
	 	
	   
	    return $post_array;
	}
 
	function decrypt_password_callback($value)
	{
	   
	    return "<input type='password' name='password' value='' />";
	}
	
	
}
