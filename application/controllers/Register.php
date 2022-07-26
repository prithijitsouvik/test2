<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
       $this->load->model('register_model');
       
    }

    public function index() {
        $arrData['register_detail'] = $this->register_model->get_all_register_detail();
        $this->load->view('list', $arrData);
    }

    public function add() {

        $result['country'] = $this->register_model->countryView();
        // echo "<pre>";print_r($result);die;
        
        if ($this->input->post('btnadd')) {
            $arrData['first_name'] = $this->input->post('txtFname');
            $arrData['last_name'] = $this->input->post('txtLname');
            $arrData['address'] = $this->input->post('txtAddress');
            $arrData['email'] = $this->input->post('txtEmail');
            $arrData['mobile'] = $this->input->post('txtMobile');
            $arrData['country'] = $this->input->post('txtcountry');

            $insert = $this->register_model->insert($arrData);
            if ($insert) {
                redirect('register');
            }
        }
        $this->load->view('add',$result);
    }

    public function edit($id) {
        $arrData['register_detail'] = $this->register_model->get_id_wise_register_detail($id);
        $arrData['country'] = $this->register_model->countryView();
        // echo "<pre>";print_r($arrData);die;



        if ($this->input->post('btnEdit')) {
            $editData['first_name'] = $this->input->post('txtFname');
            $editData['last_name'] = $this->input->post('txtLname');
            $editData['address'] = $this->input->post('txtAddress');
            $editData['email'] = $this->input->post('txtEmail');
            $editData['mobile'] = $this->input->post('txtMobile');
            $editData['country'] = $this->input->post('txtCountry');

            // echo "<pre>";print_r($editData);die;

            $update = $this->register_model->update($editData, $id);
            if ($update) {
                redirect('register');
            }
        }
        $this->load->view('edit', $arrData);
    }

    public function delete($id) {
        $delete = $this->register_model->delete($id);
        if ($delete) {
            redirect('register');
        }
    }

}