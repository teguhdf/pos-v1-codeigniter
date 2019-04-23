<?php

function is_logged_in(){

  $ci = get_instance();

  if (!$ci->session->userdata('email')) {
      redirect('auth');
  }else{
      $role_id = $ci->session->userdata('role_id');
      $menu = $ci->uri->segment(1,2);

      $queryMenu = $ci->db->get_where('user_menu',['menu' => $menu])->row_array();
      $menu_id = $queryMenu['id'];

      $queryAccess = $ci->db->get_where('user_access_menu',['menu_id' => $menu_id, 'role_id' => $role_id]);

      if ($queryAccess->num_rows() < 1) {
          redirect('auth/blocked');
      }
  }
}

?>
