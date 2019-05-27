<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_karyawan extends CI_Controller {

	var $API ="";

	function __construct() {
		parent::__construct();
		$this->API="https://api.akhmad.web.id/";
	}

	// proses yang akan di buka saat pertama masuk ke controller
	public function index()
	{
		$this->curl->http_header("X-Nim", "1702715");
		/*$this->curl->simple_get($this->API.'/user');*/
		
		$data['motor'] = json_decode($this->curl->simple_get($this->API.'/motor'));


		$this->load->view('V_karyawan', $data);

	}

	public function cicil()
	{
		$this->curl->http_header("X-Nim", "1702715");
		/*$this->curl->simple_get($this->API.'/user');*/
		
		$data['cicil'] = json_decode($this->curl->simple_get($this->API.'/cicil'));


		$this->load->view('V_cicil', $data);

	}

	// proses untuk menambah data
	// insert data kontak
	function add(){

		$data = array(
			'id_motor'      =>  $this->input->post('id_motor'),
			'tipe_motor'    =>  $this->input->post('tipe_motor'),
			'harga_motor'	  =>  $this->input->post('harga_motor'));
		$insert =  $this->curl->simple_post($this->API.'/motor', $data, array(CURLOPT_BUFFERSIZE => 0));

		if($insert)
		{
			$this->session->set_flashdata('hasil','Insert Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Insert Data Gagal');
		}

		redirect('C_karyawan');

	}


	function update($id){

		$data = array(
			'id'      =>  $id,
			'name'    =>  $this->input->post('name'),
			'email'	  =>  $this->input->post('email'),
			'address' =>  $this->input->post('address'),
			'phone'	  =>  $this->input->post('phone'));
		$update =  $this->curl->simple_put($this->API.'/Karyawan', $data, array(CURLOPT_BUFFERSIZE => 0));

		if($update)
		{
			$this->session->set_flashdata('hasil','Insert Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Insert Data Gagal');
		}

		redirect('C_karyawan');

	}





	// proses untuk menghapus data pada database
	function delete($id){
		if(empty($id)){
			redirect('C_karyawan');
		}else{
			$delete =  $this->curl->simple_delete($this->API.'/Karyawan', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10));
			if($delete)
			{
				$this->session->set_flashdata('hasil','Delete Data Berhasil');
			}else
			{
				$this->session->set_flashdata('hasil','Delete Data Gagal');
			}

			redirect('C_karyawan');
		}
	}

	//TUGAS : bikin fungsi update di client menggunakan service
	//
	//
}
