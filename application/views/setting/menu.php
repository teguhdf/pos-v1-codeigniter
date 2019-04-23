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
                      <div class="col-lg-6">
                        <a href="javascript:void(0)" class="btn btn-primary mb-3" onclick="showModal()">Add New</a>
                        <table class="table table-hover" id="table1">
                          <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Menu</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no=1; ?>
                            <?php foreach($menu as $m) : ?>
                              <tr>
                                <th scope="row"><?php echo $no++ ?></th>
                                <td><?php echo $m['menu'] ?></td>
                                <td>
                                  <a href="javascript:void(0)" class="badge badge-success" onclick="editMenu(<?php echo $m['id'] ?>)">Edit</a>
                                  <a href="javascript:void(0)" class="badge badge-danger" onclick="deleteMenu(<?php echo $m['id'] ?>)">Delete</a>
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

    <script>
      var save_method;
      $(document).ready(function(){
        $('#formMenu').submit(function(e){
          e.preventDefault();
          var url;
          if (save_method == 'add') {
              url = "<?php echo site_url('setting/menu/addMenu') ?>";
          } else {
              url = "<?php echo site_url('setting/menu/addMenu') ?>";
          }

          // ajax adding data to database
          $.ajax({
              url: url,
              type: "POST",
              data: $('#formMenu').serialize(),
              dataType: "JSON",
              success: function(response) {
                $('#message').html(response.message);
                if(response.error){
                 $('#responseDiv').removeClass('alert-success').addClass('alert-danger').show();
                }
                else{
                  $('#menuManagement').modal('hide');
                  $('#formMenu')[0].reset();
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

      function editMenu(id) {
          //Ajax Load data from ajax
          $.ajax({
              url: "<?php echo site_url('setting/menu/editMenu') ?>/" + id,
              type: "GET",
              dataType: "JSON",
              success: function(data) {
                  //console.log(data);
                  $('[name="id_menu"]').val(data.id);
                  $('[name="menu"]').val(data.menu);

                  $('#menuManagement').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Edit Menu'); // Set title to Bootstrap modal title

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

      function deleteMenu(id) {

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
                      url: "<?php echo site_url('admin/menu/deleteMenu') ?>/" + id,
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
          save_method = 'add';
          $('#form')[0].reset(); // reset form on modals
          $('#menuManagement').modal('show'); // show bootstrap modal
          $('.modal-title').text('Add New Menu'); // Set Title to Bootstrap modal title
      }
    </script>

    <!-- Modal-->
    <?php $this->load->view('__partials/modal.php'); ?>
</body>

</html>
