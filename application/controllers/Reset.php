<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Reset extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'location');
    }

}
