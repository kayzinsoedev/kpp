<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    private function _throwJSONOutput($resultValue, $outputData = NULL, $outputName = 'data')
    {
        $this->output->set_content_type('application/json');
        $messageArray = $outputData;
        die( json_encode(array("result" => $resultValue, $outputName => $messageArray)) );
    }

    function index()
    {
        $user = $this->session->userdata('user');
        if($user) {
            redirect( base_url('/prints/'), 'location');
        }
        $this->load->view('home');
    }

    function sign_in()
    {
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == FALSE) {
            $message = strip_tags(validation_errors());
            $this->_throwJSONOutput(0, $message);
        }

        $this->load->model('get_users_model');
        $get = $this->get_users_model->sign_in($this->input->post('email'), $this->input->post('password'));

        if(!$get) {
            $this->_throwJSONOutput(0, 'Email ID or Password did not match', 'data');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($email == 'staff' && $password == 'staff123') {
            $this->session->set_userdata('staff', TRUE);
            $this->_throwJSONOutput(1, base_url('/order/all'), 'location');
        }

        $job_session_id = uniqid();
        $this->session->set_userdata('user_id', $get->id);
        $this->session->set_userdata('user', $get->email);
        $this->session->set_userdata('user_name', $get->name);
        $this->session->set_userdata('department', $get->department);
        $this->session->set_userdata('job_session_id', $job_session_id);

        $this->_throwJSONOutput(1, base_url('/prints/'), 'location');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('/'), 'location');
    }

    function generatePassword()
    {
        echo "<pre>";
        print_r( $this->_generateRandomString() );
    }

    private function _generateRandomString($length = 10)
    {
        $randomPassword = array();
        for($p = 0; $p <= 40; $p++) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            for($i = 0; $i < $length; $i++) {
                $randomString .= $characters[ rand(0, $charactersLength - 1) ];
            }
            $randomPassword[$p] = $randomString;
        }

        return $randomPassword;
    }


}
