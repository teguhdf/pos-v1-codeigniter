<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubMenu_model extends CI_Model
{
    public function get_subMenu(){

      $query = 'SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ';
      return $this->db->query($query)->result_array();
    }
}
