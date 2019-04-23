<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-luggage-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My POS <sup>v.1</sup></div>
    </a>

    <!-- Divider -->

    <?php
      $role_id = $this->session->userdata('role_id');
      $queryMenu = "SELECT `user_menu`.`id`,`menu`
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";

      $parentMenu = $this->db->query($queryMenu)->result_array();
    ?>
    <!-- LOOPING PARENT MENUS -->
    <?php foreach ($parentMenu as $pmenu) :?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading ">

          <?php echo $pmenu['menu'] ?>
      </div>
      <!-- SUB MENU -->
       <?php
           $querySubMenu ="SELECT *
                           FROM `user_sub_menu`
                           WHERE `menu_id` = {$pmenu['id']}
                           AND `is_active` = 1";

          $subMenu = $this->db->query($querySubMenu)->result_array();
       ?>
       <?php foreach ($subMenu as $smenu) :?>
         <?php if ($title == $smenu['title']) : ?>
           <li class="nav-item active">
         <?php else : ?>
           <li class="nav-item">
         <?php endif; ?>

                <a class="nav-link" style="padding-top:5px;padding-bottom:2px" href="<?php echo base_url($smenu['url']); ?>">
                <i class="<?php echo $smenu['icon'] ?>"></i>
                <span><?php echo $smenu['title']; ?></span></a>
              </li>

       <?php endforeach; ?> <!--end looping sub menu -->
    <?php endforeach; ?> <!--end looping parent menu -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
