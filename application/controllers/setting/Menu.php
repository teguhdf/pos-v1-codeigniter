<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

  public function __construct(){
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
  }

	public function index()
	{
    $data['title'] = "Menu Management";
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->load->view('setting/menu',$data);
	}

  public function addMenu()
  {
    $output = array('error' => false);
    $this->form_validation->set_rules('menu','Menu', 'required');

    if ($this->form_validation->run() == false) {
      $output['error'] = true;
      $output['message'] = '<div style="padding-top:11px">'.validation_errors().'</div>';
      echo json_encode($output);
    }else {
      $data = ['menu' => $this->input->post('menu')];
      $id = $this->input->post('id_menu');

      if ($id) {
        $query = $this->db->update('user_menu',$data, array('id' => $id));
      }else{
        $query = $this->db->insert('user_menu',$data);
      }

      if ($query) {
        $output['message'] = "sukses";
      }else{
        $output['error'] = true;
        $output['message'] = 'User registered successfully';
      }
      echo json_encode($output);
    }
  }

  public function editMenu($id){
    $this->db->from('user_menu');
    $this->db->where('id',$id);
    $query = $this->db->get()->row();
    echo json_encode($query);
  }

  public function deleteMenu($id){
    $this->db->where('id', $id);
		$this->db->delete('user_menu');
    echo json_encode(array("status" => true));
  }

}
