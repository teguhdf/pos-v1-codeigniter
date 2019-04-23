<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu extends CI_Controller {

  public function __construct(){
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
    $this->load->model('SubMenu_model', 'mSubmenu');
  }

	public function index()
	{
    $data['title'] = "Sub Menu Management";
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['subMenu'] = $this->mSubmenu->get_subMenu();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->load->view('setting/submenu',$data);
	}

  public function addSubMenu()
  {
    $output = array('error' => false);
    $this->form_validation->set_rules('title','Title', 'required');
    $this->form_validation->set_rules('menu_id','Menu Id', 'required');
    $this->form_validation->set_rules('url','Url', 'required');
    $this->form_validation->set_rules('icon','Icon', 'required');
    $this->form_validation->set_rules('is_active','Active', 'required');

    if ($this->form_validation->run() == false) {
      $output['error'] = true;
      $output['message'] = '<div style="padding-top:11px">'.validation_errors().'</div>';
      echo json_encode($output);
    }else {
      $data = [
        'title' => $this->input->post('title'),
        'menu_id' => $this->input->post('menu_id'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('is_active')
      ];

      $id = $this->input->post('id_subMenu');
      if ($id) {
        $query = $this->db->update('user_sub_menu',$data,array('id' => $id));
      }else{
        $query = $this->db->insert('user_sub_menu',$data);
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

  public function editSubMenu($id){
    $this->db->from('user_sub_menu');
    $this->db->where('id',$id);
    $query = $this->db->get()->row();
    echo json_encode($query);
  }

  public function deleteSubMenu($id){
    $this->db->where('id', $id);
		$this->db->delete('user_sub_menu');
    echo json_encode(array("status" => true));
  }
}
