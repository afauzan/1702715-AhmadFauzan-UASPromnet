<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Karyawan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $karyawan = $this->db->get('tb_karyawan')->result();
        } else {
            $this->db->where('id', $id);
            $karyawan = $this->db->get('tb_karyawan')->result();
        }
        $this->response($karyawan, 200);
    }

    function index_post() {
        $data = array(
            'id'      =>  $this->input->post('id'),
            'name'    =>  $this->input->post('name'),
            'email'   =>  $this->input->post('email'),
            'address' =>  $this->input->post('address'),
            'phone'   =>  $this->input->post('phone'),
            'tgl'   =>  $this->input->post('tgl'),
            'tempat'   =>  $this->input->post('tempat'),
            'gaji'   =>  $this->input->post('gaji'),
            'posisi'   =>  $this->input->post('posisi'));
        $insert = $this->db->insert('tb_karyawan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


     function index_put() {
        $id = $this->put('id');
        $data = array(
            
            'name'    =>  $this->put('name'),
            'email'   =>  $this->put('email'),
            'address' =>  $this->put('address'),
            'phone'   =>  $this->put('phone'),
            'tgl'   =>  $this->put('tgl'),
            'tempat'   =>  $this->put('tempat'),
            'gaji'   =>  $this->put('gaji'),
            'posisi'   =>  $this->put('posisi'));
        $this->db->where('id', $id);
        $update = $this->db->update('tb_karyawan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }



    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tb_karyawan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //TUGAS: bikin fungsi update db dari data client

}
?>
