<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php $this->load->view('__partials/head.php'); ?>
<!-- End head -->

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('__partials/sidebar.php'); ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php $this->load->view('__partials/topBar.php'); ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><b><?php echo $title ?></b></h1>
                    <br>
                    <div class="row">
                      <div class="col-lg">
                        <a href="javascript:void(0)" class="btn btn-primary mb-3" onclick="showModal()">Add New</a>
                        <table class="table table-hover" id="table1">
                          <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Title</th>
                              <th scope="col">Menu</th>
                              <th scope="col">Url</th>
                              <th scope="col">Icon</th>
                              <th scope="col">Is Active</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no=1; ?>
                            <?php foreach($subMenu as $sm) : ?>
                              <tr>
                                <th scope="row"><?php echo $no++ ?></th>
                                <td><?php echo $sm['title'] ?></td>
                                <td><?php echo $sm['menu'] ?></td>
                                <td><?php echo $sm['url'] ?></td>
                                <td><?php echo $sm['icon'] ?></td>
                                <td><?php if($sm['is_active'] == 1):
                                            echo "Active";
                                          else :
                                            echo "Not Active";
                                          endif;
                                      ?>
                                </td>
                                <td>
                                  <a href="javascript:void(0)" class="badge badge-success" onclick="editSubMenu(<?php echo $sm['id'] ?>)">Edit</a>
                                  <a href="javascript:void(0)" class="badge badge-danger" onclick="deleteSubMenu(<?php echo $sm['id'] ?>)">Delete</a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('__partials/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="<?php echo base_url() ?>vendor/sweetalert2/package/dist/sweetalert2.all.min.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <script type="text/javascript">

      $(document).ready(function(){
        $('#formSubMenu').submit(function(e){
          e.preventDefault();
          var url = "<?php echo site_url('setting/Submenu/addSubMenu') ?>";
          // ajax adding data to database
          $.ajax({
              url: url,
              type: "POST",
              data: $('#formSubMenu').serialize(),
              dataType: "JSON",
              success: function(response) {
                $('#message2').html(response.message);
                if(response.error){
                 $('#responseDiv2').removeClass('alert-success').addClass('alert-danger').show();
                }
                else{
                  $('#subMenuManagement').modal('hide');
                  $('#formSubMenu')[0].reset();
                  Swal.fire({
                      type: 'success',
                      title: 'Your work has been saved',
                      showConfirmButton: false,
                      timer: 1500
                  })
                  setTimeout(function(){
                    window.location.reload(1);
                 }, 1600);
                }
               }
             });
        });
      });

      function editSubMenu(id) {

          //Ajax Load data from ajax
          $.ajax({
              url: "<?php echo site_url('setting/Submenu/editSubMenu') ?>/" + id,
              type: "GET",
              dataType: "JSON",
              success: function(data) {
                  //console.log(data);
                  $('[name="id_subMenu"]').val(data.id);
                  $('[name="title"]').val(data.title);
                  $('[name="menu_id"]').val(data.menu_id);
                  $('[name="url"]').val(data.url);
                  $('[name="icon"]').val(data.icon);
                  var is_active = $('[name="is_active"]').val(data.is_active);
                  console.log(data.is_active);
                  if(data.is_active == 1){
                    $('#customRadioInline1').attr('checked','checked');
                  }else{
                    $('#customRadioInline2').attr('checked','checked');
                  }



                  $('#subMenuManagement').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Edit Sub Menu'); // Set title to Bootstrap modal title


              },
              error: function(jqXHR, textStatus, errorThrown) {
                  Swal.fire({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Error deleting data',
                      footer: '<a href>Why do I have this issue?</a>'
                  })
              }
          });
      };

      function deleteSubMenu(id) {

          Swal.fire({
              title: 'Are you sure?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.value) {
                  // ajax delete data to database
                  $.ajax({
                      url: "<?php echo site_url('setting/Submenu/deleteSubMenu') ?>/" + id,
                      type: "POST",
                      dataType: "JSON",
                      success: function(data) {
                          //if success reload ajax table
                          Swal.fire({
                              type: 'success',
                              title: 'Your work has been saved',
                              showConfirmButton: false,
                              timer: 1200
                          })
                          setTimeout(function(){
                            window.location.reload(1);
                         }, 1250);
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                          Swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Error deleting data',
                              footer: '<a href>Why do I have this issue?</a>'
                          })
                      }
                  });
              }
          })

      }

      function showModal() {
          $('#formSubMenu')[0].reset(); // reset form on modals
          $('#subMenuManagement').modal('show'); // show bootstrap modal
          $('.modal-title').text('Add New Sub Menu'); // Set Title to Bootstrap modal title
      }
    </script>

    <!-- Logout Modal-->
    <?php $this->load->view('__partials/modal.php'); ?>

</body>

</html>
