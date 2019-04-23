<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListReport extends CI_Controller {

  public function __construct(){
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
  }

	public function index()
	{
    $data['title'] = "List Report";
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->load->view('report/list-report',$data);
	}


}
