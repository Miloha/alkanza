<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Gusers_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function gusers_user()
	{
	/*
		$this->db->where('username',$username);
		$this->db->where('password',$password);*/

		$query = $this->db->get('gusers');

		return $query->result();

		/*if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			redirect(base_url().'login','refresh');
		}*/
	}

	public function flogin_user($username)
	{
		$this->db->where('username',$username);
		$query = $this->db->get('users');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			return FALSE;
		}
	}

	public function fuser($data)
	{
		
			$this->db->insert('gusers', $data); 
			return $this->db->insert_id();
		
	}

	public function frepo($data)
	{
		
			$this->db->insert('repos', $data); 
			return $this->db->insert_id();
		
	}
}