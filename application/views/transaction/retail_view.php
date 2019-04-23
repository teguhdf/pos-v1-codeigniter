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
                    <div class="row">
                      <div class="col-8"><h1 class="h3 mb-2 text-gray-800"><b><?php echo $title ?></b></h1></div>
                      <div class="col-4"><a href="javascript:void(0)" class="btn btn-primary mb-3 float-right" onclick="showModalSearch()">Search Product</a></div>

                    <center><?php echo $this->session->flashdata('msg');?></center>
                    <br>

                      <div class="col-lg">
                        <form action="<?php echo base_url().'transaction/RetailSales/add_to_cart'?>" method="post">
                          <div class="row">
                            <div class="col-md-2">
                              <input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm">
                            </div>
                            <div class="col-md-10">
                              <div id="detail_barang" style="position:absolute;"></div>
                            </div>
                        
                        </form>
                        </div>
                        <br>
                        <table class="table table-hover" id="table1">
                          <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Product Code</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Unit</th>
                              <th scope="col">Price(Rp)</th>
                              <th scope="col">Diskon(Rp)</th>
                              <th scope="col">Qty</th>
                              <th scope="col">Sub Total</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; ?>
                            <?php $no = 1; ?>
                            <?php foreach ($this->cart->contents() as $items): ?>
                            <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                            <tr>
                                <td><?=$no++;?></td>
                                 <td><?=$items['id'];?></td>
                                 <td><?=$items['name'];?></td>
                                 <td><?=$items['satuan'];?></td>
                                 <td><?php echo number_format($items['amount']);?></td>
                                 <td><?php echo number_format($items['disc']);?></td>
                                 <td><?php echo number_format($items['qty']);?></td>
                                 <td><?php echo number_format($items['subtotal']);?></td>

                                 <td><a href="<?php echo base_url().'transaction/RetailSales/remove/'.$items['rowid'];?>" class="btn btn-danger btn-sm"><span class="fa fa-close"></span> Batal</a></td>
                            </tr>

                            <?php $i++; ?>
                            <?php endforeach; ?>

                          </tbody>
                        </table>
                        <hr>
                        <form action="<?php echo base_url().'transaction/RetailSales/simpan_penjualan'?>" method="post">
                          <table>
                            <tr>
                                <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg"> Simpan</button></td>
                                <th style="width:140px;">Total Belanja(Rp)</th>
                                <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total());?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                                <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total();?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                            </tr>
                            <tr>
                                <th>Tunai(Rp)</th>
                                <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                                <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Kembalian(Rp)</th>
                                <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            </tr>

                        </table>
                        </form>
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

    <!-- Logout Modal-->
    <?php $this->load->view('__partials/modal.php'); ?>

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
        $(document).ready(function() {
            $('#mydata').DataTable({
              "pageLength": 5
            });
        } );
    </script>

    <script type="text/javascript">
        function showModalSearch() {
            $('#searchProduct').modal('show'); // show bootstrap modal
            $('.modal-title').text('Search Product'); // Set Title to Bootstrap modal title
        }
    </script>

    <script type="text/javascript">
        $(function(){
            $('#jml_uang').on("input",function(){
                var total=$('#total').val();
                var jumuang=$('#jml_uang').val();
                var hsl=jumuang.replace(/[^\d]/g,"");
                $('#jml_uang2').val(hsl);
                $('#kembalian').val(hsl-total);
            })

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            //Ajax kabupaten/kota insert
            $("#kode_brg").focus();
            $("#kode_brg").on("input",function(){
                var kobar = {kode_brg:$(this).val()};
                   $.ajax({
               type: "POST",
               url : "<?php echo base_url().'transaction/RetailSales/get_products';?>",
               data: kobar,
               success: function(msg){
               $('#detail_barang').html(msg);
               }
            });
            });

            $("#kode_brg").keypress(function(e){
                if(e.which==13){
                    $("#jumlah").focus();
                }
            });
        });
    </script>

</body>

</html>
