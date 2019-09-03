<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }

    private function _throwJSONOutput($resultValue, $outputData = NULL, $outputName = 'data')
    {
        $this->output->set_content_type('application/json');
        $messageArray = $outputData;
        die( json_encode(array("result" => $resultValue, $outputName => $messageArray)) );
    }

    private function _getUsers()
    {
        $this->load->model('get_users_model');
        return $this->get_users_model->get(17);
    }

    public function index()
    {
        $users = $this->_getUsers();
        foreach($users as $user => $details) {
            $this->email->clear();
            $mailConfig['mailpath'] = "/usr/lib/sendmail";
            $mailConfig['protocol'] = "smtp";
            $mailConfig['smtp_host'] = "smtpout.secureserver.net";
            $mailConfig['smtp_user'] = "do-not-reply@zapsw.com";
            $mailConfig['smtp_pass'] = "Z@psw12345";
            $mailConfig['smtp_port'] = "80";
            $mailConfig['mailtype'] = "html";
            $mailConfig['charset'] = 'utf-8';
            $mailConfig['newline'] = "\r\n";
            $mailConfig['validate'] = "TRUE";
            $this->email->initialize($mailConfig);
            $this->email->set_crlf( "\r\n" );
            $this->email->from('do-not-reply@zapsw.com', 'KAPLAN Print Order Portal');
            $this->email->to($details['email']);
            $this->email->bcc('vaibhav.sidapara@gmail.com');
            $this->email->subject('User Account Details - KAPLAN Print On Demand Portal');

            $string = $this->load->view('email/user_account', array('details'=>$details), TRUE);
            $this->email->message($string);

            $this->email->send();

        }

    }

    public function reminder()
    {
        $users = $this->_getUsers();

        foreach($users as $user => $details) {
            $this->email->clear();
            $mailConfig['mailpath'] = "/usr/lib/sendmail";
            $mailConfig['protocol'] = "smtp";
            $mailConfig['smtp_host'] = "smtpout.secureserver.net";
            $mailConfig['smtp_user'] = "do-not-reply@zapsw.com";
            $mailConfig['smtp_pass'] = "Z@psw12345";
            $mailConfig['smtp_port'] = "80";
            $mailConfig['mailtype'] = "html";
            $mailConfig['charset'] = 'utf-8';
            $mailConfig['newline'] = "\r\n";
            $mailConfig['validate'] = "TRUE";
            $this->email->initialize($mailConfig);
            $this->email->set_crlf( "\r\n" );
            $this->email->from('do-not-reply@zapsw.com', 'KAPLAN Print Order Portal');
            $this->email->to($details['email']);
            $this->email->subject('Portal Link - KAPLAN Print On Demand Portal');

            $string = $this->load->view('email/gentle_reminder', array('details'=>$details), TRUE);
            $this->email->message($string);

            $this->email->send();

        }

    }

    public function resend_order($order_id)
    {
        $this->load->model('get_orders_model');
        $job = $this->get_orders_model->orderByID($order_id);
        echo "<pre>";
        print_r($job);

        $mailConfig['mailpath'] = "/usr/lib/sendmail";
        $mailConfig['protocol'] = "smtp";
        $mailConfig['smtp_host'] = "smtpout.secureserver.net";
        // $mailConfig['smtp_host'] = "smtp.secureserver.net";
        $mailConfig['smtp_user'] = "do-not-reply@zapsw.com";
        $mailConfig['smtp_pass'] = "Z@psw12345";
        $mailConfig['smtp_port'] = "80";
        $mailConfig['mailtype'] = "html";
        $mailConfig['charset'] = 'utf-8';
        $mailConfig['newline'] = "\r\n";
        $mailConfig['validate'] = "TRUE";
        $this->email->initialize($mailConfig);
        $this->email->set_crlf( "\r\n" );

        $this->email->from('do-not-reply@zapsw.com', 'KAPLAN Print Order Portal');
        $this->email->to($job->email);
        $this->email->cc('kaplan@timesprinters.com');
        $this->email->subject('KAPLAN Print Order NO: '.$job->id);

        $data['job'] = $job;
        $string = $this->load->view('email/resend_order', $data, TRUE);
        $this->email->message($string);

        $this->email->send();
        echo $this->email->print_debugger();
    }

    public function portal_news()
    {
        $details = array();
        $details['name'] = "abc";
        $this->load->view('email/video_tutorial', $details);
    }



}
