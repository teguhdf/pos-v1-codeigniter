<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

  public function __construct(){
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['title'] = "Sales Management";
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('transaction/sales_view',$data);
  }



}
