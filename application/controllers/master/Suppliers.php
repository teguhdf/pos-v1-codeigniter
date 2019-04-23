<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suppliers extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('supplier_model', 'mProduct');
		$this->load->library('form_validation');
	}

	public function index()
	{

		$data['title'] = "Suppliers";
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('master/supplier_view',$data);
	}

	public function ajax_list()
	{
		$list = $this->mProduct->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $supplier) {
			$no++;
			$row = array();
			$row[] = $supplier->nama;
			$row[] = $supplier->email;
			$row[] = $supplier->noHp;
			$row[] = $supplier->alamat;
			$row[] = $supplier->keterangan;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_supplier(' . "'" . $supplier->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_supplier(' . "'" . $supplier->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mProduct->count_all(),
			"recordsFiltered" => $this->mProduct->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
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
		$test = $this->mProduct->update(array('id' => $this->input->post('id_supplier')), $data);
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
