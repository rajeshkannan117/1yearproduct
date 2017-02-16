<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* This is login controller of Formpro
*
* @package		CodeIgniter
* @category	controller
* @author		Rajeshkannan.C
* @link		http://innoppl.com/
*
*/

//include APPPATH.'controllers/OAuth.php';
//include APPPATH.'controllers/common.php';
class Thank_you extends CI_Controller {
  public function view() {
    if ( ! file_exists(APPPATH.'/views/pages/thank-you.php')) {
      //Whoops, we don't have a page for that!
      show_404();
    }       
    $data['title'] = ucfirst('Thank You'); 
    $this->load->view('pages/thank-you.php', $data);
  }
}