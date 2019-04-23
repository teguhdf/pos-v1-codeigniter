<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Customers_model', 'mCustomer');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = "Customers";
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('master/Customers_view',$data);
	}

	public function ajax_list()
	{
		$list = $this->mCustomer->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customer) {
			$no++;
			$row = array();
			$row[] = $customer->nama;
			$row[] = $customer->email;
			$row[] = $customer->noHp;
			$row[] = $customer->alamat;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_customer(' . "'" . $customer->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_customer(' . "'" . $customer->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mCustomer->count_all(),
			"recordsFiltered" => $this->mCustomer->count_filtered(),
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
		);
		$insert = $this->mCustomer->save($data);
		echo json_encode(array('status' => true));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'nama' => $this->input->post('nama'),
			'noHp' => $this->input->post('noHp'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
		);
		$insert = $this->mCustomer->update(array('id' => $this->input->post('id_customer')), $data);
		echo json_encode(array("status" => true));
	}

	public function ajax_edit($id)
	{
		$data = $this->mCustomer->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->mCustomer->delete_by_id($id);
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
