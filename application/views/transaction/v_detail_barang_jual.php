					<?php
						error_reporting(0);
						$b=$brg->row_array();
					?>
					<div class="form-inline">
					  <label class="sr-only" for="inlineFormInputName2">Nama Barang</label>
					  	<input type="text" name="nabar" value="<?php echo $b['barang_nama'];?>" style="width:380px;"  class="form-control mb-2 mr-sm-2" readonly>
					  <label class="sr-only" for="inlineFormInputName2">Stok</label>
					  	<input type="text" name="stok" value="<?php echo $b['barang_stok'];?>" style="width:40px;"  class="form-control mb-2 mr-sm-2" readonly>
					  <label class="sr-only" for="inlineFormInputName2">Harga</label>
					  	<input type="text" name="harjul" value="<?php echo number_format($b['barang_harjul']);?>" style="width:120px"  class="form-control mb-2 mr-sm-2" readonly>
					  <label class="sr-only" for="inlineFormInputName2">Diskon</label>
					  	<input type="number" name="diskon" id="diskon" value="0" min="0" style="width:120px;" class="form-control mb-2 mr-sm-2"  required>
					  <label class="sr-only" for="inlineFormInputName2">Diskon</label>
					  	<input type="number" name="qty" id="qty" value="1" min="1" max="<?php echo $b['barang_stok'];?>" style="width:70px;" class="form-control mb-2 mr-sm-2"  required>

					  <button type="submit" class="btn btn-primary mb-2">Submit</button>
					</div>
