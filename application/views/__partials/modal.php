<!-- Modal Tambah Data Supplier -->
<div class="modal fade bd-example-modal-lg" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" id="form" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" value="" name="id_supplier" />
                            <div class="form-group">
                                <label for="name">Nama :</label>
                                <input type="text" id="name" class="form-control" name="nama">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">No Telepon :</label>
                                <input type="text" class="form-control" name="noHp">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Email :</label>
                                <input type="email" class="form-control" name="email">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Alamat :</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
                                <span class="help-block" style="color: red"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Keterangan :</label>
                                <textarea name="keterangan" id="alamat" class="form-control" cols="30" rows="7"></textarea>
                                <span class="help-block" style="color: red"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="button" id="btnSave" onclick="save()">Simpan</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Tambah Data product -->
<div class="modal fade bd-example-modal-lg" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" id="formProduct" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" value="" name="id_product" />
                            <div class="form-group">
                                <label for="name">Nama :</label>
                                <input type="text" id="name" class="form-control" name="nama">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">No Telepon :</label>
                                <input type="text" class="form-control" name="noHp">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Email :</label>
                                <input type="email" class="form-control" name="email">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Alamat :</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
                                <span class="help-block" style="color: red"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Keterangan :</label>
                                <textarea name="keterangan" id="alamat" class="form-control" cols="30" rows="7"></textarea>
                                <span class="help-block" style="color: red"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="button" id="btnSave" onclick="save()">Simpan</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Tambah Data Customers -->
<div class="modal fade bd-example-modal-md" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Tambah Data Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" id="form2" method="POST">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <input type="hidden" value="" name="id_customer" />
                            <div class="form-group">
                                <label for="name">Nama :</label>
                                <input type="text" id="name" class="form-control" name="nama">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">No Telepon :</label>
                                <input type="text" class="form-control" name="noHp">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Email :</label>
                                <input type="email" class="form-control" name="email">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Alamat :</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
                                <span class="help-block" style="color: red"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="button" id="btnSave" onclick="save()">Simpan</button>
            </div>

        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Menu Management -->
<div class="modal fade" id="menuManagement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="" id="formMenu" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <div id="responseDiv" class="alert alert-danger alert-dismissible fade show" role="alert" style="padding: 1px;display:none">
                <span id="message"></span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>
            </div>
            <input type="hidden" value="" name="id_menu" />
            <div class="form-group">
              <input type="text" class="form-control" name="menu" placeholder="Menu name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal SubMenu Management -->
<div class="modal fade" id="subMenuManagement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" id="formSubMenu" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <div id="responseDiv2" class="alert alert-danger alert-dismissible fade show" role="alert" style="padding: 1px;display:none">
                <span id="message2"></span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>
            </div>
            <input type="hidden" class="form-control" name="id_subMenu" id="id_subMenu" value="">
            <div class="form-group">
              <input type="text" class="form-control" name="title"  placeholder="Sub menu name">
            </div>
            <div class="form-group">
              <select class="form-control" name="menu_id">
                <option value="">Select SubMenu</option>
                <?php foreach ($menu as $m): ?>
                  <option value="<?php echo $m['id']; ?>"><?php echo $m['menu']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="url" placeholder="Url sub menu name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="icon" placeholder="Icon sub menu name">
            </div>
            <div class="form_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1"  name="is_active" value='1' class="custom-control-input"  >
                  <label class="custom-control-label" for="customRadioInline1">Active</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" name="is_active"  id="customRadioInline2" value='0' class="custom-control-input"  >
                  <label class="custom-control-label" for="customRadioInline2">Not Active</label>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Search Product -->
<div class="modal fade" id="searchProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-condensed mt-10" style="font-size:11px;" id="mydata">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Satuan</th>
                  <th>Harga (Eceran)</th>
                  <th>Stok</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            <?php $no=0; ?>
            <?php foreach ($data->result_array() as $d) :
                $no++;
                $id=$d['barang_id'];
                $nm=$d['barang_nama'];
                $satuan=$d['barang_satuan'];
                $harpok=$d['barang_harpok'];
                $harjul=$d['barang_harjul'];
                $harjul_grosir=$d['barang_harjul_grosir'];
                $stok=$d['barang_stok'];
                $min_stok=$d['barang_min_stok'];
                $kat_id=$d['barang_kategori_id'];
                $kat_nama=$d['kategori_nama'];
            ?>
            <tr>
                <td style="text-align:center;"><?php echo $no;?></td>
                <td><?php echo $id;?></td>
                <td><?php echo $nm;?></td>
                <td style="text-align:center;"><?php echo $satuan;?></td>
                <td style="text-align:right;"><?php echo 'Rp '.number_format($harjul);?></td>
                <td style="text-align:center;"><?php echo $stok;?></td>
                <td style="text-align:center;">
                  <form action="<?php echo base_url().'transaction/RetailSales/add_to_cart' ?>" method="post">
                  <input type="hidden" name="kode_brg" value="<?php echo $id?>">
                  <input type="hidden" name="nabar" value="<?php echo $nm;?>">
                  <input type="hidden" name="satuan" value="<?php echo $satuan;?>">
                  <input type="hidden" name="stok" value="<?php echo $stok;?>">
                  <input type="hidden" name="harjul" value="<?php echo number_format($harjul);?>">
                  <input type="hidden" name="diskon" value="0">
                  <input type="hidden" name="qty" value="1" required>
                      <button type="submit" class="badge badge-pill badge-info" title="Pilih"><span class="fas fa-fw fa-edit"></span> Pilih</button>
                  </form>
                </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
