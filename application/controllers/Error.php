<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error
 *
 * @author innoppl
 */
class Error extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $data['msg'] = 'Unauthorised access';
        $this->load->view('error_404',$data);   
    }
    //put your code here
}
