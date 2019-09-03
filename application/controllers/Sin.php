<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Sin extends REST_Controller
{
    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->response(array('error' => '404 Page Not Found'), 404);
    }

    public function index_get() {
        $this->response(array('error' => '404 Page Not Found'), 404);
    }

    public function index_post() {
        $this->response(array('error' => '404 Page Not Found'), 404);
    }

    public function index_put() {
        $this->response(array('error' => '404 Page Not Found'), 404);
    }

    public function index_patch() {
        $this->response(array('error' => '404 Page Not Found'), 404);
    }

    public function index_delete() {
        $this->response(array('error' => '404 Page Not Found'), 404);
    }
}
