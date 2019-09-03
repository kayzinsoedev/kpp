<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!$user) {
            redirect( base_url('/'), 'location');
        }
    }

    private function _throwJSONOutput($resultValue, $outputData = NULL, $outputName = 'data')
    {
        $this->output->set_content_type('application/json');
        $messageArray = $outputData;
        die( json_encode(array("result" => $resultValue, $outputName => $messageArray)) );
    }

    public function learn_file_upload()
    {
        $this->load->view('learn_file_upload');
    }

    public function index()
    {
        redirect( base_url('/'), 'location');
    }

    function password()
    {
        $this->load->view('user_password');
    }

    function change_password()
    {
        $this->form_validation->set_rules('password','Password','required|matches[confirm_password]|min_length[8]');
        $this->form_validation->set_rules('confirm_password','Confirm Password','required');

        if($this->form_validation->run() == FALSE) {
            $message = strip_tags(validation_errors());
            $this->_throwJSONOutput(0, $message);
        }

        $this->load->model('get_users_model');

        $data = array(
            'password' => $this->input->post('password')
        );

        $where = array(
            'id'    => $this->session->userdata('user_id'),
            'email' => $this->session->userdata('user'),
        );
        $update = $this->get_users_model->update($data, $where);

        if(!$update) {
            $this->_throwJSONOutput(0, 'Cannot Update Your Password', 'data');
        }
        // $this->_throwJSONOutput(0, "update", 'data');
        $this->_throwJSONOutput(1, base_url('/'), 'location');

    }

}
