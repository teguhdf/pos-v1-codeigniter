<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('products_model', 'mProduct');
    }

    public function index()
    {
        $data['title'] = "Products";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['products']=$this->mProduct->get_products();

        $this->load->view('master/list_product',$data);
    }

    public function ajax_list()
    {
        $list = $this->mProduct->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $product) {
            $no++;
            $row = array();
            $row[] = $product->kode_produk;
            $row[] = $product->nama_produk;
            $row[] = $product->satuan;
            $row[] = $product->hargaJual;
            $row[] = $product->hargaPokok;
            $row[] = $product->hargaJualGrosir;
            $row[] = $product->stock;
            $row[] = $product->minStock;
            $row[] = $product->category;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_product(' . "'" . $product->id_product . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_product(' . "'" . $product->id_product . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mProduct->count_all(),
            "recordsFiltered" => $this->mProduct->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode(array('cek' => $output));
    }


    function ajax_add()
    {
        $this->_validate();
        $data = array(
            'nama' => $this->input->post('nama'),
            'noHp' => $this->input->post('noHp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $insert = $this->mProduct->save($data);
        echo json_encode(array("status" => true));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nama' => $this->input->post('nama'),
            'noHp' => $this->input->post('noHp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $test = $this->mProduct->update(array('id_product' => $this->input->post('id_product')), $data);
        echo json_encode(array("status" => true));
    }

    public function ajax_edit($id)
    {
        $data = $this->mProduct->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_delete($id)
    {
        $this->mProduct->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Name harus di isi';
            $data['status'] = false;
        }

        if ($this->input->post('noHp') == '') {
            $data['inputerror'][] = 'no Telepon';
            $data['error_string'][] = 'no telepon harus diisi';
            $data['status'] = false;
        }

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'email harus diisi';
            $data['status'] = false;
        }

        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'alamat harus di isi';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
