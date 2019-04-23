<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_model extends CI_Model
{

  public function simpan_penjualan($nofak,$total,$jml_uang,$kembalian){
    $idadmin = $this->session->userdata('id');

    $query = "INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan)
              VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','Retail')";
    $this->db->query($query);

      foreach ($this->cart->contents() as $item) {
  			$data=array(
  				'd_jual_nofak' 			=>	$nofak,
  				'd_jual_barang_id'		=>	$item['id'],
  				'd_jual_barang_nama'	=>	$item['name'],
  				'd_jual_barang_satuan'	=>	$item['satuan'],
  				'd_jual_barang_harpok'	=>	$item['harpok'],
  				'd_jual_barang_harjul'	=>	$item['amount'],
  				'd_jual_qty'			=>	$item['qty'],
  				'd_jual_diskon'			=>	$item['disc'],
  				'd_jual_total'			=>	$item['subtotal']
  			);
  			$this->db->insert('tbl_detail_jual',$data);
  			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
  		}
  		return true;
  	}

    public function get_nofak(){
  		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE()");
          $kd = "";
          if($q->num_rows()>0){
              foreach($q->result() as $k){
                  $tmp = ((int)$k->kd_max)+1;
                  $kd = sprintf("%06s", $tmp);
              }
          }else{
              $kd = "000001";
          }
          return date('dmy').$kd;
  	}

  public function cetak_faktur(){
  		$nofak=$this->session->userdata('nofak');
  		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_nofak='$nofak'");
  		return $hsl;
  	}

}
