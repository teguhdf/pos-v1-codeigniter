<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RetailSales extends CI_Controller {

  public function __construct(){
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
    $this->load->model('Products_model');
    $this->load->model('Sales_model');
    $this->load->library('cart');
  }

  public function index()
  {
    $data['title'] = "Retail Sales";
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    $data['data']=$this->Products_model->get_products();

    $this->load->view('transaction/retail_view',$data);
  }

  function get_products(){

		$kobar=$this->input->post('kode_brg');
		$x['brg']=$this->Products_model->get_products_byId($kobar);
		$this->load->view('transaction/v_detail_barang_jual',$x);

	}

  public function add_to_cart(){

    $kobar=$this->input->post('kode_brg');
		$produk=$this->Products_model->get_products_byId($kobar);
		$i=$produk->row_array();

      $data = array(
        'id'       => $i['barang_id'],
        'name'     => $i['barang_nama'],
        'satuan'   => $i['barang_satuan'],
        'harpok'   => $i['barang_harpok'],
        'price'    => str_replace(",", "", $this->input->post('harjul'))-$this->input->post('diskon'),
        'disc'     => $this->input->post('diskon'),
        'qty'      => $this->input->post('qty'),
        'amount'	  => str_replace(",", "", $this->input->post('harjul'))
      );

    if(!empty($this->cart->total_items())){

      foreach ($this->cart->contents() as $items){
  			$id=$items['id'];
  			$qtylama=$items['qty'];
  			$rowid=$items['rowid'];
  			$kobar=$this->input->post('kode_brg');
  			$qty=$this->input->post('qty');
  			if($id==$kobar){
  				$up=array(
  					'rowid'=> $rowid,
  					'qty'=>$qtylama+$qty
  					);
  				$this->cart->update($up);
  			}else{
  				$this->cart->insert($data);
  			}
  		}

    }else{
  		$this->cart->insert($data);
  	}
    redirect('transaction/RetailSales');
  }

  public function remove(){
      $row_id=$this->uri->segment(4);
      $this->cart->update(array(
                 'rowid'      => $row_id,
                 'qty'     => 0
              ));
      redirect('transaction/RetailSales');
  }

  public function simpan_penjualan(){

      $total=$this->input->post('total');
      $jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
      $kembalian=$jml_uang-$total;
      if(!empty($total) && !empty($jml_uang)){
        if($jml_uang < $total){
          echo $this->session->set_flashdata('msg','<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
          redirect('transaction/RetailSales');
        }else{
          $nofak=$this->Sales_model->get_nofak();
          $this->session->set_userdata('nofak',$nofak);
          $order_proses=$this->Sales_model->simpan_penjualan($nofak,$total,$jml_uang,$kembalian);
          if($order_proses){
            $this->cart->destroy();

            $this->session->unset_userdata('tglfak');
            //$this->session->unset_userdata('suplier');
            redirect('transaction/RetailSales/show_alert');
          }else{
            redirect('transaction/RetailSales');
          }
        }

      }else{
        echo $this->session->set_flashdata('msg','<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
        redirect('transaction/RetailSales');
      }
    }

  public function cetak_faktur(){
  		$x['data']=$this->Sales_model->cetak_faktur();
  		$this->load->view('transaction/v_faktur',$x);
  	}

  public function show_alert(){
    $data['title'] = "Congretulation";
    $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('transaction/alert_success',$data);
  }
}
