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
                    <h1 class="h3 mb-2 text-gray-800"><b>Customers</b> <small>(Pelanggan)</small></h1>
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Master Customers</h6>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12 col-md-12 m-b-100" style="margin-bottom: 20px">
                                <button type="button" class="btn btn-primary btn-md" onclick="showModal()"><i class="fas fa-plus"></i> Add Data</button>
                                <button type="button" class="btn btn-info btn-md" onclick="reload_table()"><i class="fas fa-sync"></i> Reload</button>
                            </div>
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                            <th style="width:125px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
        var table;

        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('master/customers/ajax_list') ?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                }, ],

            });


            //set input/textarea/select event when change value, remove class error and remove text help block
            $("input").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            // $("select").change(function(){
            //     $(this).parent().parent().removeClass('has-error');
            //     $(this).next().empty();
            // });

        });


        function showModal() {
            save_method = 'add';
            $('#form2')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#addCustomer').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Customer'); // Set Title to Bootstrap modal title
        }

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }

        function save() {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable

            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('master/customers/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('master/customers/ajax_update') ?>";
            }

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form2').serialize(),
                dataType: "JSON",
                success: function(data) {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#addCustomer').modal('hide');
                        Swal.fire({
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        reload_table();
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable


                },
                error: function(jqXHR, textStatus, errorThrown) {

                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Error deleting data',
                        footer: '<a href>Why do I have this issue?</a>'
                    })

                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable

                }
            });
        }

        function edit_customer(id) {

            save_method = 'update';
            $('#form2')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('master/customers/ajax_edit') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    //console.log(data);
                    $('[name="id_customer"]').val(data.id);
                    $('[name="nama"]').val(data.nama);
                    $('[name="noHp"]').val(data.noHp);
                    $('[name="email"]').val(data.email);
                    $('[name="alamat"]').val(data.alamat);
                    $('#addCustomer').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Customer'); // Set title to Bootstrap modal title

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

        function delete_customer(id) {

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
                        url: "<?php echo site_url('master/customers/ajax_delete') ?>/" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            //if success reload ajax table
                            $('#addCustomer').modal('hide');
                            Swal.fire({
                                type: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            reload_table();
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
    </script>

    <!-- Modal-->
    <?php $this->load->view('__partials/modal.php'); ?>
</body>

</html>
