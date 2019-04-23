<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct(){
      parent::__construct();
      $this->load->library('form_validation');
    }

    public function index()
    {
      $this->form_validation->set_rules('email','Email','required|trim|valid_email');
      $this->form_validation->set_rules('password','Password','required|trim');

      if ($this->form_validation->run() == false) {
          $data['judul'] = "Form Login";
          $this->load->view('auth/template/header',$data);
          $this->load->view('auth/login');
          $this->load->view('auth/template/footer');
      }else{
        $this->_login();
      }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users',['email' => $email])->row_array();
        //cek user ada ga
        if ($user) {
          // cek user nya aktif ga
          if ($user['is_active'] == 1) {
            // cek password nya sama ga
            if (password_verify($password,$user['password'])) {
                $data = [
                  'email' => $user['email'],
                  'role_id' => $user['role_id'],
                  'id' => $user['id']
                ];

                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                  redirect('admin/overview');
                }else{
                  redirect('member/user');
                }

            }else{
              $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Wrong password!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
                redirect('auth');
            }
          }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Email has been not activated!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></div>');
              redirect('auth');
          }
        }else{
          $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Email is not registered!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('auth');
        }

    }

    public function registration()
    {
        // set_rules
        $this->form_validation->set_rules('name','Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]',[
          'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1','Password','required|trim|min_length[3]|matches[password2]',[
          'matches' => 'Password dont match!',
          'min_length' => 'Password too short!'
          ]);
        $this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');
        // run validation
        if ($this->form_validation->run() == false) {
            $data['judul'] = "Users Registration";
            $this->load->view('auth/template/header', $data);
            $this->load->view('auth/register');
            $this->load->view('auth/template/footer');
        }else{
            $data = [
              'name' => htmlspecialchars($this->input->post('name',true)),
              'email' => htmlspecialchars($this->input->post('email',true)),
              'image' => 'default.jpg',
              'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
              'role_id' => 2,
              'is_active' =>1,
              'date_created' => time()
            ];
            // insert to db
            $this->db->insert('users', $data);
            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
              congratulation! your account has been created. Please login<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></div>');
            redirect('auth');
        }
    }

    public function logout()
    {
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');

      $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show" role="alert">
        You has been logged out!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></div>');
      redirect('auth');
    }

    public function blocked()
    {
      $this->load->view('errors/blocked');
    }
}
